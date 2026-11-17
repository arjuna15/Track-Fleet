<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UiUxPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get(route('landing.index'));
        $response->assertStatus(200);
        $response->assertSee('TrackFleet');
        $response->assertSee('Kendali kiriman');
    }

    public function test_pricing_page_renders_with_differentiated_ctas(): void
    {
        $response = $this->get(route('landing.pricing'));
        $response->assertStatus(200);
        $response->assertSee('Mulai coba gratis 14 hari');
        $response->assertSee('Pilih paket Operasional');
        $response->assertSee('Hubungi tim penjualan');
    }

    public function test_public_tracking_renders_with_map_fallback(): void
    {
        $response = $this->get(route('tracking.public'));
        $response->assertStatus(200);
        $response->assertSee('Lacak kiriman');

        // Test with seeded code
        $order = Order::first();
        if ($order) {
            $responseWithCode = $this->get(route('tracking.public', ['code' => $order->public_tracking_code]));
            $responseWithCode->assertStatus(200);
            $responseWithCode->assertSee('shipperMap');
            $responseWithCode->assertSee('Aktifkan JavaScript untuk melihat visualisasi rute');
        }
    }

    public function test_admin_dashboard_renders_with_sidebar_and_responsive_cards(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('admin-sidebar');
        $response->assertSee('responsive-table-mobile');
        $response->assertSee('responsive-table-desktop');
        $response->assertSee('liveFleetMap');
        $response->assertSee('Aktifkan JavaScript untuk melihat peta armada');
    }

    public function test_admin_orders_index_renders_with_responsive_cards_and_search(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('admin.orders.index'));
        $response->assertStatus(200);
        $response->assertSee('admin-sidebar');
        $response->assertSee('Search anything...');
        $response->assertDontSee('Harga & Paket');
        $response->assertDontSee('NAVIGASI UTAMA');
        $response->assertSee('responsive-table-mobile');
        $response->assertSee('responsive-table-desktop');
        $response->assertSee('data-order-card');
        $response->assertSee('filterOrdersTable');
    }

    public function test_admin_vehicles_index_renders_with_sidebar(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('admin.vehicles.index'));
        $response->assertStatus(200);
        $response->assertSee('admin-sidebar');
        $response->assertSee('Armada dan pengemudi');
    }

    public function test_driver_simulator_renders_successfully(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get(route('driver.index'));
        $response->assertStatus(200);
        $response->assertSee('Aplikasi sopir');
    }

    public function test_order_show_renders_with_map_fallback(): void
    {
        $user = User::first();
        $order = Order::first();
        $response = $this->actingAs($user)->get(route('admin.orders.show', $order));
        $response->assertStatus(200);
        $response->assertSee('orderRouteMap');
        $response->assertSee('Aktifkan JavaScript untuk melihat rute perjalanan GPS');
    }

    public function test_edge_to_edge_footer_and_navbar_render_responsively(): void
    {
        $response = $this->get(route('landing.index'));
        $response->assertStatus(200);

        // Edge-to-edge navbar
        $response->assertSee('id="tfNavbarWrapper"', false);
        $response->assertSee('2xl:px-20', false);

        // Edge-to-edge footer with 5 columns and dash (-) bullet markers
        $response->assertSee('Solusi Platform');
        $response->assertSee('Akses Cepat');
        $response->assertSee('Bantuan &amp; Sales', false);
        $response->assertSee('Regulasi &amp; Data', false);
        $response->assertSee('—', false);
        $response->assertSee('v2.4 Production');
        $response->assertSee('overflow-x-hidden');
    }

    public function test_operational_admin_accesses_operational_dashboard(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@trackfleet.id'],
            ['name' => 'Arjuna Pratama', 'password' => bcrypt('password123'), 'role' => User::ROLE_OPERATIONAL]
        );
        $admin->update(['role' => User::ROLE_OPERATIONAL]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Dashboard Operasional &amp; Dispatch', false);
        $response->assertSee('liveFleetMap');
        $response->assertSee('Armada Dalam Perjalanan');
        $response->assertDontSee('Total Revenue Masuk');
    }

    public function test_finance_manager_redirects_and_accesses_finance_dashboard(): void
    {
        $finance = User::firstOrCreate(
            ['email' => 'innike@trackfleet.id'],
            ['name' => 'Innike Putri', 'password' => bcrypt('password123'), 'role' => User::ROLE_FINANCE]
        );
        $finance->update(['role' => User::ROLE_FINANCE]);

        // When finance user hits /admin, they get redirected to /admin/finance
        $response = $this->actingAs($finance)->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.finance'));

        // Direct access to /admin/finance
        $financeResponse = $this->actingAs($finance)->get(route('admin.finance'));
        $financeResponse->assertStatus(200);
        $financeResponse->assertSee('Dashboard Keuangan &amp; Pengendali Margin', false);
        $financeResponse->assertSee('Total Nilai Tagihan (Omzet)');
        $financeResponse->assertSee('Laba Kotor Bersih');
        $financeResponse->assertSee('Margin Guard');
        $financeResponse->assertSee('Buku Besar Tagihan &amp; Penerbitan Invoice', false);
    }
}
