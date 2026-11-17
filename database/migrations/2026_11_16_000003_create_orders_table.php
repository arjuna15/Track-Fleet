<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // e.g. TF-202611-0089
            $table->string('public_tracking_code')->unique(); // e.g. TRK-8F29A
            $table->string('shipper_name');
            $table->string('shipper_contact');
            $table->string('origin_city');
            $table->string('origin_address');
            $table->string('destination_city');
            $table->string('destination_address');
            $table->string('cargo_description');
            $table->decimal('cargo_weight_ton', 8, 2)->default(1.0);
            
            // Financial & Margin Fields (Core E-Business Model)
            $table->decimal('selling_price', 15, 2); // Harga jual ke shipper
            $table->decimal('vendor_cost', 15, 2);   // Biaya ke vendor armada
            $table->decimal('operational_cost', 15, 2)->default(0); // Biaya tol, bbm, bongkar muat
            $table->decimal('gross_profit', 15, 2);   // Selling - (Vendor + Operational)
            $table->decimal('margin_percentage', 5, 2); // (Gross Profit / Selling) * 100
            $table->boolean('is_low_margin_alert')->default(false); // True jika margin < 10%
            
            // Operational Assignment
            $table->foreignId('vehicle_id')->nullable()->constrained('vehicles')->nullOnDelete();
            $table->foreignId('vendor_partner_id')->nullable()->constrained('vendor_partners')->nullOnDelete();
            $table->string('assigned_driver_name')->nullable();
            $table->string('assigned_driver_phone')->nullable();
            
            // Status Pipeline
            $table->enum('status', [
                'draft', 
                'inquiry', 
                'dispatched', 
                'in_transit', 
                'delivered', 
                'invoiced', 
                'completed',
                'cancelled'
            ])->default('inquiry');

            // Invoicing & POD
            $table->string('pod_image_path')->nullable();
            $table->timestamp('pod_uploaded_at')->nullable();
            $table->string('pod_signer_name')->nullable();
            $table->boolean('invoice_generated')->default(false);
            $table->timestamp('invoice_date')->nullable();
            $table->enum('payment_status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
