<?php

namespace App\Http\Middleware;

use Closure;

class CheckBoss
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
        $type = $request->user()->type;
        if($type == 'jefe')
            return $next($request);
        return response()->json([
            'message' => 'Unauthorized'], 401);
    }
}
