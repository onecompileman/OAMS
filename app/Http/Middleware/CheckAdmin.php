<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if(!isset($_SESSION))
            session_start();
        if(isset($_SESSION['isLogin'])){
            if($_SESSION['type']=="staff"){
                return $next($request);
            }
        }
        abort('401');
    }
}
