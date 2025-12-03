<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AdminSessionAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            $plainToken = $request->session()->get('auth_token');
            if ($plainToken && str_contains($plainToken, '|')) {
                [$id, $token] = explode('|', $plainToken, 2);
                $pat = PersonalAccessToken::find($id);
                if ($pat && hash_equals($pat->token, hash('sha256', $token))) {
                    Auth::login($pat->tokenable); // authenticate user for this request
                }
            }
        }
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu');
        }
        return $next($request);
    }
}
