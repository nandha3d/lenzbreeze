<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SwitchToSaleProConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Switch default database to salepro down the request lifecycle
        // This ensures third-party packages (like Spatie Permission) query
        // the SalePro database instead of LenzBreeze default.
        Config::set('database.default', 'salepro');

        return $next($request);
    }
}
