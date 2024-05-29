<?php
namespace App\Http\Controllers\user;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function login(){
     return view("user.login");
    }
    public function store(Request $request){
        $validated = $request->validate([
            "email"    => ["required","email"],
            "password" => ["required","min:8","string"],
        ]);
        if (Auth::guard('web')->attempt(['email' => $request->email , 'password'=> $request->password])) {
             return redirect()->intended(route('posts.index'));
        }
        else{
         return redirect()->back()->withErrors([
            'email'     => 'the provided credenial doesnot match our credenials',
            'password'  => 'incorrect password try again',
        ]);
        }

}
    public function logout(Request $request){
        Auth::guard("web")->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return to_route("posts.index");
    }
}
