<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LangCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->header('lang') == 'ar' || $request->header('lang') == 'en'){
            app()->setLocale($request->header('lang'));
        }
        else{
            app()->setLocale('en');
        }
        return $next($request);
    }
}
