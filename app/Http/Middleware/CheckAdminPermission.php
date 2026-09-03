<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
{
    /**
     * Usage in routes: ->middleware('permission:products')
     * Super admins always pass. Other admins need the permission slug
     * (via their assigned Role) to proceed, otherwise they get a 403.
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        $admin = Auth::guard('admin')->user();

        if (! $admin || ! $admin->hasPermission($permission)) {
            abort(403, 'You do not have permission to access this section.');
        }

        return $next($request);
    }
}
