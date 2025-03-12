<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class PortfolioController extends Controller
{
    
    /**
     * Store a newly created portfolio.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|mimes:jpeg,jpg,png', 
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'age' => 'nullable|string|max:255',
            'degree' => 'nullable|string|max:255',
            'messagetext' => 'nullable|string|max:255',
        ]);
        $portfolio = Portfolio::create([
            'user_id' => $request->user()->id, // Fixed: Correct way to get user ID
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'city' => $request->city,
            'age' => $request->age,
            'degree' => $request->degree,
            'messagetext' => $request->messagetext,
        ]);
             // Handle the file upload for logo
             if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('logos'), $filename); // Store in public/logos folder
                $portfolio->logo = 'logos/' . $filename; // Save the relative path to the logo
            }

            $portfolio->save();

        return redirect(RouteServiceProvider::HOME);
    }

}
