<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && $request->user()->whereBlock(false)){
            return $next($request);
        }

        return response()->json([
            'message' => 'you are blocked'
        ], Response::HTTP_FORBIDDEN);
    }
}
