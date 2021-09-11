<?php

namespace DavorMinchorov\Framework\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * @param AuthManager $authManager
     */
    public function __construct(private AuthManager $authManager)
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
        foreach($guards as $guard) {
            if ($this->authManager->guard($guard)->check()) {
                return new JsonResponse([
                    'message' => 'Already authenticated.'
                ]);
            }
        }

        return $next($request);
    }
}
