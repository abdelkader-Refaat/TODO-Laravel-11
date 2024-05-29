<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{

    public function register(){

      return view("user.register");
    }
    public function store(Request $request){

        $validated = $request->validate([
            "name"  => ['required', 'min:5', 'max:255','string'],
            "email" => ['required', 'unique:users','email',],
            'password'=> ['required','confirmed','min:8',Password::defaults()],
        ]);

         $user =  User::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        // log in the registered users
         auth()->login($user);
         //redirect to vist posts
         return to_route('posts.index');
    }
}
