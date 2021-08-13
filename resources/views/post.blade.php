@extends('layouts.app')
@section('content')
<div class="flex justify-center py-10 px-3">
    <div class="w-full max-w-xl bg-white px-8 pt-6 pb-6 mb-4 rounded shadow-md">
        <h1 class="mb-8 text-3xl text-center">投稿</h1>
        <form action="{{ route('posts') }}" method="post">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-darker text-sm font-bold mb-2">タイトル</label>
                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker @error('title') border-red-500 @enderror" placeholder="タイトル" value="{{ old('title') }}">
                @error('title')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-darker text-sm font-bold mb-2">本文</label>
                <textarea name="content" id="content" cols="30" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-darker @error('content') border-red-500 @enderror" placeholder="本文を入力">{{ old('content') }}</textarea>
                @error('content')
                <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">投稿する</button>
        </form>
    </div>
</div>
@endsection