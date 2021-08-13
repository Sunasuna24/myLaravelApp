@extends('layouts.app')
@section('content')
<div class="pt-12 pb-6">
    <div class="mb-8 flex items-center justify-center self-end">
        <h1 class="text-3xl font-medium text-center">{{ $user->name }}</h1>
        @if ($user->id === auth()->user()->id)
            <span class="text-gray-400 px-3">-</span>
            <a href="{{ route('user.edit', auth()->user()->id) }}" class="flex items-center"><i class="fas fa-pen text-gray-400 hover:text-green-400"></i></a>
        @endif
    </div>
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