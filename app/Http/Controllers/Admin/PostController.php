<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

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
        $tags = Tag::all();
        return view('admin.posts.create', compact('post','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        
        $request->validate([
            'title'=>[
                'min:3',
                'max:255',
                'required',
                Rule::unique('posts')->ignore($data['title'], 'title'),
            ],
            'post_image'=>'required|max:256',
            'post_content'=>'min:10|required',
            
        ]);
        $data['user_id'] = Auth::id();
        $data['post_date'] = new DateTime();

        $data['post_image'] = Storage::put('uploads', $data['post_image']);

        $newPost = new Post();
        $newPost->fill($data);
        $newPost->save();
        if(isset($data['tags'])){
            $newPost->tags()->sync($data['tags']);
        }
        
        
        return redirect()->route('admin.posts.index')->with('create', $data['title'] . ' ' . 'é stato creato con successo');
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
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
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
            'post_image'=>'required|max:256',
            'post_content'=>'min:10|required',
            
        ]);

        $dates['user_id'] = Auth::id();
        $dates['post_date'] = new DateTime();

        $dates['post_image'] = Storage::put('upload', $dates['post_image']);
        
        
        $post->update($dates);
        if(isset($dates['tags'])){
            $post->tags()->sync($dates['tags']);
        } else{
            $post->tags()->detach();
        }
        
        

        return redirect()->route('admin.posts.index')->with('edit', $dates['title'] . ' ' . 'è stato modificato con successo');
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
