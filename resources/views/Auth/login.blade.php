@extends('layouts.app')
@section('content')
<div class="flex justify-center py-10 px-3">
    <div class="w-full max-w-md bg-white px-8 pt-6 pb-6 mb-4 rounded shadow-md">
        <h1 class="mb-8 text-3xl text-center">ログイン</h1>
        @if (session('login_error'))
        <div class="mb-4">
            <div class="bg-red-100 border-red-400 text-red-700 border rounded w-full py-2 px-3">{{ session('login_error') }}</div>
        </div>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-6">
                <label for="email" class="block text-gray-darker text-sm font-bold mb-2">メールアドレス</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker @error('email') border-red-500 @enderror" placeholder="email" value="{{ old('email') }}">
                @error('email')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-darker text-sm font-bold mb-2">パスワード</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker mb-3 @error('password') border-red-500 @enderror" placeholder="**********">
                @error('password')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">ログインする</button>
        </form>
    </div>
</div>
@endsection
