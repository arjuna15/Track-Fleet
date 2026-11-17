<div class="space-y-6">
    
    <!-- Active Persona Card (1-Click Switcher) -->
    <div class="p-3.5 rounded-2xl bg-white border border-slate-200/70 shadow-[0_2px_10px_rgba(0,0,0,0.03)] text-xs">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] uppercase font-bold tracking-wider text-slate-400">Aktif</span>
            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold font-mono {{ auth()->user()->isFinance() ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-brand-50 text-brand-700 border border-brand-200' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ auth()->user()->isFinance() ? 'bg-emerald-500' : 'bg-brand-500' }}"></span>
                <span>{{ auth()->user()->roleLabel() }}</span>
            </span>
        </div>
        
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-full bg-[#1A1D1F] text-white font-black text-xs flex items-center justify-center shadow-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <div class="min-w-0 flex-1">
                <div class="text-xs font-bold text-[#1A1D1F] truncate">{{ auth()->user()->name }}</div>
                <div class="text-[10px] text-slate-600 truncate font-mono">{{ auth()->user()->email }}</div>
            </div>
        </div>

        <!-- 1-Click Role Switcher -->
        <div class="mt-2.5 pt-2 border-t border-slate-100">
            <form action="{{ route('admin.switch-persona') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-between px-2.5 py-1.5 rounded-xl bg-slate-100/80 hover:bg-slate-200/70 text-[11px] font-bold text-slate-700 hover:text-black transition group">
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="arrow-left-right" class="w-3.5 h-3.5 text-slate-500 group-hover:rotate-180 transition-transform duration-300"></i>
                        <span>Ganti ke {{ auth()->user()->isFinance() ? 'Operasional' : 'Keuangan' }}</span>
                    </span>
                    <span class="font-mono text-[9px] bg-white px-1.5 py-0.5 rounded text-slate-600 border border-slate-200">1-Klik</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Navigation Section: Bento Style Links -->
    <div class="space-y-1">
        @if(auth()->user()->isFinance())
            <!-- Finance Dashboard -->
            <a href="{{ route('admin.finance') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60' => request()->routeIs('admin.finance'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 font-semibold' => !request()->routeIs('admin.finance'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="layout-grid" class="w-4 h-4 {{ request()->routeIs('admin.finance') ? 'text-[#1A1D1F]' : 'text-slate-400 group-hover:text-slate-700' }} transition"></i>
                    <span>Dashboard</span>
                </div>
                <span class="text-[9px] font-mono px-2 py-0.5 rounded-full {{ request()->routeIs('admin.finance') ? 'bg-emerald-50 text-emerald-700 font-bold' : 'bg-slate-200/60 text-slate-600' }}">Margin</span>
            </a>

            <!-- Orders & Margins -->
            <a href="{{ route('admin.orders.index') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60' => request()->routeIs('admin.orders.*'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 font-semibold' => !request()->routeIs('admin.orders.*'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="package" class="w-4 h-4 {{ request()->routeIs('admin.orders.*') ? 'text-[#1A1D1F]' : 'text-slate-400 group-hover:text-slate-700' }} transition"></i>
                    <span>Pesanan &amp; Margin</span>
                </div>
                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
            </a>

            <!-- Vehicles & Vendors -->
            <a href="{{ route('admin.vehicles.index') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60' => request()->routeIs('admin.vehicles.*'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 font-semibold' => !request()->routeIs('admin.vehicles.*'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="truck" class="w-4 h-4 {{ request()->routeIs('admin.vehicles.*') ? 'text-[#1A1D1F]' : 'text-slate-400 group-hover:text-slate-700' }} transition"></i>
                    <span>Armada &amp; Vendor</span>
                </div>
                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
            </a>

            <!-- Operational Review -->
            <a href="{{ route('admin.operational') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-medium transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60 font-bold' => request()->routeIs('admin.operational') || request()->routeIs('admin.dashboard'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60' => !request()->routeIs('admin.operational') && !request()->routeIs('admin.dashboard'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="navigation" class="w-4 h-4 text-slate-400 group-hover:text-slate-700 transition"></i>
                    <span>Tinjau Operasional</span>
                </div>
            </a>
        @else
            <!-- Operational Dashboard -->
            <a href="{{ route('admin.operational') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60' => request()->routeIs('admin.dashboard') || request()->routeIs('admin.operational'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 font-semibold' => !request()->routeIs('admin.dashboard') && !request()->routeIs('admin.operational'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="layout-grid" class="w-4 h-4 {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.operational') ? 'text-[#1A1D1F]' : 'text-slate-400 group-hover:text-slate-700' }} transition"></i>
                    <span>Dashboard</span>
                </div>
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            </a>

            <!-- Orders & Dispatches -->
            <a href="{{ route('admin.orders.index') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60' => request()->routeIs('admin.orders.*'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 font-semibold' => !request()->routeIs('admin.orders.*'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="package" class="w-4 h-4 {{ request()->routeIs('admin.orders.*') ? 'text-[#1A1D1F]' : 'text-slate-400 group-hover:text-slate-700' }} transition"></i>
                    <span>Pesanan &amp; Surat Jalan</span>
                </div>
                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
            </a>

            <!-- Vehicles & Drivers -->
            <a href="{{ route('admin.vehicles.index') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-bold transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60' => request()->routeIs('admin.vehicles.*'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 font-semibold' => !request()->routeIs('admin.vehicles.*'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="truck" class="w-4 h-4 {{ request()->routeIs('admin.vehicles.*') ? 'text-[#1A1D1F]' : 'text-slate-400 group-hover:text-slate-700' }} transition"></i>
                    <span>Armada &amp; Sopir</span>
                </div>
                <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
            </a>

            <!-- Finance Review -->
            <a href="{{ route('admin.finance') }}" @class([
                'flex items-center justify-between px-3.5 py-2.5 rounded-2xl text-xs font-medium transition group',
                'bg-white text-[#1A1D1F] shadow-[0_2px_12px_rgba(0,0,0,0.05)] border border-slate-200/60 font-bold' => request()->routeIs('admin.finance'),
                'text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60' => !request()->routeIs('admin.finance'),
            ])>
                <div class="flex items-center gap-3">
                    <i data-lucide="banknote" class="w-4 h-4 text-slate-400 group-hover:text-slate-700 transition"></i>
                    <span>Tinjau Keuangan</span>
                </div>
                <span class="text-[9px] font-mono px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 font-bold">Margin</span>
            </a>
        @endif
    </div>

    <!-- External Shortcuts (Driver app & tracking) -->
    <div class="pt-4 border-t border-slate-200/60 space-y-1">
        <a href="{{ route('driver.index') }}" class="flex items-center justify-between px-3.5 py-2 rounded-2xl text-xs font-medium text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 transition group">
            <div class="flex items-center gap-3">
                <i data-lucide="smartphone" class="w-4 h-4 text-slate-400 group-hover:text-slate-700"></i>
                <span>Aplikasi Sopir</span>
            </div>
            <i data-lucide="external-link" class="w-3 h-3 text-slate-400"></i>
        </a>
        <a href="{{ route('tracking.public') }}" class="flex items-center justify-between px-3.5 py-2 rounded-2xl text-xs font-medium text-slate-500 hover:text-[#1A1D1F] hover:bg-white/60 transition group">
            <div class="flex items-center gap-3">
                <i data-lucide="compass" class="w-4 h-4 text-slate-400 group-hover:text-slate-700"></i>
                <span>Portal Pelacakan</span>
            </div>
            <i data-lucide="external-link" class="w-3 h-3 text-slate-400"></i>
        </a>
    </div>

</div>
