<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class UseTenantConnection
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->database_name) {
            config([
                'database.connections.tenant' => [
                    'driver' => 'mysql',
                    'host' => env('DB_HOST', '127.0.0.1'),
                    'port' => env('DB_PORT', '3306'),
                    'database' => $user->database_name,
                    'username' => env('DB_USERNAME'),
                    'password' => env('DB_PASSWORD'),
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'strict' => true,
                    'engine' => null,
                ],
            ]);

            DB::purge('tenant');
            DB::reconnect('tenant');
            DB::setDefaultConnection('tenant');
        }

        return $next($request);
    }
}
