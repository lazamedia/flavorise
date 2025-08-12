<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $settings = [
            'restaurant_name' => config('app.name', 'FLAVORISE'),
            'address' => config('app.restaurant_address', ''),
            'phone' => config('app.restaurant_phone', ''),
            'default_tax' => (float) (config('app.default_tax', 0)),
            'default_discount' => (float) (config('app.default_discount', 0)),
        ];
        return view('apps.profile.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'restaurant_name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'default_tax' => ['nullable', 'numeric', 'min:0'],
            'default_discount' => ['nullable', 'numeric', 'min:0'],
        ]);

        // Store to .env via runtime is complex; as a placeholder, we can cache to session or a simple file.
        // Here we store to a JSON file in storage for demonstration.
        $path = storage_path('app/profile_settings.json');
        file_put_contents($path, json_encode($data));

        return back()->with('success', 'Profil restoran diperbarui.');
    }
}


