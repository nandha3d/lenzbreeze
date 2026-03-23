<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

/**
 * Loads SalePro sidebar permission data for the unified sidebar
 * when rendering LenzBreeze admin pages.
 */
class LoadSaleProPermissions
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            try {
                // Reduce cache time to 1 hour for better responsiveness during changes
                $cacheTTL = 3600; 

                $role = Cache::remember('user_role_' . Auth::id(), $cacheTTL, function () {
                    return DB::connection('salepro')->table('roles')->find(Auth::user()->role_id);
                });
                View::share('role', $role);

                $role_has_permissions_list = Cache::remember(
                    'role_has_permissions_list' . Auth::user()->role_id,
                    $cacheTTL,
                    function () {
                        return DB::table('permissions')
                            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                            ->where('role_id', Auth::user()->role_id)
                            ->select('permissions.name')
                            ->get();
                    }
                );
                
                if (!$role_has_permissions_list || $role_has_permissions_list->isEmpty()) {
                    \Log::warning("LoadSaleProPermissions: No permissions found for role_id " . Auth::user()->role_id);
                }

                View::share('role_has_permissions_list', $role_has_permissions_list);
            } catch (\Exception $e) {
                \Log::error("LoadSaleProPermissions Error: " . $e->getMessage());
                // If SalePro DB is unreachable, sidebar will use fallback (simple links)
            }
        }

        return $next($request);
    }
}
