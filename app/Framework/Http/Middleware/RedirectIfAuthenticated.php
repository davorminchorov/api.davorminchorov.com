<?php

namespace DavorMinchorov\Framework\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * @param Guard $guard
     */
    public function __construct(private Guard $guard)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards): mixed
    {
        if ($this->guard->check()) {
            return new JsonResponse([
                'message' => 'Already authenticated.'
            ]);
        }

        return $next($request);
    }
}
