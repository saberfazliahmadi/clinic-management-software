<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class middleware_prevent_xss
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $userInput = $request->all();
        array_walk_recursive($userInput, function (&$userInput) {
            $userInput = strip_tags($userInput);
//            $userInput .= htmlentities($userInput);
//            $userInput .= addslashes($userInput);
//            $userInput .= htmlspecialchars($userInput);

        });
        $request->merge($userInput);
        return $next($request);
    }
}
