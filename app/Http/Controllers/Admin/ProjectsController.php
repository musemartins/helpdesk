<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Toastr;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required|max:255|unique:projects'
        ]);

        Project::create([
            'name'  =>  $request->get('name')
        ]);

        $message = "Project created with success!";
        Toastr::success($message);

        return redirect('/projects');
    }

    public function edit($projects)
    {
        $project = Project::findOrFail($projects);

        return view('admin.projects.edit', compact('project', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  =>  'required|max:255|unique:projects'
        ]);

        $project = Project::findOrFail($id);
        $project->name = $request->get('name');
        $project->save();

        $message = "Project updated with success!";
        Toastr::success($message);

        return redirect('/projects');
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();

        $message = "Project deleted with success!";
        Toastr::success($message);

        return redirect('/projects');
    }
}
