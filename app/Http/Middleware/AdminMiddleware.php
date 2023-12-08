<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user()->role()->first();

            if ($user->nomRole == 'admin') {
                return $next($request);
            } else {
                return  response()->json(['message' => 'Autorisation refusée']);
            }
        } else {
            return response()->json(['message' => "vous n'etes pas connecte"]);
        }
        return $next($request);
    }
}
