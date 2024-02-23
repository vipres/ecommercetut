<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function logout(){
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
