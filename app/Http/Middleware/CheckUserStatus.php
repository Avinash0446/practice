<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->email) {
            $user = User::where('email', $request->email)->first();
            if ($user && $user->status !== 'active') {
                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is inactive. Please contact support.'
                ]);
            }
        }
        return $next($request);
    }

}
