<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use App\Events\UserRegistered;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'status' => 'active'
            ]);
            $user->assignRole($data['role']);
            DB::commit();
            event(new UserRegistered($user));
            if ($user->hasRole('user')) {
                auth()->login($user);
                return redirect()->route('user.dashboard', compact('user'))->with('success', 'Registration completed successfully!');;
            }
            if ($user->hasRole('editor')) {
                auth()->login($user);
                return redirect()->route('editor.dashboard', compact('user'))->with('success', 'Registration completed successfully!');;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'email' => 'Registration failed: ' . $e->getMessage()
            ]);
        }
    }
    

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function login()
    {
        return view('login');
    }

    public function loginAttempt(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {

            if (auth()->user()->status !== 'active') {
                auth()->logout();

                return back()->withErrors([
                    'email' => 'Your account is inactive. Please contact support.'
                ]);
            }
            // $user = User::where('email',$request->email)->first();
            $request->session()->regenerate();
            event(new LoginEvent(auth()->user()));
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif (auth()->user()->hasRole('editor')) {
                return redirect()->route('editor.dashboard');
            } elseif (auth()->user()->hasRole('user')) {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ]);
    }

}
