<div class="space-y-4">
    <!-- Bottom Utility Controls (Like Reference Image) -->
    <div class="flex items-center justify-between px-2 text-slate-400">
        <button type="button" class="w-8 h-8 rounded-full bg-white border border-slate-200/80 flex items-center justify-center text-slate-500 hover:text-[#1A1D1F] hover:bg-slate-50 shadow-sm transition" title="Search Shortcut">
            <i data-lucide="search" class="w-3.5 h-3.5"></i>
        </button>
        <div class="flex items-center bg-white border border-slate-200/80 rounded-full p-1 shadow-sm">
            <button type="button" class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[#1A1D1F]" title="Light Mode">
                <i data-lucide="sun" class="w-3 h-3"></i>
            </button>
            <button type="button" class="w-6 h-6 rounded-full flex items-center justify-center text-slate-400 hover:text-slate-600" title="Dark Mode (Auto)">
                <i data-lucide="moon" class="w-3 h-3"></i>
            </button>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" title="Keluar dari akun (Logout)" class="w-8 h-8 rounded-full bg-white border border-slate-200/80 flex items-center justify-center text-slate-400 hover:text-rose-600 hover:border-rose-200 shadow-sm transition">
                <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
            </button>
        </form>
    </div>

    <!-- User Profile Bar -->
    <div class="p-2.5 rounded-2xl bg-white border border-slate-200/70 shadow-[0_2px_8px_rgba(0,0,0,0.02)] flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-full bg-[#1A1D1F] text-white font-bold flex items-center justify-center text-xs shrink-0 shadow-sm">
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        </div>
        <div class="min-w-0 flex-1">
            <div class="text-xs font-bold text-[#1A1D1F] truncate">{{ auth()->user()->name }}</div>
            <div class="flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span class="text-[10px] font-semibold text-slate-500 font-mono">{{ auth()->user()->roleLabel() }}</span>
            </div>
        </div>
    </div>
</div>
