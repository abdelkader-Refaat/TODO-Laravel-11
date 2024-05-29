<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminPostController extends Controller
{
     public function edit(Post $post){
        return view("admin.posts.edit", compact("post"));

     }
     public function update(Request $request, Post $post){
        $validated =  $request->validate([
            'title' => ['required','min:5', 'max:255',],
            'content'=> ['required','min:9', ],
            'thumbnail' => ['sometimes','image', ],

         ]);
         if ($request->hasFile('thumbnail')) {
            File::delete(storage_path('app/public/thumbnauls/'. $post->thumbnail));
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
         }

        $post->update($validated);
        return to_route('admin',$post->id)->with('success','the post is updated');

     }
     public function destroy(Post $post){
        $post->delete();
        File::delete(storage_path('app/'. $post->thumbnail));
        return redirect()->back()->with('success','deleted');

     }
}
