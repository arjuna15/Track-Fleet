@extends('layouts.app')

@section('title', 'Masuk — TrackFleet')
@section('meta_description', 'Masuk ke command center TrackFleet untuk mengelola pesanan, armada, dan margin pengiriman.')

@section('content')
<div class="min-h-screen grid lg:grid-cols-2">

    <!-- Brand panel -->
    <div class="hidden lg:flex flex-col justify-between bg-gradient-to-br from-slate-900 via-slate-900 to-slate-950 text-white p-12 lg:p-16 relative overflow-hidden border-r border-slate-800/80">
        <!-- Ambient accents -->
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-brand-600/15 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 -left-12 w-80 h-80 rounded-full bg-teal-500/10 blur-3xl pointer-events-none"></div>

        <a href="{{ route('landing.index') }}" class="relative inline-flex items-center gap-2 group w-fit">
            <span class="text-2xl font-black tracking-tight text-white transition transform group-hover:scale-[1.02]">
                Track<span class="text-brand-500">Fleet</span>
            </span>
            <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400 bg-slate-800/90 px-2 py-0.5 rounded-full border border-slate-700/60 ml-2">Enterprise</span>
        </a>

        <div class="relative space-y-6 max-w-md">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-brand-500/10 text-brand-400 border border-brand-500/20">
                <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                <span>Sistem Operasional Logistik Terenkripsi</span>
            </div>

            <h2 class="text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight text-white">
                Kendali penuh atas kiriman &amp; margin armada.
            </h2>
            <p class="text-sm text-slate-400 leading-relaxed">
                Kelola dispatch pesanan, pantau posisi kendaraan live GPS, dan kunci margin keuntungan pengiriman tanpa kecolongan biaya solar &amp; tol.
            </p>

            <div class="pt-2 grid grid-cols-1 gap-3 text-xs text-slate-300">
                <div class="flex items-center gap-2.5">
                    <div class="w-5 h-5 rounded-md bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                    </div>
                    <span>Pantau armada real-time via smartphone driver</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="w-5 h-5 rounded-md bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                    </div>
                    <span>Deteksi dini margin berisiko (&lt;10%) secara otomatis</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="w-5 h-5 rounded-md bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                    </div>
                    <span>Bukti serah terima digital sah &amp; cetak faktur pajak</span>
                </div>
            </div>
        </div>

        <div class="relative flex items-center justify-between text-xs text-slate-500 pt-6 border-t border-slate-800/80">
            <span>&copy; {{ date('Y') }} PT Logistik Digital Nusantara</span>
            <span class="font-mono text-[11px] text-slate-600">v2.4 Production</span>
        </div>
    </div>

    <!-- Form panel -->
    <div class="flex flex-col justify-between min-h-screen p-6 sm:p-12 lg:p-16 bg-slate-900 lg:bg-white text-slate-900">
        <div class="flex justify-between items-center w-full">
            <a href="{{ route('landing.index') }}" class="lg:hidden text-2xl font-black text-white">
                Track<span class="text-brand-500">Fleet</span>
            </a>
            <a href="{{ route('landing.index') }}" class="text-xs font-semibold text-slate-400 lg:text-slate-500 hover:text-brand-600 ml-auto inline-flex items-center gap-1.5 transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke beranda</span>
            </a>
        </div>

        <div class="w-full max-w-sm mx-auto my-auto py-8">
            <div class="mb-6">
                <h1 class="text-2xl font-extrabold text-white lg:text-slate-950 tracking-tight">Masuk ke Command Center</h1>
                <p class="text-xs sm:text-sm text-slate-400 lg:text-slate-500 mt-1.5">Gunakan kredensial akun operasional resmi Anda.</p>
            </div>

            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-xs text-rose-700 flex items-start gap-2.5 animate-shake">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5 text-rose-600"></i>
                    <span class="leading-relaxed">{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login.attempt') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-300 lg:text-slate-700 mb-1.5">Email Akun</label>
                    <div class="relative">
                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-800 lg:bg-white border border-slate-700 lg:border-slate-300 text-white lg:text-slate-900 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition placeholder-slate-500"
                            placeholder="nama@trackfleet.id">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold text-slate-300 lg:text-slate-700">Kata Sandi</label>
                        <span class="text-[11px] text-slate-400">Min. 8 karakter</span>
                    </div>
                    <div class="relative">
                        <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl bg-slate-800 lg:bg-white border border-slate-700 lg:border-slate-300 text-white lg:text-slate-900 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition placeholder-slate-500"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 text-xs text-slate-400 lg:text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" value="1" class="w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                        <span>Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-bold text-sm shadow-lg shadow-brand-600/25 transition flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                    <i data-lucide="log-in" class="w-4 h-4"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <!-- Demo quick credentials card -->
            <div class="mt-6 p-4 rounded-xl bg-slate-800/80 lg:bg-slate-50 border border-slate-700 lg:border-slate-200 text-xs">
                <div class="font-bold text-slate-200 lg:text-slate-800 flex items-center justify-between mb-2.5">
                    <div class="flex items-center gap-1.5">
                        <i data-lucide="key-round" class="w-3.5 h-3.5 text-brand-400 lg:text-brand-600"></i>
                        <span>Akun Demo Cepat (Klik untuk Otomatis Isi)</span>
                    </div>
                </div>
                <div class="space-y-2 text-slate-400 lg:text-slate-600">
                    <button type="button" onclick="fillLogin('admin@trackfleet.id', 'password123')" class="w-full flex flex-wrap justify-between items-center p-2 rounded-lg bg-slate-900/60 lg:bg-white border border-slate-700/80 lg:border-slate-200 hover:border-brand-500 hover:bg-brand-50/50 transition text-left group">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                            <span class="font-bold text-slate-200 lg:text-slate-900 group-hover:text-brand-600">Admin Operasional (Arjuna)</span>
                        </div>
                        <code class="font-mono text-[11px] font-bold text-brand-400 lg:text-brand-600">admin@trackfleet.id</code>
                    </button>
                    <button type="button" onclick="fillLogin('innike@trackfleet.id', 'password123')" class="w-full flex flex-wrap justify-between items-center p-2 rounded-lg bg-slate-900/60 lg:bg-white border border-slate-700/80 lg:border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/50 transition text-left group">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="font-bold text-slate-200 lg:text-slate-900 group-hover:text-emerald-600">Manajer Keuangan (Innike)</span>
                        </div>
                        <code class="font-mono text-[11px] font-bold text-emerald-400 lg:text-emerald-600">innike@trackfleet.id</code>
                    </button>
                    <div class="text-[11px] text-slate-500 pt-1 flex items-center justify-between">
                        <span>Kata Sandi Default:</span>
                        <code class="font-mono font-bold text-slate-300 lg:text-slate-700">password123</code>
                    </div>
                </div>
            </div>

            <script>
                function fillLogin(email, password) {
                    document.getElementById('email').value = email;
                    document.getElementById('password').value = password;
                }
            </script>
        </div>

        <div class="text-center text-[11px] text-slate-500 pt-4">
            Dilindungi enkripsi TLS 1.3 &bull; Keamanan data sesuai UU PDP Indonesia
        </div>
    </div>
</div>
@endsection
