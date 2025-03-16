<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
/**
     * Store a newly created portfolio.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'projectfile' => 'required|mimes:pdf,doc,docx,xls,xlsx,txt,zip'
        ]);
    
        // Create a new project record
        $project = Project::create([
            'user_id' => $request->user()->id, // Correct way to get user ID
            'name' => $request->name,
        ]);
    
  // Handle the file upload
  if ($request->hasFile('projectfile')) {
    $file = $request->file('projectfile');
    $filename = time() . '.' . $file->getClientOriginalExtension();

    // Store file in storage/app/public/projectfiles folder
    $file->storeAs('public/projectfiles', $filename);

    // Save the relative path to the database
    $project->projectfile = 'storage/projectfiles/' . $filename;
    $project->save(); // ✅ This is what was missing!
}
    
 return response()->json(['success' => true, 'message' => 'Project added successfully!']);
    }

    public function update(Request $request, Project $project)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'projectfile' => 'required|mimes:pdf,doc,docx,xls,xlsx,txt,zip'
    ]);

    $project->update([
        'name' => $request->name,
    ]);

 // Handle the file upload
 if ($request->hasFile('projectfile')) {
    $file = $request->file('projectfile');
    $filename = time() . '.' . $file->getClientOriginalExtension();

    // Store file in storage/app/public/projectfiles folder
    $file->storeAs('public/projectfiles', $filename);

    // Save the relative path to the database
    $project->projectfile = 'storage/projectfiles/' . $filename;
    $project->save(); // ✅ This is what was missing!
}


    return response()->json(['success' => true, 'message' => 'Project added successfully!']);

}

public function destroy(Project $project)
{
    $project->delete();
    
    return redirect()->back()->with('success', 'Project deleted successfully!');
}

}