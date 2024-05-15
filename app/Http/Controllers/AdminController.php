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

class AdminController extends Controller
{
    public function view(): View{
        $users = User::orderBy('id', 'desc')->where('level', '1')->get();
        return view('admin.accounts.admin_account.list', compact('users'));
    }

    public function editView(Request $request, int $id){
        $users = User::where('id', $id)->orderBy('id', 'desc')->get();
        
        return view('admin.accounts.admin_account.edit_account', compact('users'));
    }

    public function profileView(){
        $users = User::where('id', Auth::user()->id)->first();
        return view('admin.profile.profile', compact('users'));
    }

    public function accountPost(Request $request){
        $validator = Validator::make($request->all(), [       
            'surname' => 'required',
            'firstname' => 'required',
            'email' => 'required|unique:users',
            'about' => 'required',
            'address' => 'required',
            'gender' => 'required',
            
            'phone_no' => 'required|min:11',

            'password' => 'required| confirmed'
        ]
        ,[
            'required' => 'Please fill out each field',
            'email.unique' => 'Email already exists',
        ]
    );
    
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };


        $firstname = Str::upper($request->firstname);
        $surname = Str::upper($request->surname);
        $accounts = User::create([
            
            'surname' =>$surname ,
            'firstname'=> $firstname ,
            'email'=> $request->email ,
            'address'=> $request->address ,
            'phone_no' => $request->phone_no,
            'birthdate' => $request->birthdate,
            'about' => $request->about,
            'gender' => $request->gender,
            'status' => '1',
            'level' => '1',
            'password' => $request->password
        ]);

        return redirect(route('admin_account.list'))->with("success", "Account has been added successfully");
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
            'status' => '1',
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

    public function deactivate(Request $request, int $id){
        $users = User::where('id', $id)->first();
        if (Auth::user()) {
            $users->update([
                'status'=> '3',
                'remarks'=> $request->remarks
            ]);
            Auth::logout();
            return redirect(route('home'));
        }else{
            $users->update([
                'status'=> '3',
                'remarks'=> $request->remarks
    
            ]);
            return redirect(route('admin_account.list'))->with("error", "Account has been deactivated");
        }
    }

    public function activate(Request $request, int $id){
        $users = User::where('id', $id)
        ->where('status', '3')
        ->first();
        $users->update([
            'status'=> '1',
            'remarks'=> $request->remarks

        ]);
        return redirect()->back()->with("success", "Account has been re-activated");
    }
}
