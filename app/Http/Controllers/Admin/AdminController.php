<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard (){
        return view('admin.dashboard');
    }

    public function login (Request $request){
        if($request->isMethod('post')){

            $data = $request->all();
            $rules =[
                'email' => 'required|email|max:255',
                'password' => 'required|max:30'
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
            ];

            $this->validate($request, $rules, $customMessages);


            if(auth()->guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('admin.login')->with('error_message', 'Invalid Username or Password');
            }
        }
        return view('admin.login');
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //Check if current password is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //Check if new and confirm password is matching
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password is not matching');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorrect');
            }
        }
        return view('admin.update_password');
    }


    public function checkCurrentPassword(Request $request){
        $data = $request->all();
        $adminDetails =Admin::where('email',Auth::guard('admin')->user()->email)->first();
        $current_password = $data['current_password'];
        if(Hash::check($current_password,$adminDetails->password)){
            return "true";
        }else{
            return "false";
        }
    }

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
