<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    //
    public function signup(){
        return view('signup');
    }
    public function index(){
        $id = auth()->user()->id;
        $users = User::orderBy('id', 'DESC')->where('id', '!=', $id)->get();
        return view('welcome' , ['users'=>$users]);
    }
    
    public function chat(Request $request , $id){
        $user = User::where('id',$id)->first();
        return view('chat' , ['user'=>$user]);
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
        $file = $request->file('image');
        if ($file) {
            // Delete the previous file if it exists
            if ($user->image) {
                $filePath = 'public/' . $user->image;
                Storage::delete($filePath);
            }
        
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('image', $fileName, 'public');
            $user->image = $filePath;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('profile')->with('updated' , 'profile Updated successfully');
    }
}
