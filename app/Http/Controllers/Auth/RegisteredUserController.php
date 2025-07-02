<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     event(new Registered($user));

    //     Auth::login($user);

    //     return redirect(route('dashboard', absolute: false));
    // }


    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Log::info('Starting user registration process.');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Log::info('User created', ['user_id' => $user->id]);

        $dbName = 'tenant_' . strtolower(preg_replace('/[^a-z0-9]/', '_', $user->name)) . '_' . $user->id;
        Log::info('Database name to create', ['db_name' => $dbName]);

        try {
            DB::statement("DROP DATABASE IF EXISTS `$dbName`");
            Log::info('Dropped existing database if existed', ['db_name' => $dbName]);
        } catch (\Exception $e) {
            Log::error('Error dropping database', ['error' => $e->getMessage()]);
        }

        try {
            DB::statement("CREATE DATABASE `$dbName`");
            Log::info('Database created successfully', ['db_name' => $dbName]);
        } catch (\Exception $e) {
            Log::error('Error creating database', ['error' => $e->getMessage()]);
            // You may want to handle this error (e.g., abort or retry)
        }

        $user->database_name = $dbName;
        $user->save();

        config([
            'database.connections.tenant' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => $dbName,
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ],
        ]);

        Log::info('Configured tenant database connection');

        try {
            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path' => '/database/migrations/tenant',
                '--force' => true,
            ]);
            Log::info('Tenant migrations ran successfully');
        } catch (\Exception $e) {
            Log::error('Tenant migrations failed', ['error' => $e->getMessage()]);
        }

        event(new Registered($user));
        Auth::login($user);

        Log::info('User registration complete and logged in', ['user_id' => $user->id]);

        return redirect(RouteServiceProvider::HOME);
    }
}
