<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $posts = Post::with(['user', 'likes'])->latest()->whereNull('deleted_at')->paginate(20);
        $liked_url = Storage::url('like_color.svg');
        $unliked_url = Storage::url('like.svg');
        return view('/home', [
            'posts' => $posts
        ], compact('liked_url', 'unliked_url'));
    }
}