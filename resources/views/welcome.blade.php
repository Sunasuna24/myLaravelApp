@extends('layouts.welcome')
@section('content')
<div class="pt-12 pb-6">
@if (session('logout_success'))
    <div class="mb-4">
        <div class="bg-blue-100 border-blue-400 text-blue-700 border rounded w-full py-2 px-3">{{ session('logout_success') }}</div>
    </div>
@endif
    <div class="py-32">
        <p class="py-8 text-7xl text-center font-bold text-gray-500">あなたの<span class="text-purple-500">思い</span>を伝えよう｡</p>
        <p class="py-5 text-4xl text-center">ようこそ、{{ config('app.name', 'Laravel') }}へ👋</p>
    </div>
</div>
@endsection