<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginAdmin(){
//        dd(bcrypt('athanh1805'));
        if (auth()->check()){
            return redirect()->to('home');
        }
            return view('login_admin');
        }
    public function postLoginAdmin(Request $request){
        $remember = $request -> has('remeber_me') ? true :false;
        if(auth()->attempt([
            'email' => $request -> email,
            'password' => $request -> password,
        ], $remember)){
            $user = auth()->user();
            session(['user' => $user]);
            return view('home', ['user' => $user]);
        }
    }

    public function logout()
    {
        auth()->logout(); // Đăng xuất người dùng
        session()->forget('user');

        return redirect('/'); // Chuyển hướng người dùng sau khi đăng xuất về trang chủ
    }

}
