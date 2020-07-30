<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->where('status', 'Published')->paginate(3);
        return view('welcome', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        return view('posts.post-show', compact('post'));
    }

    public function loadMorePost(Request $request)
    {
        $count = $request->add;
        $posts = Post::orderBy('created_at', 'DESC')->where('status', 'Published')->paginate($count);
        $html = view('posts.posts-add', compact('posts'))->render();
        return response()->json(array('result' => $html));
    }
}
