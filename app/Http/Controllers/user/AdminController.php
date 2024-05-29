<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\PostMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
     public function index(){
        $posts = Post::all();
        return view("admin.index", compact("posts"));
     }

}
