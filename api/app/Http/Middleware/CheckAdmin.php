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
        $token = $request->header('Api-Token', $request->input('token', ''));
        $remember_token = $request->header('remember_token', $request->input('remember_token', ''));
        $url = 'http://oa.qkteam.com/api/isAdmin';
        $status = file_get_contents("$url?token=$token&remember_token=$remember_token");
        $status = json_decode($status);
        if ($status->status === 0) abort(403);
        return $next($request);
    }
}
