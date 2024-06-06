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
            
            
            if ($user->level == '3' && $user->status == '1') {
                // Authentication passed...
                return redirect(route('home'));
            }else{
                Auth::logout();
                return redirect()->back()->with("error", "Login details are invalid.");
            }
        }else{
            return redirect()->back()->with("error", "Login details are invalid.");
        }
    }

    function adminPost(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'required' => 'Fill out all the fields',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->level == '1' && $user->status == '1' || $user->level == '2' && $user->status == '1') {
                // Authentication passed...
                return redirect(route('admin'));
            }else{
                Auth::logout();
                return redirect()->back()->with("error", "Access denied.");
            }
        }else{
            return redirect()->back()->with("error", "Access denied.");
        }
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

            
            'region_text' => 'required',
            'province_text' => 'required',
            'city_text' => 'required',
            'barangay_text' => 'required',
            'street_text' => 'required',

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

        $surname = Str::ucfirst($request->surname);
        $firstname = Str::ucfirst($request->firstname);
        $middlename = Str::ucfirst($request->middlename);

        $user = User::create([
            'username' => $request->username,
            'surname' => $surname,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'email' => $request->email,

            
            'region_text'=> $request->region_text,
            'province_text'=> $request->province_text,
            'city_text'=> $request->city_text,
            'barangay_text'=> $request->barangay_text,
            'street_text'=> $request->street_text,

            
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
            'level' => '3',
            'status' => '1',
        ]);  

        return redirect()->back()->with("success", "Registration Success");
    }
  
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('home'));
    }

}
