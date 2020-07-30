<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Http\Requests\StorePost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $request->validated();
        if ($request->hasFile('thumbnail')) {
            // Get Name with ext
            $fileWithExt = $request->file('thumbnail')->getClientOriginalName();

            // Get Just name 
            $fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

            // Get extension
            $extension = $request->file('thumbnail')->getClientOriginalExtension();


            // Filename Store
            $fileStore = $fileName . '_' . time() . '.' . $extension;

            // Store img
            $path = $request->file('thumbnail')->storeAs('public/thumbnail/', $fileStore);
        } else {
            $fileStore = 'noimage.jpg';
        }

        // Save New Post
        $savePost = $user->Posts()->create([
            "author" => $request->author,
            "title" => $request->title,
            "excerpt" => $request->excerpt,
            "content" => $request->content,
            "status" => $request->status,
            "thumbnail" => $fileStore
        ]);

        return back()->with('success', "Post telah berhasil dibuat");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Post::where('id', $id)->first();
        return view('dashboard.Edit-post', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $validate = $request->validated();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $post = Post::where('id', $id)->first();

        // Delete if post has thumbnail
        if ($post->thumbnail != 'noimage.jpg') {
            Storage::delete('public/thumbnail/' . $post->thumbnail);
        }
        if ($request->hasFile('thumbnail')) {
            // File and ext
            $fileWithExt = $request->file('thumbnail')->getClientOriginalName();

            // Just namae
            $fileName = pathinfo($fileWithExt, PATHINFO_FILENAME);

            // Get ext file
            $ext = $request->file('thumbnail')->getClientOriginalExtension();

            //filename 
            $fileNameStore = $fileName . '_' . time() . '.' . $ext;

            // Save
            $path = $request->file('thumbnail')->storeAs('public/thumbnail', $fileNameStore);
        } else {
            $fileNameStore = "noimage.jpg";
        }

        // Update Post
        Post::where('id', $id)->update([
            "author" => $request->author,
            "title" => $request->title,
            "excerpt" => $request->excerpt,
            "content" => $request->content,
            "status" => $request->status,
            "thumbnail" => $fileNameStore
        ]);
        return back()->with('success', 'Post Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $post = Post::where('id', $id)->first();
        if ($post->thumbnail != 'noimage.jpg') {
            Storage::delete('public/thumbnail/' . $post->thumbnail);
        }
        $deletePost = Post::destroy($id);
        return back()->with('success', 'Data Berhasil dihapus');
    }

    public function search(Request $request)
    {
        $value = $request->value;
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        // Check if value is empty
        if ($value == "") {
            $datas = $user->Posts()->orderBy('created_at', 'DESC')->paginate(5);
            $datas->withPath('/dashboard/your-post-setting');
            $html = view('table.table-default', compact('datas'))->render();
            return response()->json(array('success' => true, 'result' => $html));
        }
        $datas = $user->Posts()->where(function (Builder $query) use ($value) {
            return $query->where('author', 'LIKE', "%{$value}%")->orWhere('title', 'LIKE', "%{$value}%");
        })->get();
        $table = view('table.table-post', compact('datas'))->render();
        return response()->json(array('success' => true, 'result' => $table));
    }

    public function adminSearch(Request $request)
    {
        // Check if value is empty
        if ($request->search == "") {
            $datas = Post::paginate(7);
            $datas->withPath('/dashboard/post-setting');
            $html = view('table.table-default', compact('datas'))->render();
            return response()->json(array("result" => $html));
        }
        $datas = Post::where('author', 'LIKE', "%{$request->search}%")->orWhere('title', 'LIKE', "%{$request->search}%")->get();
        $html = view('table.table-post', compact('datas'))->render();
        return response()->json(array('result' => $html));
    }
}
