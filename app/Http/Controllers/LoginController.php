<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Validator;

class LoginController extends Controller
{

     public function Login(Request $request)
    {
        if(session()->has('logRole') && session()->has('logid')){
            return redirect('dashboard');
        }elseif ($request->isMethod('post')) {

            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required',
                    'password'    => 'required',
                ]);

                if ($validator->fails()) {
                    return redirect('/')
                        ->withInput()
                        ->withErrors($validator);
                }

                try {

                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials, $request->has('remember'))) {

                        if (Auth::User()->hasRole('admin') && Auth::User()['role'] == 1 && Auth::User()['status'] == 1) {
                            $user = Auth::User();
                            Session::put('logRole', Auth::User()['role']);
                            Session::put('logid', Auth::User()['id']);

                            // LoginLogs($user);

                            return redirect('dashboard')
                                ->with('success', 'Welcome to dashboard.');
                        } elseif (Auth::User()['role'] != 1  && Auth::User()['status'] == 1) {
                            $user = Auth::User();
                            Session::put('logRole', Auth::User()['role']);
                            Session::put('logid', Auth::User()['id']);

                            LoginLogs($user);

                            return redirect('emp_dashboard')
                                ->with('success', 'Welcome ' . $user['name']);
                        } else {
                            Auth::logout();
                            return back()->with('failed', 'Invalid Credential.');
                        }
                    } else {
                        Auth::logout();
                        return back()->with('failed', 'Invalid Credential.');
                    }
                } catch (\Exception $e) {
                    return back()->with('failed', $e->getMessage());
                }
            }
        }
        return view('login');
    }

    public function logout()
    {

        Auth::logout();
        Session::forget('logRole');
        Session::forget('logid');
        return redirect('/');
    }
}
