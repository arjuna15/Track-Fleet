<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_partner_id')->nullable()->constrained('vendor_partners')->nullOnDelete();
            $table->string('plate_number')->unique();
            $table->enum('truck_type', ['CDD_BOX', 'CDE_ENGKEL', 'FUSO_BAK', 'TRONTON_WINGBOX', 'TRAILER_40FT']);
            $table->string('driver_name');
            $table->string('driver_phone');
            $table->enum('status', ['idle', 'in_transit', 'maintenance'])->default('idle');
            $table->decimal('current_lat', 10, 7)->nullable();
            $table->decimal('current_lng', 10, 7)->nullable();
            $table->string('current_location_name')->nullable();
            $table->timestamp('last_ping_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
