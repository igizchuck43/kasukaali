<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->isBanned()) {
            auth()->logout();
            abort(403, 'This account is banned.');
        }

        if ($user->isSuspended()) {
            return redirect()->route('notice.suspended');
        }

        if ($user->isRejected()) {
            return redirect()->route('notice.rejected');
        }

        if (! $user->isApproved() && ! $user->isAdmin() && ! $user->isModerator()) {
            return redirect()->route('notice.pending');
        }

        return $next($request);
    }
}
