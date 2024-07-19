<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FormatUserNameMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $nameParts = explode(' ', auth()->user()->name);
            $firstName = $nameParts[0];
            $initials = '';
    
            for ($i = 1; $i < count($nameParts); $i++) {
                $initials .= substr($nameParts[$i], 0, 1) . '. ';
            }
    
            $formattedName = $firstName . ' ' . trim($initials);
            
            view()->share('formattedName', $formattedName);
        }
    
        return $next($request);
    }    
}
