<?php

namespace App\Http\Middleware;

use Closure;

class CanAuthenticate
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
        if (auth()->check() && auth()->user()->banned_at) {

            auth()->logout();

            $message = 'Votre compte a été suspendu. Veuillez contacter l\'administrateur.';

            return redirect()->route('login')->withMessage($message);
        }

        if (auth()->check() && auth()->user()->actif == 0) {

            auth()->logout();

            $message = 'Votre compte a été supprimé. Veuillez contacter l\'administrateur.';

            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}
