<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        return view('dashboard', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'link' => 'nullable|url',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $filename);
        $validated['image'] = 'uploads/' . $filename;
    }

    Project::create($validated);

    return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
}


    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
{
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'link' => 'nullable|url',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $filename);
        $validated['image'] = 'uploads/' . $filename;
    }
    if ($project->image && file_exists(public_path($project->image))) {
        unlink(public_path($project->image));
    }
    
    $project->update($validated);

    return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
}


    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }
}
