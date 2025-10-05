<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            
            // Check if user is suspended
            if ($user->status === 'suspended') {
                auth()->logout();
                return redirect()->route('login')->with('error', 'Your account has been suspended. Please contact administrator.');
            }
            
            // Check if user is pending approval (except for super admin)
            if ($user->status === 'pending' && $user->email !== 'superadmin@university.edu') {
                auth()->logout();
                return redirect()->route('login')->with('message', 'Your account is pending approval. You will be notified once approved.');
            }
        }

        return $next($request);
    }
}
