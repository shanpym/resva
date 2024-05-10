<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\Front;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Session;

class AuthController extends Controller
{
    // function login(){

    //     // if(Auth::check()){
    //     //     return redirect()->intended(route('home'));
    //     // }
    //     return view('user-admin-login.login');
    // }
    

  
    function loginPost(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'required' => 'Fill out all the fields',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->level == '1') {
                // Authentication passed...
                return redirect(route('admin'));
            } elseif ($user->level == '2') {
                // Authentication passed...
                return redirect(route('employee'));
            } elseif ($user->level == '3') {
                // Authentication passed...
                return redirect(route('home'));
            }
        }
    
        return redirect(route('login'))->with("error", "Login details are invalid.");
    }

    
    function registration(){
        if(Auth::check()){
            return redirect()->intended(route('home'));
        }
        return redirect()->back()->with("success", "Account registered successfully");
    }
    
    function registrationPost(Request $request): RedirectResponse{
        $validator = Validator::make($request->all(), [       
            
            'surname' => 'required',
            'firstname' => 'required',
            'phone_no' => 'required',
            'birthdate' => 'required',
            'password' => 'required | confirmed | min:3',
            'email' => 'required | email | unique:users',        
        ],[
            'required' => 'Fill out all the fields',
        ]);
    
         if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };
        // $usersExists = User::where('username', $request->username)->first();
        // $userFound = '';
        // if($usersExists){
        //     $userFound = $usersExists->username;
        //     return redirect()
        //     ->back()
        //     ->withInput()
        //     ->withErrors($validator)
        //     ->with("errorName", "Username already existed" );
        // }

        $surname = Str::ucfirst($request->surname);
        $firstname = Str::ucfirst($request->firstname);
        $middlename = Str::ucfirst($request->middlename);

        $user = User::create([
            'username' => $request->username,
            'surname' => $surname,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'email' => $request->email,
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
        ]);  

        return redirect()->back()->with("success", "Registration Success");
    }
  
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('home'));
    }

}
