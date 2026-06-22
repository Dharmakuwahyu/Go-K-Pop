<?php
namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $validated = validator($request->all(), [
            'full_name' => ['required', 'string', 'max:100'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['required', 'min:8'],
        ], [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'full_name.max'      => 'Nama lengkap maksimal 100 karakter.',

            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',

            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 8 karakter.',
        ]);

        if ($validated->fails()) {
            return back()
                ->withErrors($validated, 'register')
                ->with('show_register', true)
                ->withInput();
        }

        $validated = $validated->validated();

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name'     => $validated['full_name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $profile = Profile::create([
                'user_id'   => $user->id,
                'full_name' => $validated['full_name'],
            ]);

            UserRole::create([
                'profile_id' => $profile->id,
                'role'       => 'member',
            ]);
        });

        return redirect('/')
            ->with('success', 'Registrasi berhasil. Silakan login.')
            ->with('show_login', true);
    }

    public function login(Request $request)
    {
        $validated = validator($request->all(), [
            'email-login'    => ['required', 'email'],
            'password-login' => ['required'],
        ], [
            'email-login.required'    => 'Email wajib diisi.',
            'email-login.email'       => 'Format email tidak valid.',
            'password-login.required' => 'Password wajib diisi.',
        ]);

        if ($validated->fails()) {
            return back()
                ->withErrors($validated->errors(), 'login')
                ->with('show_login', true)
                ->withInput();
        }

        $data = $validated->validated();

        $credentials = [
            'email'    => $data['email-login'],
            'password' => $data['password-login'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()
                ->intended('/member/catalog');
        }

        return back()
            ->withErrors([
                'login' => 'Email atau password salah.',
            ], 'login')
            ->with('show_login', true)
            ->withInput();
    }
}
