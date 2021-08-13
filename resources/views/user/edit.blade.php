@extends('layouts.app')
@section('content')
<div class="flex justify-center py-10 px-3">
    <div class="w-full max-w-md bg-white px-8 pt-6 pb-6 mb-4 rounded shadow-md">
        {{-- 更新成功セッション --}}
        @if (session('user_update_success'))
        <div class="mb-4">
            <div class="bg-green-100 border-green-400 text-green-700 border rounded w-full py-2 px-3">{{ session('user_update_success') }}</div>
        </div>
        @endif
        <h1 class="mb-8 text-3xl text-center">ユーザー情報</h1>
        <form action="{{ route('user.edit', auth()->user()->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="name" class="block text-gray-darker text-sm font-bold mb-2">ユーザー名</label>
                <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker @error('name') border-red-500 @enderror" placeholder="ユーザー名" value="{{ $user->name }}">
                @error('name')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="email" class="block text-gray-darker text-sm font-bold mb-2">メールアドレス</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker @error('email') border-red-500 @enderror" placeholder="{{ $user->email }}" disabled>
                @error('email')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <!-- <div class="mb-6">
                <label for="password" class="block text-gray-darker text-sm font-bold mb-2">パスワード</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker @error('password') border-red-500 @enderror" placeholder="**********">
                @error('password')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-darker text-sm font-bold mb-2">パスワード再入力</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker mb-3 @error('password_confirmation') border-red-500 @enderror" placeholder="**********">
                @error('password_confirmation')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div> -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">更新する</button>
        </form>
    </div>
</div>
@endsection