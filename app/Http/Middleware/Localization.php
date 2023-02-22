<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
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
        $default = config('app.name');
        $accept_language = $request->header('accept-language');
        if ($accept_language) {
            list($default) = explode(',', $accept_language);
        }

        $default = Session::get('locale', $default);

        $lang = $request->query('lang', $default);
        Session::put('locale', $lang);

        App::setlocale($lang);

        return $next($request);
    }
}
