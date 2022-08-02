<?php

namespace AppEHR\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatorUpdatepatients_EHR_documentRequest
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
        $rules = [

        ];

        $request->validate($rules);
        return $next($request);
    }
}
