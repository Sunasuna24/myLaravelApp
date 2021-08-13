@extends('layouts.app')
@section('content')
<div class="pt-12 pb-6">
    {{-- 登録成功セッション --}}
    @if (session('register_success'))
    <div class="mb-4">
        <div class="bg-green-100 border-green-400 text-green-700 border rounded w-full py-2 px-3">{{ session('register_success') }}</div>
    </div>
    @endif
    {{-- ログイン成功セッション --}}
    @if (session('login_success'))
    <div class="mb-4">
        <div class="bg-blue-100 border-blue-400 text-blue-700 border rounded w-full py-2 px-3">{{ session('login_success') }}</div>
    </div>
    @endif
    {{-- 投稿成功セッション --}}
    @if (session('post_success'))
    <div class="mb-4">
        <div class="bg-green-100 border-green-400 text-green-700 border rounded w-full py-2 px-3">{{ session('post_success') }}</div>
    </div>
    @endif
    {{-- 削除成功セッション --}}
    @if (session('delete_success'))
    <div class="mb-4">
        <div class="bg-green-100 border-green-400 text-green-700 border rounded w-full py-2 px-3">{{ session('delete_success') }}</div>
    </div>
    @endif
    @if ($posts->count())
    @foreach ($posts as $post)
    <div class="bg-white rounded overflow-hidden shadow-lg mb-6">
        <div class="px-6 py-4">
            <div class="flex mb-4 justify-between">
                <div class="flex items-center">
                    <h3 class="font-bold text-xl"><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></h3>@if ($post->created_at->timestamp !== $post->updated_at->timestamp)<span class="text-sm text-gray-400 ml-1">(edited)</span>@endif
                    <span class="text-base text-gray-600 ml-2">-</span>
                    <span class="text-sm text-gray-600 ml-2 mr-4">{{ $post->created_at->diffForHumans() }}</span>
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="my-auto">
                        @csrf
                        @if (!$post->likedBy(auth()->user()))
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
                </div>
                <div class="flex items-center text-gray-400 hover:text-gray-600"><a href="{{ route('user', $post->user) }}">@<span>{{ $post->user->name }}</span></a></div>
            </div>
            <p class="text-gray-700 text-base">{{ $post->content }}</p>
        </div>
    </div>
    @endforeach
    <div class="px-0.5">{{ $posts->links() }}</div>
    @else
    <p>最初の投稿をしましょう！</p>
    @endif
</div>
@endsection