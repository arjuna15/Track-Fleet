<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $guarded = [];

    protected $casts = [
        'current_lat' => 'decimal:7',
        'current_lng' => 'decimal:7',
        'last_ping_at' => 'datetime',
    ];

    /** Human-friendly Indonesian label for the vehicle status. */
    public function statusLabel(): string
    {
        return [
            'idle' => 'Siaga',
            'in_transit' => 'Dalam perjalanan',
            'maintenance' => 'Perawatan',
        ][$this->status] ?? ucfirst(str_replace('_', ' ', (string) $this->status));
    }

    public function vendorPartner(): BelongsTo
    {
        return $this->belongsTo(VendorPartner::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function locationPings(): HasMany
    {
        return $this->hasMany(LocationPing::class);
    }
}
