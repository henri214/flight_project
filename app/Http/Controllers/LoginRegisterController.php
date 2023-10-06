<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\StoreUserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'authen.dashboard'
        ]);
    }
    public function register()
    {
        $genders = collect(['male' => 'Male', 'female' => 'Female']);
        return view('authen.register', compact('genders'));
    }

    public function store(StoreUserRequest $request)
    {

        $service = new UserService();
        $service->storeUser($request);
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        return redirect()->to('/')
            ->with('message', 'You have successfully registered & logged in!');
    }
    public function login()
    {
        return view('authen.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            return redirect()->to('/')
                ->with('message', 'You have successfully logged in!');
        }
        return back()->withErrors([
            'email' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('email');
    }
    public function dashboard()
    {
        if (Auth::user() !== null) {
            return view('authen.dashboard');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/')
            ->with('message', 'You have logged out successfully!');
    }
}
