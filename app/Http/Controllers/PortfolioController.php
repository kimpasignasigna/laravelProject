<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    
    /**
     * Store a newly created portfolio.
     */
    public function store(Request $request)
    {
        $request->validate([
            'birthday' => 'required|date',
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'age' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'skill' => 'required|string|max:255',
            'messagetext' => 'required|string|max:255',
        ]);
        $portfolio = Portfolio::create([
            'user_id' => $request->user()->id, // Fixed: Correct way to get user ID
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'city' => $request->city,
            'age' => $request->age,
            'degree' => $request->degree,
            'skill' => $request->skill,
            'messagetext' => $request->messagetext,
        ]);

            return redirect()->back()->with('success', 'Background profile added successfully!');

    }

    public function update(Request $request, Portfolio $portfolio)
{
    $request->validate([
        'birthday' => 'required|date',
            'phone' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'age' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'skill' => 'required|string|max:255',
            'messagetext' => 'required|string|max:255',
    ]);

    $portfolio->update([
        'phone' => $request->phone,
        'birthday' => $request->birthday,
        'city' => $request->city,
        'degree' => $request->degree,
        'age' => $request->age,
        'skill' => $request->skill,
        'messagetext' => $request->messagetext,
    ]);

    return redirect()->back()->with('success', 'Background profile updated successfully!');
}

public function destroy(Portfolio $portfolio)
{
    $portfolio->delete();
    
    return redirect()->back()->with('success', 'Background profile deleted successfully!');
}

}
