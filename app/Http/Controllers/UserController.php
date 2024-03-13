<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    protected $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required|same:password',
        ], [
            'name.required' => 'Ad alanı boş bırakılmamalıdır.',
            'surname.required' => 'Soyad alanı boş bırakılmamalıdır.',
            'email.required' => 'E-posta alanı boş bırakılmamalıdır.',
            'email.unique' => 'Bu E-posta adresi zaten kullanılmaktadır.',
            'password.required' => 'Şifre alanı boş bırakılmamalıdır.',
            'password.min' => 'Şifre en az 4 karakter olmalıdır.',
            'password.confirmed' => 'Şifreler eşleşmiyor.',
            'password_confirmation.required' => 'Şifre onayı alanı boş bırakılmamalıdır.',
            'password_confirmation.same' => 'Şifreler eşleşmiyor.',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->first()], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token = $user->createToken('MyLaravelApp')->plainTextToken;

        return response()->json([
            'status' => 1,
            'accessToken' => $token,
            'message' => 'Kullanıcı kaydı başarıyla gerçekleştirildi.'
        ], $this->successStatus);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'E-posta alanı boş bırakılmamalıdır.',
            'email.email' => 'Geçersiz e-posta adresi.',
            'password.required' => 'Şifre alanı boş bırakılmamalıdır.',
        ]);
       
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $input = $request->all();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('MyLaravelApp')->plainTextToken;

            session(['token' => $token]);

            if (Auth::check()) {
                return response()->json(['status' => 1, 'token' => $token, 'message' => 'Giriş işlemi başarıyla gerçekleşti!'], $this->successStatus);
            } else {
                return response()->json(['status' => 0, 'error' => 'Giriş başarısız.'], 401);
            }
        } else {
            return response()->json(['status' => 0, 'error' => 'Bilgiler eksik veya hatalı!'], 401);
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Başarıyla çıkış yapıldı.'], 200);
        } else {
            return response()->json(['message' => 'Oturumunuz açık değil. İlk önce oturum açmalısınız!'], 401);
        }
    }

    public function index(Request $request)
    {
        if (Auth::check()) {
            $users = User::all();
            return response()->json(['users' => $users], 200);
        } else {
            return response()->json(['error' => 'Yetkisiz Erişim!'], 401);
        }
    }
}