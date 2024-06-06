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

use Mail;
use App\Mail\AccountPost;

class AdminController extends Controller
{
    public function view(): View{
        $users = User::orderBy('id', 'desc')->where('level', '1')->get();
        return view('admin.accounts.admin_account.list', compact('users'));
    }

    public function employeeView(): View{
        $users = User::orderBy('id', 'desc')->where('level', '2')->get();
        return view('admin.accounts.employee_account.list', compact('users'));
    }

    public function userView(): View{
        $users = User::orderBy('id', 'desc')->where('level', '3')->get();
        return view('admin.accounts.user_account.list', compact('users'));
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

            'region_text' => 'required',
            'province_text' => 'required',
            'city_text' => 'required',
            'barangay_text' => 'required',
            'street_text' => 'required',


            'gender' => 'required',
            'phone_no' => 'required|min:11',
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

        $birthdate = $request->birthdate;

        $birthdate = str_replace('-', '', $birthdate);
        $birthdate = substr($birthdate, 4);

        $password = $firstname . $surname . $birthdate;

        $initial_firstname = Str::substr($request->firstname, 0, 1);
        $lower_surname = $request->surname;
        $username = $initial_firstname . $lower_surname . $birthdate;

        $accounts = User::create([
            'username' => $username, 
            'surname' => $surname ,
            'firstname'=> $firstname ,
            'email'=> $request->email ,
            

            'region_text'=> $request->region_text,
            'province_text'=> $request->province_text,
            'city_text'=> $request->city_text,
            'barangay_text'=> $request->barangay_text,
            'street_text'=> $request->street_text,

            'phone_no' => $request->phone_no,
            'birthdate' => $request->birthdate,
            'about' => $request->about,
            'gender' => $request->gender,
            'status' => '1',
            'level' => $request->level,
            'password' => $password
        ]);

        $id = $accounts->id;

        $email = $accounts->email;
        Mail::to($email)->send(new AccountPost($id));

        return redirect()->back()->with("success", "Account added successfully");
    }

    public function update(Request $request, int $id){
        // $validator = Validator::make($request->all(), [       
        //     'surname' => 'required',
        //     'firstname' => 'required',
        //     'email' => 'required',
        //     'about' => 'required',
        //     'address' => 'required',
        //     'phone_no' => 'required|min:11',
        // ]
        // ,[
        //     'required' => 'Please fill out each field',
        // ]
        // );
    
        // if($validator->fails()){
        //     return redirect()
        //     ->back()
        //     ->withErrors($validator)
        //     ->withInput();
        // };

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
            'username' => $request->username, 
            'surname' =>$surname ,
            'firstname'=> $firstname ,
            'email'=> $email ,
            'about'=> $request->about,

            'region_text'=> $request->region_text,
            'province_text'=> $request->province_text,
            'city_text'=> $request->city_text,
            'barangay_text'=> $request->barangay_text,
            'street_text'=> $request->street_text,

            'phone_no' => $request->phone_no,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
        ]);

        return redirect()->back()->with("success", "Account has been updated successfully");
    }

    public function profilePassword(Request $request, int $id){
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

    public function password(Request $request, int $id){
        $validator = Validator::make($request->all(), [       
            
            'auth_password' => 'required'
        ],[
            'required' => 'Admin Password is required',
        ]
        );
    
        if($validator->fails()){
            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        };

        $admin = Auth::user();
        $checkPassword = Hash::check($request->auth_password, $admin->password);
        if($checkPassword){
            $accounts = User::find($id);
            $accounts->update([
                'password' => Hash::make($request->newpassword),
            ]);
            return redirect()->back()->with("success", "Password updated successfully");
        }else{
            return redirect()->back()->with("error", "Access denied");
        }
        
    }

    public function deactivate(Request $request, int $id){
        

        $admin = Auth::user();
        $checkPassword = Hash::check($request->auth_password, $admin->password);
        if($checkPassword){
            $users = User::where('id', $id)->first();
            $users->update([
                    'status'=> '3',
                    'remarks'=> $request->remarks
            ]);
            if (Auth::user()->id == $users->id) {
                Auth::logout();
                return redirect(route('home'));
            }
            return redirect(route('admin_account.list'))->with("error", "Account has been deactivated");
        }else{
            return redirect()->back()->with("error", "Access denied");
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
