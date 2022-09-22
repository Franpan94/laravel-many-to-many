<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        //
        return view('admin.posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        $request->validate([
            'title'=>[
                'min:3',
                'max:255',
                'required',
                Rule::unique('posts')->ignore($data['title'], 'title'),
            ],
            'post_image'=>'required|activeurl',
            'post_content'=>'min:10|required',
        ]);
        $data['user_id'] = Auth::id();
        $data['post_date'] = new DateTime();

        $post = Post::create($data);

        return redirect()->route('admin.posts.show', compact('post'))->with('create', $data['title'] . ' ' . 'é stato creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $dates = $request->all();
        $request->validate([
            'title'=>[
                'min:3',
                'max:255',
                'required',
                Rule::unique('posts')->ignore($dates['title'], 'title'),
            ],
            'post_image'=>'required|activeurl',
            'post_content'=>'min:10|required',
        ]);

        $dates['user_id'] = Auth::id();
        $dates['post_date'] = new DateTime();
        $post->update($dates);

        return redirect()->route('admin.posts.show', compact('post'))->with('edit', $dates['title'] . ' ' . 'è stato modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->route('admin.posts.index')->with('delete', $post->title . ' ' . 'é stato eliminato con successo');
    }
}
