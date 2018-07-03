<?php

namespace App\Http\Middleware;

use Session;
use Closure;
use Illuminate\Foundation\Application;

class Lang
{
    protected $app;

    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->app->setLocale(Session::get('lang'));
        return $next($request);
    }
}
