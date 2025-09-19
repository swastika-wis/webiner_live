<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendor()
    {
        $vendors = Vendor::paginate(5);
        return view('admin.vendor', compact('vendors'));
    }
    public function vendorStore(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'theme_background' => 'nullable|string|max:7', // hex value
            'theme_foreground' => 'nullable|string|max:7',
            'logo'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'user_name'        => 'required',
            'password'         => 'required'
        ]);

        // Handle logo upload
        $logoPath = null;
        $logoPath1 = null;
        $logoPath2 = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('vendors', 'public');
        }


        if ($request->hasFile('logo1')) {
            $logoPath1 = $request->file('logo1')->store('vendors', 'public');
        }

        if ($request->hasFile('logo2')) {
            $logoPath2 = $request->file('logo2')->store('vendors', 'public');
        }

        Vendor::create([
            'name'             => $validated['name'],
            'user_name'        => $validated['user_name'],
            'password'         => bcrypt($validated['password']),
            'theme_background' => $validated['theme_background'] ?? null,
            'theme_foreground' => $validated['theme_foreground'] ?? null,
            'logo'             => $logoPath,
            'logo2'            => $logoPath1,
            'logo3'            => $logoPath2,

        ]);

        return redirect()->back()->with('success', 'Vendor created successfully!');
    }
}
