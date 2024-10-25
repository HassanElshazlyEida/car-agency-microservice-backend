<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Services\UserService;
use Symfony\Component\HttpFoundation\Response;

class UserServiceAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = (new UserService)->getRequest('get', '/user');
        if(!$response->ok()) {
            abort(401, 'unauthorized');
        }
        return $next($request);
    }
}
