<?php namespace App\Http\Middleware;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use Closure;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        return \Auth::user()->role == '1' ? $next($request) : redirect('/');
    }
}
