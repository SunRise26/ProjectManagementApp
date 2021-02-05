<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    protected $supported_languages = ['en', 'ua'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('locale')) {
            session([
                'locale' => $request->getPreferredLanguage($this->supported_languages)
            ]);
        }
        app()->setLocale(session('locale'));
        
        return $next($request);
    }
}
