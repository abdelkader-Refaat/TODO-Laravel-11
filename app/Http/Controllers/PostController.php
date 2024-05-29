<?php

namespace App\Http\Controllers;

use App\Jobs\PostMailJob;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //$posts = Post::paginate(6);
       $posts = Cache::remember("posts", 10 , function (){
            sleep(4);
            return Post::paginate(6);
        }); // cache every 10 seconds refresh return cache take 4 seconds
        return view('posts.index', compact('posts'));
    }
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('posts.create');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'title' => ['required','min:5', 'max:255',],
            'content'=> ['required','min:9', ],
            'thumbnail' => ['required','image', ],
         ]);
         $validated['thumbnail'] = $request->file('thumbnail')->store('public/thumbnails');
          auth()->user()->posts()->create($validated);
        //   dispatch(new PostMailJob(['email' => 'abdelkaderrefaat@gmail.com','name'=>'abdelkader']));
          return to_route('posts.index')->with('message','the post actually created');
      }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));



    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

         return view('posts.edit', compact('post'))->with('message','the post actually updated');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        $validated =  $request->validate([
            'title' => ['required','min:5', 'max:255',],
            'content'=> ['required','min:9', ],
            'thumbnail' => ['sometimes','image','required' ],
         ]);
         if ($request->hasFile('thumbnail')) {
           File::delete(storage_path('app/public'. $post->thumbnail));
           $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
         }

        $post->update($validated);
        return to_route('posts.show',$post->id)->with('message','the post is updated');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        File::delete(storage_path('app/'. $post->thumbnail));
         $post->delete();
         return to_route('posts.index');
    }
}
