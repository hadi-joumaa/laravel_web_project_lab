<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class AuthController extends Controller
{
    public function HomePage(){
        if(Auth::check()){
            $posts = Post::orderBy('created_at', 'desc')->get();
            return view('index',compact("posts"));
        }

        return view('auth.login');
    }


    public function RegisterPage(){
        return view('auth.register');
    }
    public function StoreUser(Request $request){
        $validated = $request->validate([
            'name' => ['required','min:4'],
            'email' => ['required','email',"unique:users,email"],
            'password' => ['required','min:6']
        ]);
        $user = User::create($validated);
        Auth::login($user);
        return redirect()->route('index')->with('success',$user->name . "stored successfully");

    }
    public function loginPage(){
        return view('auth.login');
    }
    public function login(Request $request){
        $validated = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);
        if(Auth::attempt($validated)){
            return redirect()->route('index')->with('success','Welcome '.Auth::user()->name);
        }
        return back()->with("error",'The provided credentials are incorrect.');
    }
}
