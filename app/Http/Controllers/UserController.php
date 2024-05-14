<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
 

    public function editView(){
        $users = User::where('id', Auth::user()->id)->first();
        return view('user.profile', compact('users'));
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [       
            'surname' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'about' => 'required',
            'address' => 'required',
            'phone_no' => 'required|min:11',
        ]
        ,[
            'required' => 'Please fill out each field',
        ]
        );
    
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };

        $matchName = User::where('id', $id)->first();

        if ($matchName) {
            $email = $request->email;
        } else {
            $findName = User::where('email', $request->email)->first();
        
            if ($findName) {
                return redirect()
                    ->back()
                    ->with("error", "Email already exists")
                    ->withInput();
            } else {
                $email = $request->email;
            }
        }
        $firstname = Str::upper($request->firstname);
        $surname = Str::upper($request->surname);

        $accounts = User::find($id);
        $accounts->update([
            'surname' =>$surname ,
            'firstname'=> $firstname ,
            'email'=> $email ,
            'about'=> $request->about ,
            'address'=> $request->address ,
            'phone_no' => $request->phone_no,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
        ]);

        return redirect()->back()->with("success", "Account has been updated successfully");
    }

    public function password(Request $request, int $id){
        $validator = Validator::make($request->all(), [       
            'newpassword' => 'required | confirmed',
        ]
        );
    
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };



        $users = User::where('id', $id)->first();
        $checkPassword = Hash::check($request->password, $users->password);
        if($checkPassword){
            $accounts = User::find($id);
            $accounts->update([
                'password' => Hash::make($request->newpassword),
            ]);
    
            return redirect()->back()->with("success", "Password has been updated successfully");
           
        }else{
            return redirect()->back()->with("error", "Current Password does not match");
        }
    }
}
