<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
    {
        if (config('app.env') === 'local'
            && stripos($request->header('Referer'), 'docs/api')
            && $request->header('X-XSRF-TOKEN') === config('app.rest_api_docs_key')
        ) {
            return $next($request);
        }
        return parent::handle($request, $next);
    }
}
