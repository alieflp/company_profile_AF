<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (RateLimiter::tooManyAttempts('login:'.$request->ip(), 5)) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Too many attempts'], 429);
            }
            return redirect()->route('admin.login')->with('too_many_requests', 'Terlalu banyak percobaan login. Coba lagi nanti.');
        }
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();
        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            RateLimiter::hit('login:'.$request->ip());
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            return redirect()->route('admin.login')->with('error', 'Email atau password tidak valid');
        }

        RateLimiter::clear('login:'.$request->ip());
        $token = $user->createToken('api')->plainTextToken;
        if ($request->expectsJson()) {
            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }
        // Store token in session for later use (optional)
        $request->session()->put('auth_token', $token);
        return redirect()->route('admin.dashboard')->with('success', 'Berhasil login');
    }

    public function logout(Request $request)
    {
        // Hapus semua token user dari database
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
        }
        
        // Hapus auth_token dari session
        $request->session()->forget('auth_token');
        
        // Logout user dari guard
        Auth::logout();
        
        // Invalidate dan regenerate session untuk security
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        if ($request->expectsJson()) {
            return response()->json(['logged_out' => true]);
        }
        
        return redirect()->route('admin.login')->with('success', 'Anda telah logout');
    }
}
