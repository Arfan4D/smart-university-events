<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
    public function register(Request $request){
        $data=$request->validate(['name'=>'required|string|max:100','email'=>'required|email|unique:users','password'=>'required|min:6|confirmed']);
        $user=User::create(['name'=>$data['name'],'email'=>$data['email'],'password'=>Hash::make($data['password']),'role'=>'student']);
        Auth::login($user); $request->session()->regenerate();
        return back()->with('success','Student account created successfully.');
    }
    public function login(Request $request){
        $credentials=$request->validate(['email'=>'required|email','password'=>'required']);
        if(!Auth::attempt($credentials)){ return back()->withErrors(['email'=>'Incorrect email or password.'])->onlyInput('email'); }
        $request->session()->regenerate(); return back()->with('success','Welcome back!');
    }
    public function logout(Request $request){ Auth::logout(); $request->session()->invalidate(); $request->session()->regenerateToken(); return redirect('/'); }
}
