<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Authentication\AuthException;
use App\Authentication\User;
use App\Authentication\CurrentUser;
use Closure;

class ValidateAction
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
        Auth::loginUsingId($request->bearerToken());

        CurrentUser::createInstance($request->user());
        $user = CurrentUser::getInstance();

        if(!$user->isAuth())
        {
            throw new AuthException($request->user()->getAuthIdentifier()["errors"]);
        }

        return $next($request);
    }
}
