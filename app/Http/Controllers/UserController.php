<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //
    public function signup(){
        return view('signup');
    }
    public function index(){
        $users = User::orderBy('id','DESC')->get();
        return view('welcome' , ['users'=>$users]);
    }
    
    public function chat(){
        $users = User::orderBy('id','DESC')->get();
        return view('chat' , ['users'=>$users]);
    }
    
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        return redirect('login')->with('success' , 'you have successfully Registered');
    }

    public function login(){
        return view('login');
    }

    public function auth(Request $request){
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('home')->with('login' , 'you have successfully logged in');
        }
        else{
            return redirect()->back()->with(['loginfail' => 'Invalid email id or password']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('login');
    }

    public function profile(){
        return view('profile');
    }
    public function profileUpdate(Request $request , $id){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);

        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('profile')->with('updated' , 'profile Updated successfully');
    }
}
