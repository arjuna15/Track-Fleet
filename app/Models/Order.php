<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [];

    protected $casts = [
        'selling_price' => 'decimal:2',
        'vendor_cost' => 'decimal:2',
        'operational_cost' => 'decimal:2',
        'gross_profit' => 'decimal:2',
        'margin_percentage' => 'decimal:2',
        'is_low_margin_alert' => 'boolean',
        'invoice_generated' => 'boolean',
        'pod_uploaded_at' => 'datetime',
        'invoice_date' => 'datetime',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function vendorPartner(): BelongsTo
    {
        return $this->belongsTo(VendorPartner::class);
    }

    public function locationPings(): HasMany
    {
        return $this->hasMany(LocationPing::class)->orderBy('recorded_at', 'desc');
    }

    /** Human-friendly Indonesian label for the order status. */
    public function statusLabel(): string
    {
        return [
            'draft' => 'Draf',
            'inquiry' => 'Menunggu',
            'dispatched' => 'Disiapkan',
            'in_transit' => 'Dalam perjalanan',
            'delivered' => 'Tiba',
            'invoiced' => 'Ditagihkan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
        ][$this->status] ?? ucfirst(str_replace('_', ' ', (string) $this->status));
    }

    /** Tailwind badge classes for the current status. */
    public function statusTone(): string
    {
        return [
            'draft' => 'bg-slate-100 text-slate-700 border-slate-200',
            'inquiry' => 'bg-slate-100 text-slate-700 border-slate-200',
            'dispatched' => 'bg-blue-50 text-blue-800 border-blue-200',
            'in_transit' => 'bg-blue-50 text-blue-800 border-blue-200',
            'delivered' => 'bg-amber-50 text-amber-800 border-amber-200',
            'invoiced' => 'bg-violet-50 text-violet-800 border-violet-200',
            'completed' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            'cancelled' => 'bg-rose-50 text-rose-800 border-rose-200',
        ][$this->status] ?? 'bg-slate-100 text-slate-600 border-slate-200';
    }

    /** Ordered pipeline used by progress steppers. */
    public static function pipeline(): array
    {
        return ['inquiry', 'dispatched', 'in_transit', 'delivered', 'invoiced', 'completed'];
    }

    /** Index of current status within the pipeline (0-based). */
    public function pipelineIndex(): int
    {
        $index = array_search($this->status, self::pipeline(), true);
        return $index === false ? 0 : $index;
    }

    public static function calculateMargin(float $selling, float $vendorCost, float $operational = 0): array
    {
        $grossProfit = $selling - ($vendorCost + $operational);
        $marginPercentage = $selling > 0 ? ($grossProfit / $selling) * 100 : 0;
        $isLowMargin = $marginPercentage < 10.0;

        return [
            'gross_profit' => round($grossProfit, 2),
            'margin_percentage' => round($marginPercentage, 2),
            'is_low_margin_alert' => $isLowMargin,
        ];
    }
}
