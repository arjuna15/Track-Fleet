<header class="w-full mx-auto rounded-full @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) bg-slate-950/90 border-slate-800/90 shadow-[0_12px_40px_rgba(0,0,0,0.55)] text-white @else bg-white/95 border-slate-200/90 shadow-[0_12px_36px_rgba(0,0,0,0.08)] text-slate-900 @endif backdrop-blur-xl border px-4 sm:px-6 transition-all duration-300">
    <div class="flex items-center justify-between h-16">
        <!-- Brand Typography (Clean & Bold) -->
        <div class="flex items-center">
            <a href="{{ route('landing.index') }}" class="inline-block transition-transform duration-200 hover:scale-[1.02]">
                <span id="tfBrandText" class="text-xl sm:text-2xl font-black tracking-tight @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) text-white @else text-slate-950 @endif">
                    Track<span class="text-brand-500">Fleet</span>
                </span>
            </a>
        </div>

        <!-- Navigation Links with Pill Indicator -->
        <nav class="hidden md:flex items-center gap-1 @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) bg-slate-800/80 border-slate-700/60 text-slate-300 @else bg-slate-100/80 border-slate-200/80 text-slate-600 @endif p-1.5 rounded-full border font-medium text-xs backdrop-blur-md">
            <a href="{{ route('landing.index') }}" aria-current="{{ request()->routeIs('landing.index') ? 'page' : 'false' }}" @class([
                'px-4 py-1.5 rounded-full transition-all duration-200',
                'bg-brand-600 text-white font-bold shadow-sm' => request()->routeIs('landing.index'),
                'text-slate-300 hover:text-white hover:bg-slate-700/60' => request()->routeIs('tracking.public'),
                'text-slate-600 hover:text-slate-900 hover:bg-white/60' => !request()->routeIs('landing.index') && !request()->routeIs('tracking.public'),
            ])>Beranda</a>
            <a href="{{ route('landing.pricing') }}" aria-current="{{ request()->routeIs('landing.pricing') ? 'page' : 'false' }}" @class([
                'px-4 py-1.5 rounded-full transition-all duration-200',
                'bg-brand-600 text-white font-bold shadow-sm' => request()->routeIs('landing.pricing'),
                'text-slate-300 hover:text-white hover:bg-slate-700/60' => request()->routeIs('landing.index') || request()->routeIs('tracking.public'),
                'text-slate-600 hover:text-slate-900 hover:bg-white/60' => !request()->routeIs('landing.index') && !request()->routeIs('tracking.public') && !request()->routeIs('landing.pricing'),
            ])>Harga &amp; Paket</a>
            <a href="{{ route('tracking.public') }}" aria-current="{{ request()->routeIs('tracking.public') ? 'page' : 'false' }}" @class([
                'px-4 py-1.5 rounded-full transition-all duration-200 flex items-center gap-1.5',
                'bg-brand-600 text-white font-bold shadow-sm' => request()->routeIs('tracking.public'),
                'text-slate-300 hover:text-white hover:bg-slate-700/60' => request()->routeIs('landing.index'),
                'text-slate-600 hover:text-slate-900 hover:bg-white/60' => !request()->routeIs('landing.index') && !request()->routeIs('tracking.public'),
            ])>
                <i data-lucide="search" class="w-3.5 h-3.5 @if(request()->routeIs('tracking.public')) text-white @elseif(request()->routeIs('landing.index')) text-slate-300 @else text-slate-600 @endif"></i>
                Lacak kiriman
            </a>
        </nav>

        <!-- Action Button Group -->
        <div class="flex items-center space-x-1.5 sm:space-x-2.5">
            @auth
                <a href="{{ route('driver.index') }}" aria-current="{{ request()->routeIs('driver.*') ? 'page' : 'false' }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200/80 hover:bg-amber-100 transition shadow-sm">
                    <i data-lucide="smartphone" class="w-3.5 h-3.5 text-amber-600"></i>
                    <span>Aplikasi sopir</span>
                </a>

                <a href="{{ auth()->user()->isFinance() ? route('admin.finance') : route('admin.dashboard') }}" aria-current="{{ request()->routeIs('admin.*') ? 'page' : 'false' }}" class="inline-flex items-center gap-1.5 px-3 sm:px-4 py-1.5 rounded-full text-xs font-bold text-white bg-slate-900 hover:bg-brand-600 shadow-sm transition-all">
                    <i data-lucide="{{ auth()->user()->isFinance() ? 'banknote' : 'layout-dashboard' }}" class="w-4 h-4 text-brand-400"></i>
                    <span class="hidden sm:inline">{{ auth()->user()->isFinance() ? 'Keuangan' : 'Operasional' }}</span>
                </a>

                <!-- User Profile Badge & Logout -->
                <div class="flex items-center pl-1.5 sm:pl-2 ml-0.5 sm:ml-1 border-l @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) border-slate-700 @else border-slate-200 @endif gap-1.5 sm:gap-2">
                    <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-brand-600 to-indigo-600 text-white font-bold flex items-center justify-center text-[11px] shadow-sm shrink-0" title="{{ auth()->user()->email }}">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="hidden lg:block text-left text-[11px] leading-tight">
                        <div class="font-bold @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) text-white @else text-slate-800 @endif truncate max-w-[110px]">{{ auth()->user()->name }}</div>
                        <div class="text-[10px] font-semibold {{ auth()->user()->isFinance() ? 'text-emerald-400' : 'text-blue-400' }}">{{ auth()->user()->roleLabel() }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" title="Keluar dari akun" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-500 hover:bg-rose-500/10 transition">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 sm:gap-2 px-3.5 sm:px-5 py-2 rounded-full text-xs font-bold text-white @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) bg-brand-600 hover:bg-brand-500 shadow-lg shadow-brand-600/30 @else bg-slate-900 hover:bg-brand-600 shadow-md @endif transition-all">
                    <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                    <span>Masuk</span>
                </a>
            @endauth

            <!-- Mobile menu toggle -->
            <button type="button" id="tfMenuToggle" aria-expanded="false" aria-controls="tfMobileMenu" aria-label="Buka menu" class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-full @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) text-slate-200 hover:bg-slate-800 @else text-slate-700 hover:bg-slate-100 @endif transition">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    <!-- Mobile menu -->
    <div id="tfMobileMenu" class="md:hidden hidden border-t @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) border-slate-800 text-slate-200 @else border-slate-200/80 text-slate-700 @endif py-3 mobile-menu-enter">
        <nav class="flex flex-col gap-1 text-sm font-medium">
            <a href="{{ route('landing.index') }}" class="px-3 py-2 rounded-lg @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) hover:bg-slate-800/80 @else hover:bg-slate-100 @endif">Beranda</a>
            <a href="{{ route('landing.pricing') }}" class="px-3 py-2 rounded-lg @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) hover:bg-slate-800/80 @else hover:bg-slate-100 @endif">Harga &amp; Paket</a>
            <a href="{{ route('tracking.public') }}" class="px-3 py-2 rounded-lg @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) hover:bg-slate-800/80 @else hover:bg-slate-100 @endif flex items-center gap-2"><i data-lucide="search" class="w-4 h-4 text-brand-500"></i> Lacak kiriman</a>
            @auth
                <div class="border-t @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) border-slate-800 @else border-slate-200/60 @endif my-1 pt-1.5 space-y-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 px-3 block mb-1">Operasional Admin</span>
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) hover:bg-slate-800/80 @else hover:bg-slate-100 @endif flex items-center gap-2"><i data-lucide="layout-dashboard" class="w-4 h-4 text-brand-400"></i> Dashboard</a>
                    <a href="{{ route('admin.orders.index') }}" class="px-3 py-2 rounded-lg @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) hover:bg-slate-800/80 @else hover:bg-slate-100 @endif flex items-center gap-2"><i data-lucide="package" class="w-4 h-4 text-emerald-400"></i> Pesanan &amp; Margin</a>
                    <a href="{{ route('admin.vehicles.index') }}" class="px-3 py-2 rounded-lg @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) hover:bg-slate-800/80 @else hover:bg-slate-100 @endif flex items-center gap-2"><i data-lucide="truck" class="w-4 h-4 text-amber-400"></i> Armada Kendaraan</a>
                    <a href="{{ route('driver.index') }}" class="px-3 py-2 rounded-lg @if(request()->routeIs('landing.index') || request()->routeIs('tracking.public')) hover:bg-slate-800/80 text-amber-300 @else hover:bg-amber-50 text-amber-800 @endif flex items-center gap-2"><i data-lucide="smartphone" class="w-4 h-4"></i> Aplikasi Sopir (Driver)</a>
                </div>
            @endauth
        </nav>
    </div>
</header>
