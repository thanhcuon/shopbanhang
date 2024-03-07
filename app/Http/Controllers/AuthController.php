<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $categorysLimit = Category::where('parent_id',0)->take(3)->get();
        return view('home.login.login',compact('categorysLimit'));
    }
    public function showRegisterForm()
    {
        return view('home.login.login'); // Thay đổi tên view nếu cần
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            $user = Auth::user();

            // Kiểm tra vai trò của người dùng và tùy chỉnh hướng dẫn
            if ($user->hasRole('admin') || $user->hasRole('developer') || $user->hasRole('content')) {
                return Redirect::to('/'); // Chuyển hướng đến bảng điều khiển cho vai trò admin, developer hoặc content
            } else {
                return Redirect::to('/'); // Chuyển hướng đến trang chủ cho khách
            }
        } else {
            // Đăng nhập thất bại
            return redirect()->back()->withErrors(['message' => 'Thông tin đăng nhập không hợp lệ']);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo một user mới
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->save();

        // Đăng nhập người dùng sau khi đăng ký thành công
        Auth::login($user);

        // Đăng ký thành công, chuyển hướng đến trang sau khi đăng ký
        return redirect('/'); // Thay đổi URL đích
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/'); // Chuyển hướng người dùng sau khi đăng xuất đến trang chủ hoặc trang bạn muốn.
    }
}
