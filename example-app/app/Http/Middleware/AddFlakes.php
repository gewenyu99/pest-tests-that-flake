<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddFlakes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $randFactor = rand(1, 20);
        $pathFactor =  ((strlen($request->path()) + 1) % 16) + 5;
        error_log("randFactor: " . $randFactor);

        error_log("pathfactor: " . $pathFactor);

        if (strpos($request->path(), 'profile') === false && $randFactor >= $pathFactor){
            $statusCode = rand(0, 1) ? 400 : 500;
            return response('Random error', $statusCode);
        }
        return $next($request);
    }
}
