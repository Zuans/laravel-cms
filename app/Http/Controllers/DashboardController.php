<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showInfo()
    {
        return view('dashboard.info');
    }

    public function showPostSetting()
    {
        $this->authorize('update post');
        $totalPost = Post::all()->count();
        $publishPost = Post::where('status', 'Published')->count();
        $draftPost = Post::where('status', 'Drafted')->count();
        $datas = Post::orderBy('created_at', 'desc')->paginate(7);
        return view('dashboard.Post-setting', [
            "datas" => $datas,
            "draftPost" => $draftPost,
            "publishPost" => $publishPost,
            "totalPost" => $totalPost
        ]);
    }

    public function showYourPost()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $datas = $user->Posts()->orderBy('created_at', 'DESC')->paginate(5);
        $publishTotal = $user->Posts()->where('status', 'Published')->get();
        $draftTotal = $user->Posts()->where('status', 'Drafted')->get();
        $countData = $user->Posts()->get();
        return view('dashboard.Your-post', [
            "countData" => $countData,
            "datas" => $datas,
            "publishTotal" => $publishTotal,
            "draftTotal" => $draftTotal
        ]);
    }


    public function showAddPost()
    {
        return view('dashboard.Add-post');
    }
}
