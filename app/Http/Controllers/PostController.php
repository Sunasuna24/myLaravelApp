<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        return view('post');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $request->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content
        ]);
        return redirect()->route('home')->with('post_success', '正常に投稿されました');
    }

    public function show($id)
    {
        $post = Post::with(['user', 'likes'])->find($id);
        $liked_url = Storage::url('like_color.svg');
        $unliked_url = Storage::url('like.svg');
        return view('show', compact('liked_url', 'unliked_url'))->with('post', $post);
    }

    public function edit($id)
    {
        $post = Post::with(['user', 'likes'])->find($id);
        return view('edit')->with('post', $post);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $request->user()->posts()->where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content
        ]);
        return redirect()->route('show', ['id' => $id])->with('update_success', '正常に更新されました');
    }

    public function destroy(Post $post, $id)
    {
        if (!$post->ownedBy(auth()->user())) {
            return redirect()->view('home');
        }
        $post->find($id)->delete();
        return redirect()->route('home')->with('delete_success', '正常に削除されました');
    }
}