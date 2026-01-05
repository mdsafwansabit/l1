<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     * Require HTTP Basic credentials: username 'admin' and password from env ADMIN_PASSWORD (default 'mywebapp').
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->getUser();
        $pass = $request->getPassword();

        $expectedUser = 'admin';
        $expectedPass = env('ADMIN_PASSWORD', 'mywebapp');

        if ($user !== $expectedUser || $pass !== $expectedPass) {
            $headers = ['WWW-Authenticate' => 'Basic realm="Admin Area"'];
            return response('Unauthorized', 401, $headers);
        }

        return $next($request);
    }
}
