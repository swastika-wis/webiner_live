<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendor()
    {
      
        $vendors = Vendor::paginate(5);
        return view('admin.vendor',compact('vendors'));
    }
    public function vendorStore(Request $request)
    {
       $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'theme_background' => 'nullable|string|max:7', // hex value
            'theme_foreground' => 'nullable|string|max:7',
            'logo'             => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('vendors', 'public');
        }

        Vendor::create([
            'name'             => $validated['name'],
            'theme_background' => $validated['theme_background'] ?? null,
            'theme_foreground' => $validated['theme_foreground'] ?? null,
            'logo'             => $logoPath,
        ]);

        return redirect()->back()->with('success', 'Vendor created successfully!');
    }
}
