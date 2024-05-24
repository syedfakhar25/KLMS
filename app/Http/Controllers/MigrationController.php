<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MigrationController extends Controller
{
    public function runMigrations(Request $request)
    {
        // Optional: Add some kind of security, such as a token or IP restriction
        $token = $request->input('token');
        if ($token !== config('app.migration_token')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Artisan::call('migrate', ['--force' => true]);
        return response()->json(['success' => 'Migrations ran successfully']);
    }
}
