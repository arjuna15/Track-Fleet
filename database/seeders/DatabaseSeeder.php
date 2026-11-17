<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VendorPartner;
use App\Models\Vehicle;
use App\Models\Order;
use App\Models\LocationPing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Users
        User::create([
            'name' => 'Arjuna Arrasyid',
            'email' => 'admin@trackfleet.id',
            'role' => User::ROLE_OPERATIONAL,
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Innike Reyna',
            'email' => 'innike@trackfleet.id',
            'role' => User::ROLE_FINANCE,
            'password' => Hash::make('password123'),
        ]);

        // 2. Vendor Partners
        $vp1 = VendorPartner::create([
            'name' => 'PT Surya Trans Logistik',
            'company_code' => 'VND-STL',
            'contact_person' => 'Bambang Santoso',
            'phone' => '081288991122',
            'email' => 'dispatch@suryatrans.co.id',
            'city' => 'Jakarta Timur',
            'total_fleet' => 18,
            'rating' => 4.9,
            'status' => 'active',
        ]);

        $vp2 = VendorPartner::create([
            'name' => 'CV Mandiri Cargo Nusantara',
            'company_code' => 'VND-MCN',
            'contact_person' => 'Agus Priyono',
            'phone' => '081399884433',
            'email' => 'mandiri.cargo@gmail.com',
            'city' => 'Semarang',
            'total_fleet' => 12,
            'rating' => 4.7,
            'status' => 'active',
        ]);

        $vp3 = VendorPartner::create([
            'name' => 'PT Laju Jaya Perkasa',
            'company_code' => 'VND-LJP',
            'contact_person' => 'Hendra Setiawan',
            'phone' => '081177665544',
            'email' => 'ops@lajujaya.com',
            'city' => 'Surabaya',
            'total_fleet' => 25,
            'rating' => 4.8,
            'status' => 'active',
        ]);

        // 3. Vehicles
        $v1 = Vehicle::create([
            'vendor_partner_id' => $vp1->id,
            'plate_number' => 'B 9142 TQU',
            'truck_type' => 'TRONTON_WINGBOX',
            'driver_name' => 'Suhendra Wijaya',
            'driver_phone' => '082155667788',
            'status' => 'in_transit',
            'current_lat' => -6.90389,
            'current_lng' => 109.62528,
            'current_location_name' => 'Tol Trans Jawa KM 348 (Pekalongan - Batang)',
            'last_ping_at' => now()->subMinutes(12),
        ]);

        $v2 = Vehicle::create([
            'vendor_partner_id' => $vp1->id,
            'plate_number' => 'B 9801 UXV',
            'truck_type' => 'CDD_BOX',
            'driver_name' => 'Rian Hidayat',
            'driver_phone' => '085211223344',
            'status' => 'in_transit',
            'current_lat' => -6.2849,
            'current_lng' => 106.8422,
            'current_location_name' => 'Jl. TB Simatupang, Jakarta Selatan',
            'last_ping_at' => now()->subMinutes(5),
        ]);

        $v3 = Vehicle::create([
            'vendor_partner_id' => $vp2->id,
            'plate_number' => 'H 8120 OK',
            'truck_type' => 'FUSO_BAK',
            'driver_name' => 'Joko Purwanto',
            'driver_phone' => '081377889900',
            'status' => 'idle',
            'current_lat' => -6.9932,
            'current_lng' => 110.4203,
            'current_location_name' => 'Garasi Vendor Krapyak, Semarang',
            'last_ping_at' => now()->subHours(3),
        ]);

        $v4 = Vehicle::create([
            'vendor_partner_id' => $vp3->id,
            'plate_number' => 'L 9455 UA',
            'truck_type' => 'TRAILER_40FT',
            'driver_name' => 'Dedi Iskandar',
            'driver_phone' => '087899001122',
            'status' => 'idle',
            'current_lat' => -7.2023,
            'current_lng' => 112.7291,
            'current_location_name' => 'Depo Kontainer Tanjung Perak, Surabaya',
            'last_ping_at' => now()->subHours(1),
        ]);

        // 4. Sample Orders
        // Order 1: High Margin In Transit (Jakarta -> Surabaya)
        $calc1 = Order::calculateMargin(14500000, 11000000, 850000); // 18.28% margin
        $o1 = Order::create([
            'order_number' => 'TF-202611-0101',
            'public_tracking_code' => 'TRK-JKTSBY89',
            'shipper_name' => 'PT Mayora Indah Tbk',
            'shipper_contact' => 'Ibu Ratna (Logistics Planner) - 081299001122',
            'origin_city' => 'Bekasi, Jawa Barat',
            'origin_address' => 'Kawasan Industri MM2100 Cikarang Barat',
            'destination_city' => 'Surabaya, Jawa Timur',
            'destination_address' => 'Gudang Distribusi Rungkut Industri III',
            'cargo_description' => 'Produk Biskuit & Makanan Ringan Kemasan (Palletized)',
            'cargo_weight_ton' => 16.5,
            'selling_price' => 14500000,
            'vendor_cost' => 11000000,
            'operational_cost' => 850000,
            'gross_profit' => $calc1['gross_profit'],
            'margin_percentage' => $calc1['margin_percentage'],
            'is_low_margin_alert' => $calc1['is_low_margin_alert'],
            'vehicle_id' => $v1->id,
            'vendor_partner_id' => $vp1->id,
            'assigned_driver_name' => $v1->driver_name,
            'assigned_driver_phone' => $v1->driver_phone,
            'status' => 'in_transit',
            'payment_status' => 'unpaid',
            'created_at' => now()->subDays(1),
        ]);

        // Pings for Order 1
        LocationPing::create([
            'order_id' => $o1->id,
            'vehicle_id' => $v1->id,
            'latitude' => -6.3051,
            'longitude' => 107.1352,
            'speed_kmh' => 64.0,
            'location_name' => 'Gerbang Tol Cikarang Utama, Bekasi',
            'notes' => 'Armada lepas loading dock pabrik, dokumen SPJ lengkap.',
            'recorded_at' => now()->subHours(18),
        ]);
        LocationPing::create([
            'order_id' => $o1->id,
            'vehicle_id' => $v1->id,
            'latitude' => -6.7821,
            'longitude' => 108.4912,
            'speed_kmh' => 78.5,
            'location_name' => 'Tol Cipali KM 208 (Palimanan - Cirebon)',
            'notes' => 'Perjalanan lancar, istirahat rest area 30 menit.',
            'recorded_at' => now()->subHours(10),
        ]);
        LocationPing::create([
            'order_id' => $o1->id,
            'vehicle_id' => $v1->id,
            'latitude' => -6.90389,
            'longitude' => 109.62528,
            'speed_kmh' => 72.0,
            'location_name' => 'Tol Trans Jawa KM 348 (Pekalongan - Batang)',
            'notes' => 'Kondisi cuaca cerah, estimasi tiba Surabaya malam ini pkl 22:00.',
            'recorded_at' => now()->subMinutes(12),
        ]);

        // Order 2: Low Margin Order Triggering Early Warning Alert (Bogor -> Semarang)
        // Selling: 7.200.000, Vendor: 6.300.000, Ops: 350.000 -> Gross: 550.000 (Margin 7.64% < 10% ALERT!)
        $calc2 = Order::calculateMargin(7200000, 6300000, 350000);
        Order::create([
            'order_number' => 'TF-202611-0102',
            'public_tracking_code' => 'TRK-BGRSMG44',
            'shipper_name' => 'PT Mitra Plastik Sukses',
            'shipper_contact' => 'Pak Dedi (Supply Chain) - 081722334455',
            'origin_city' => 'Bogor, Jawa Barat',
            'origin_address' => 'Sentul Industrial Park Blok B2',
            'destination_city' => 'Semarang, Jawa Tengah',
            'destination_address' => 'Kawasan Industri Wijayakusuma Semarang Barat',
            'cargo_description' => 'Biji Plastik HDPE dalam Karung 25kg',
            'cargo_weight_ton' => 9.2,
            'selling_price' => 7200000,
            'vendor_cost' => 6300000,
            'operational_cost' => 350000,
            'gross_profit' => $calc2['gross_profit'],
            'margin_percentage' => $calc2['margin_percentage'],
            'is_low_margin_alert' => $calc2['is_low_margin_alert'], // TRUE! Alert!
            'vehicle_id' => null, // Waiting approval
            'vendor_partner_id' => $vp2->id,
            'status' => 'inquiry',
            'payment_status' => 'unpaid',
            'created_at' => now()->subHours(4),
        ]);

        // Order 3: Delivered with Instant Digital E-POD uploaded (Jakarta -> Tangerang)
        $calc3 = Order::calculateMargin(2800000, 1900000, 200000); // 25.0%
        Order::create([
            'order_number' => 'TF-202611-0098',
            'public_tracking_code' => 'TRK-JKTTNG12',
            'shipper_name' => 'PT Unilever Indonesia Logistics',
            'shipper_contact' => 'Bpk. Fajar Wicaksono - 081199887766',
            'origin_city' => 'Jakarta Timur',
            'origin_address' => 'Hub Pergudangan Cakung',
            'destination_city' => 'Tangerang, Banten',
            'destination_address' => 'DC Bitung Curug Tangerang',
            'cargo_description' => 'Consumer Goods (Perawatan Tubuh)',
            'cargo_weight_ton' => 4.5,
            'selling_price' => 2800000,
            'vendor_cost' => 1900000,
            'operational_cost' => 200000,
            'gross_profit' => $calc3['gross_profit'],
            'margin_percentage' => $calc3['margin_percentage'],
            'is_low_margin_alert' => false,
            'vehicle_id' => $v2->id,
            'vendor_partner_id' => $vp1->id,
            'assigned_driver_name' => $v2->driver_name,
            'assigned_driver_phone' => $v2->driver_phone,
            'status' => 'delivered',
            'pod_image_path' => 'demo-pod-stempel.jpg',
            'pod_uploaded_at' => now()->subHours(2),
            'pod_signer_name' => 'Agus Prihatin (Kepala Gudang Bitung)',
            'invoice_generated' => true,
            'invoice_date' => now()->subHours(1),
            'payment_status' => 'unpaid',
            'created_at' => now()->subDays(2),
        ]);

        // Order 4: Completed & Paid
        $calc4 = Order::calculateMargin(18500000, 14200000, 1100000); // 17.3%
        Order::create([
            'order_number' => 'TF-202611-0085',
            'public_tracking_code' => 'TRK-JKTMDN77',
            'shipper_name' => 'PT Indofood CBP Sukses Makmur',
            'shipper_contact' => 'Bpk. Gunawan - 081233445566',
            'origin_city' => 'Tangerang, Banten',
            'origin_address' => 'Pabrik Indofood Cikupa',
            'destination_city' => 'Bandar Lampung, Lampung',
            'destination_address' => 'DC Sukabumi Bandar Lampung',
            'cargo_description' => 'Mi Instan & Minuman Kemasan Karton',
            'cargo_weight_ton' => 21.0,
            'selling_price' => 18500000,
            'vendor_cost' => 14200000,
            'operational_cost' => 1100000,
            'gross_profit' => $calc4['gross_profit'],
            'margin_percentage' => $calc4['margin_percentage'],
            'is_low_margin_alert' => false,
            'vehicle_id' => $v4->id,
            'vendor_partner_id' => $vp3->id,
            'assigned_driver_name' => $v4->driver_name,
            'assigned_driver_phone' => $v4->driver_phone,
            'status' => 'completed',
            'pod_image_path' => 'demo-pod-stempel-lampung.jpg',
            'pod_uploaded_at' => now()->subDays(4),
            'pod_signer_name' => 'Yusuf Maulana (Staf Penerimaan)',
            'invoice_generated' => true,
            'invoice_date' => now()->subDays(4),
            'payment_status' => 'paid',
            'created_at' => now()->subDays(6),
        ]);
    }
}
