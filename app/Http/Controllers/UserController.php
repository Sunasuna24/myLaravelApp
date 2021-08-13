<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(User $user)
    {
        $posts = Post::with(['user', 'likes'])->where('user_id', '=', $user->id)->latest()->paginate(10);
        $liked_url = Storage::url('like_color.svg');
        $unliked_url = Storage::url('like.svg');
        return view('user', [
            'posts' => $posts,
            'user' => $user
        ], compact('liked_url', 'unliked_url'));
    }

    public function edit(User $user)
    {
        if ($user->id !== auth()->user()->id) {
            return back();
        }
        return view('user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($user->id !== auth()->user()->id) {
            return back();
        }
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);
        $request->user()->where('id', $id)->update([
            'name' => $request->name
        ]);
        return redirect()->route('user.edit', ['user' => $id])->with('user_update_success', '正常に更新されました');
    }
}