<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use Exception;
use Validator;
use Illuminate\Http\Request;
use DateTime;
use Hash;
use Auth;
use App\Models\User;

class AuthController extends Controller
{

    public function postDangKy(SignUpRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hoten' => $request->hoten,
            'sdt' => $request->sdt,
            'diachi' => $request->diachi,
            'cccd' => $request->cccd,
            'ngaysinh' => $request->ngaysinh,
            'idrole' => 2,
        ]);

        return back()->with(['thong-bao' => 'Đăng ký thành công!', 'type' => 'success']);
    }

    public function postDangNhap(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended()->with('success', 'Đăng nhập thành công.');
        } else
            return back()->with(['thong-bao' => 'Email hoặc mật khẩu không chính xác!', 'type' => 'danger']);
    }

    public function postDangXuat()
    {
        Auth::logout();

        return back()->with('success', 'Đăng xuất thành công.');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $user->update([
            'hoten' => $request->hoten,
            'ngaysinh' => $request->ngaysinh,
            'sdt' => $request->sdt,
            'cccd' => $request->cccd,
            'diachi' => $request->diachi
        ]);

        return back()->with(['thong-bao' => 'Cập nhật thông tin thành công!', 'type' => 'success']);
    }
}
