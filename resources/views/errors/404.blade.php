@extends('layouts.app')

@section('title', 'Halaman tidak ditemukan — TrackFleet')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-brand-50 text-brand-600 mb-6 animate-float">
        <i data-lucide="package-search" class="w-10 h-10"></i>
    </div>
    <p class="text-6xl font-black text-slate-900 font-mono">404</p>
    <h1 class="text-xl font-bold text-slate-900 mt-3">Halaman tidak ditemukan</h1>
    <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">
        Sepertinya tautan yang Anda tuju sudah dipindahkan atau tidak pernah ada. Mari kembali ke jalur yang benar.
    </p>
    <div class="flex flex-wrap items-center justify-center gap-3 mt-8">
        <a href="{{ route('landing.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-brand-600 text-white text-sm font-bold shadow-md transition">
            <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Ke beranda
        </a>
        <a href="{{ route('tracking.public') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white hover:bg-slate-50 text-slate-700 text-sm font-bold border border-slate-200 shadow-sm transition">
            <i data-lucide="search" class="w-4 h-4 text-brand-600"></i> Lacak kiriman
        </a>
    </div>
</div>
@endsection
