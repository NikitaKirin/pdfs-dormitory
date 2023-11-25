<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        abort_unless($user->is_admin, 403, __('http-statuses.403'));
        return $next($request);
    }
}
