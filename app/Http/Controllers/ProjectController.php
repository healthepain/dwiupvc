<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Gate;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        $projects = Project::latest()->get();
    } else {
        $projects = Project::where('user_id', $user->id)
            ->latest()
            ->get();
    }

    $data = [
        'title' => 'Project',
        'menuProject' => 'active',
        'projects' => $projects,
    ];

    return view('admin.project.index', $data);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required',
            'project_description' => 'required',
            'project_status' => 'required|in:not_started,in_progress,completed',
            'value_project' => 'required|integer|min:0',
        ]);
         
        Project::create([
            'project_name' => $request->project_name,
            'project_description' => $request->project_description,
            'project_status' => $request->project_status,
            'value_project' => $request->value_project,
            'user_id' => auth()->id(),
        ]);
        return redirect()
        ->route('project.index')
        ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $project = Project::with('products')->findOrFail($id);

    Gate::authorize('view', $project);

    $data = [
        'title' => 'Project Details',
        'menuProject' => 'active',
        'projects' => $project,
    ];

    return view('admin.project.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('project.index')->with('success', 'Project deleted successfully.');
    }
}
