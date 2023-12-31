<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MentoreMiddleware
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
            if ($user->nomRole == 'mentore') {
                return $next($request);
            } else {
                return  response()->json(['message' => 'Autorisation refusée']);
            }
        } else {
            return response()->json(['message' => "vous n'etes pa connecté"]);
        }
        return $next($request);
    }
}
