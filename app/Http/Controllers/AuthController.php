<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Mail\WelcomeBackEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function create(Request $request){
        try{
            $user = $request->validate([
                'name' => ['required', 'min:5', 'string', 'max:40'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed', 'min:8']
            ]);
    
            $newUser = User::create($user);

            Mail::to($newUser->email)->send(new WelcomeEmail($newUser));
    
            return redirect()->route('dashboard')->with('success', 'Account created successfully, you can go to the login page to login');
        }catch(ValidationException $e){
            return back()->withInput();
        }
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request){
        try{
            $user = $request->validate([
                'email' => ['required'],
                'password' => ['required']
            ]);
    
            if(auth()->attempt($user)){
                $request->session()->regenerate();

                return redirect()->intended('/')->with('success', 'Logged In Successfully');
            }else{
                return back()->withErrors([
                    'email' => 'No matching user found for this email or password'
                ]);
            }
    
        }catch(ValidationException $e){
            return back()->withInput();
        }
    }

    public function logout(Request $request){
        auth()->logout();

        $request->session()->regenerate();
        $request->session()->regenerateToken();

        return back()->with('success', 'Logged Out');

        
    }
}
