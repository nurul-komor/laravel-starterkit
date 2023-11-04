<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class GetSettingsController extends Controller
{
    /**
     * Fetching Settings from Database
     */
    public function __invoke(Request $request = null)
    {
        $settings = Setting::first();
        if ($settings) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'settings' => $settings,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Settings not found!',
            'settings' => [],
        ], 404);
    }
}
