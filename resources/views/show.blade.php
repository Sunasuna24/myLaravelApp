@extends('layouts.app')
@section('content')
{{-- ログイン成功セッション --}}
<div class="py-10 px-3 mx-auto max-w-3xl">
    @if (session('update_success'))
    <div class="mb-4">
        <div class="bg-green-100 border-green-400 text-green-700 border rounded w-full py-2 px-3">{{ session('update_success') }}</div>
    </div>
    @endif
    <div class="w-full max-w-3xl bg-white px-8 py-6 mb-4 rounded shadow-md">
        <h1 class="mt-8 mb-10 text-3xl text-center">{{ $post->title }}</h1>
        <div class="flex justify-end mb-5 items-center">
            @if (!$post->likedBy(auth()->user()))
            <form action="{{ route('posts.likes', $post) }}" method="post" class="my-auto">
                @csrf
                <button type="submit">
                    <img src="{{ $unliked_url }}" alt="" class="w-3 cursor-pointer">
                @else
                @method('DELETE')
                <button type="submit">
                    <img src="{{ $liked_url }}" alt="" class="w-3 cursor-pointer">
                @endif
                </button>
            </form>
            <span class="text-sm text-gray-600 ml-1">{{ $post->likes->count() }}</span>
            @if ($post->ownedBy(auth()->user()))
            <span class="text-gray-400 px-3">-</span>
            <a href="{{ route('edit', $post->id) }}" class="flex items-center"><i class="fas fa-pen text-gray-400 hover:text-green-400"></i></a>
            <span class="text-gray-400 mx-1">,</span>
            <form action="{{ route('destroy', $post->id) }}" method="post" class="my-auto">
                @csrf
                {{-- @method('DELETE') --}}
                <button><i class="fas fa-trash text-gray-400 hover:text-red-400"></i></button>
            </form>
            @endif
        </div>
        <div class="mb-6">
            <p class="text-base">{{ $post->content }}</p>
        </div>
        <div class="flex justify-end items-center">
            <a href="{{ route('user', $post->user) }}" class="text-gray-400 hover:text-gray-600">@<span>{{ $post->user->name }}</span></a>
            @if ($post->created_at->timestamp !== $post->updated_at->timestamp)
            <span class="text-sm text-gray-400 ml-2">(edited)</span>
            @endif
        </div>
    </div>
</div>
@endsection