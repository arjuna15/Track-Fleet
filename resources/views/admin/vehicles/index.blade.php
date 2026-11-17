@extends('layouts.app')

@section('title', 'Armada dan pengemudi — TrackFleet')
@section('page_title', 'Armada & Sopir')
@section('meta_description', 'Manajemen unit kendaraan logistik, penugasan pengemudi Trans-Jawa, dan telemetri lokasi pool real-time.')

@section('content')
<div class="px-6 sm:px-8 lg:px-10 pb-12 space-y-6 max-w-[1600px] mx-auto w-full">
    
    <!-- Top Breadcrumb & Heading -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-1 text-xs text-slate-400 font-medium">
        <div class="flex items-center gap-2">
            <span class="font-bold text-[#1A1D1F]">Armada dan Pengemudi</span>
            <span class="text-slate-300">•</span>
            <span>{{ $vehicles->count() }} Unit Terdaftar</span>
        </div>

        <button id="openNewVehicle" type="button" aria-haspopup="dialog" aria-controls="modalNewVehicle" onclick="openTfModal('modalNewVehicle', this)" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-xs font-bold text-white bg-[#1A1D1F] hover:bg-black shadow-sm transition">
            <i data-lucide="plus" class="w-3.5 h-3.5"></i>
            <span>+ Tambah Truk Baru</span>
        </button>
    </div>

    <!-- 4 Fleet KPI Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
        
        <!-- Total Armada -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Total Unit Truk</span>
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-700">
                    <i data-lucide="truck" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-[#1A1D1F] font-mono">
                {{ $vehicles->count() }} Unit
            </div>
            <div class="text-xs text-slate-400 font-medium">
                Mencakup CDD, Fuso, Tronton, &amp; Trailer
            </div>
        </div>

        <!-- Siaga di Pool -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Siaga di Pool (Idle)</span>
                <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i data-lucide="warehouse" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-emerald-700 font-mono">
                {{ $idleCount }} Unit
            </div>
            <div class="text-xs text-emerald-700 font-semibold flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Siap menerima penugasan</span>
            </div>
        </div>

        <!-- Dalam Perjalanan -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Dalam Perjalanan (Aktif)</span>
                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i data-lucide="navigation" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-[#1A1D1F] font-mono">
                {{ $inTransitCount }} Unit
            </div>
            <div class="text-xs text-slate-400 font-medium flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Mengirim kargo di jalur Trans-Jawa</span>
            </div>
        </div>

        <!-- Perawatan & Servis -->
        <div class="bg-white rounded-[24px] p-5 sm:p-6 border border-slate-100 shadow-[0_4px_24px_rgba(0,0,0,0.02)] space-y-3">
            <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                <span>Perawatan / Bengkel</span>
                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center">
                    <i data-lucide="wrench" class="w-4 h-4"></i>
                </div>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-slate-800 font-mono">
                {{ $maintenanceCount }} Unit
            </div>
            <div class="text-xs text-slate-400">
                0 jadwal servis tertunda
            </div>
        </div>

    </div>

    <!-- Vehicles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($vehicles as $v)
        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md hover:border-brand-300 transition space-y-4">
            
            <!-- Card Header: Plate number & Status badge -->
            <div class="flex items-start justify-between gap-2">
                <div>
                    <!-- Indonesian License Plate Visual Frame -->
                    <div class="inline-block px-2.5 py-1 rounded-lg bg-slate-900 text-white font-mono font-black text-sm tracking-widest border border-slate-700 shadow-sm">
                        {{ $v->plate_number }}
                    </div>
                    <div class="text-xs font-bold text-brand-600 mt-1 flex items-center gap-1">
                        <i data-lucide="truck" class="w-3.5 h-3.5"></i>
                        <span>{{ str_replace('_', ' ', $v->truck_type) }}</span>
                    </div>
                </div>

                @php 
                    $vehicleStatus = [
                        'in_transit' => 'Dalam perjalanan',
                        'idle' => 'Siaga di Pool',
                        'maintenance' => 'Perawatan'
                    ]; 
                    $statusStyles = [
                        'in_transit' => 'bg-indigo-50 text-indigo-800 border-indigo-200',
                        'idle' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                        'maintenance' => 'bg-amber-50 text-amber-800 border-amber-200',
                    ];
                @endphp
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase border {{ $statusStyles[$v->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                    {{ $vehicleStatus[$v->status] ?? ucfirst(str_replace('_', ' ', $v->status)) }}
                </span>
            </div>

            <!-- Card Body: Details & Driver Info -->
            <div class="p-3 bg-slate-50/80 rounded-xl border border-slate-200/70 space-y-2 text-xs">
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Vendor Mitra:</span>
                    <span class="font-bold text-slate-800">{{ $v->vendorPartner->name ?? 'Internal PT LDN' }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Pengemudi:</span>
                    <span class="font-bold text-slate-900">{{ $v->driver_name }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-slate-500">Kontak HP:</span>
                    <a href="tel:{{ $v->driver_phone }}" class="font-mono font-medium text-brand-600 hover:underline">{{ $v->driver_phone }}</a>
                </div>
                <div class="flex items-center justify-between pt-1 border-t border-slate-200/60">
                    <span class="text-slate-500">Posisi Terakhir:</span>
                    <span class="font-medium text-slate-700 text-right truncate max-w-[170px]" title="{{ $v->current_location_name ?? 'Garasi Pool' }}">
                        {{ $v->current_location_name ?? 'Garasi Pool' }}
                    </span>
                </div>
            </div>

            <!-- Card Footer: Telemetry & Link to Driver App -->
            <div class="pt-2 flex items-center justify-between text-[11px] text-slate-500 border-t border-slate-100 font-medium">
                <div class="flex items-center gap-1.5 font-mono text-[10px]">
                    <span class="w-1.5 h-1.5 rounded-full {{ $v->last_ping_at ? 'bg-emerald-500 animate-pulse' : 'bg-slate-400' }}"></span>
                    <span>{{ $v->last_ping_at ? $v->last_ping_at->diffForHumans() : 'Belum ada ping' }}</span>
                </div>
                <a href="{{ route('driver.index', ['order_id' => $v->orders->first()?->id]) }}" class="px-2.5 py-1 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200/80 text-[11px] font-bold transition flex items-center gap-1">
                    <i data-lucide="smartphone" class="w-3 h-3 text-amber-600"></i>
                    <span>Simulasi Sopir →</span>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-2xl border border-slate-200/90 p-12 text-center space-y-4">
            <div class="w-20 h-20 mx-auto rounded-3xl bg-gradient-to-br from-blue-50 to-indigo-50 text-brand-600 flex items-center justify-center border border-blue-100 shadow-sm">
                <i data-lucide="truck" class="w-10 h-10" aria-hidden="true"></i>
            </div>
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Belum Ada Kendaraan Terdaftar</h2>
                <p class="mt-1.5 text-sm text-slate-500 max-w-md mx-auto">
                    Armada yang didaftarkan akan muncul di sini. Mulai dengan menambahkan unit truk pertama untuk operasional dispatch.
                </p>
            </div>
            <div>
                <button type="button" onclick="openTfModal('modalNewVehicle', document.getElementById('openNewVehicle'))" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-bold text-xs shadow-md shadow-brand-500/25 transition">
                    <i data-lucide="plus-circle" class="w-4 h-4" aria-hidden="true"></i>
                    <span>Tambah Armada Pertama</span>
                </button>
            </div>
        </div>
        @endforelse
    </div>

</div>

<!-- Modal: New Vehicle Creation -->
<div id="modalNewVehicle" role="dialog" aria-modal="true" aria-labelledby="newVehicleTitle" aria-hidden="true" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-3 sm:p-4 hidden">
    <div class="bg-white rounded-2xl max-w-lg w-full p-5 sm:p-6 shadow-2xl border border-slate-200 max-h-[92vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-4 border-b border-slate-200">
            <div>
                <h3 id="newVehicleTitle" class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="truck" class="w-5 h-5 text-brand-600"></i>
                    <span>Tambah Unit Armada Baru</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Daftarkan nomor polisi, jenis truk, dan penugasan pengemudi.</p>
            </div>
            <button type="button" data-modal-close aria-label="Tutup formulir armada" onclick="closeTfModal('modalNewVehicle')" class="p-1.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <form action="{{ route('admin.vehicles.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf

            @if($errors->any())
                <div id="vehicleValidationSummary" role="alert" tabindex="-1" class="rounded-xl border border-rose-200 bg-rose-50 p-4 text-xs text-rose-900">
                    <p class="font-bold">Periksa kembali data armada:</p>
                    <ul class="mt-1.5 list-inside list-disc space-y-1">
                        @foreach($errors->messages() as $field => $messages)
                            <li>{{ $messages[0] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="vehicle-plate_number" class="block text-xs font-bold text-slate-700 mb-1">Nomor Polisi (Plat Nomor)</label>
                <input id="vehicle-plate_number" type="text" name="plate_number" value="{{ old('plate_number') }}" required placeholder="Contoh: B 9981 UXV" class="w-full px-3 py-2 text-xs font-mono font-bold rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500 uppercase">
                @error('plate_number')<p class="mt-1 text-xs text-rose-700">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="vehicle-truck_type" class="block text-xs font-bold text-slate-700 mb-1">Tipe Kendaraan Truk</label>
                <select id="vehicle-truck_type" name="truck_type" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Pilih Tipe Kendaraan</option>
                    <option value="CDD_BOX" @selected(old('truck_type') === 'CDD_BOX')>CDD Box (Kapasitas 5 Ton)</option>
                    <option value="CDE_ENGKEL" @selected(old('truck_type') === 'CDE_ENGKEL')>CDE Engkel (Kapasitas 2.5 Ton)</option>
                    <option value="FUSO_BAK" @selected(old('truck_type') === 'FUSO_BAK')>Fuso Bak Terbuka (Kapasitas 8 Ton)</option>
                    <option value="TRONTON_WINGBOX" @selected(old('truck_type') === 'TRONTON_WINGBOX')>Tronton Wingbox (Kapasitas 15 Ton)</option>
                    <option value="TRAILER_40FT" @selected(old('truck_type') === 'TRAILER_40FT')>Trailer 40ft Kontainer (Kapasitas 25 Ton)</option>
                </select>
                @error('truck_type')<p class="mt-1 text-xs text-rose-700">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="vehicle-vendor_partner_id" class="block text-xs font-bold text-slate-700 mb-1">Vendor Pemilik Armada</label>
                <select id="vehicle-vendor_partner_id" name="vendor_partner_id" required class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    <option value="">Pilih Vendor</option>
                    @foreach($vendors as $vnd)
                        <option value="{{ $vnd->id }}" @selected(old('vendor_partner_id') == $vnd->id)>{{ $vnd->name }} ({{ $vnd->city }})</option>
                    @endforeach
                </select>
                @error('vendor_partner_id')<p class="mt-1 text-xs text-rose-700">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="vehicle-driver_name" class="block text-xs font-bold text-slate-700 mb-1">Nama Pengemudi</label>
                    <input id="vehicle-driver_name" type="text" name="driver_name" value="{{ old('driver_name') }}" required placeholder="Contoh: Joko Susanto" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    @error('driver_name')<p class="mt-1 text-xs text-rose-700">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="vehicle-driver_phone" class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon Pengemudi</label>
                    <input id="vehicle-driver_phone" type="text" name="driver_phone" value="{{ old('driver_phone') }}" required placeholder="Contoh: 081299887766" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                    @error('driver_phone')<p class="mt-1 text-xs text-rose-700">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="vehicle-current_location_name" class="block text-xs font-bold text-slate-700 mb-1">Lokasi Garasi / Pool Saat Ini</label>
                <input id="vehicle-current_location_name" type="text" name="current_location_name" value="{{ old('current_location_name') }}" placeholder="Contoh: Pool Cikarang Barat, Bekasi" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
                @error('current_location_name')<p class="mt-1 text-xs text-rose-700">{{ $message }}</p>@enderror
            </div>

            <div class="pt-4 border-t border-slate-200 flex items-center justify-end gap-3">
                <button type="button" onclick="closeTfModal('modalNewVehicle')" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-brand-600 hover:bg-brand-500 shadow-md shadow-brand-500/25 transition">
                    Simpan Unit Armada
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
