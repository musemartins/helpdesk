<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\User;
use App\Models\File;
use Auth;

class IssuesController extends Controller
{
    public function index($project)
    {
        $issues = Issue::with('user')->where('project_id', $project)->get();

        return view('admin.issues.index', compact('issues', 'project'));
    }

    public function show($project, $id)
    {
        $issue = Issue::with('user')->with('files')->with('comments')->findOrFail($id);

        foreach ($issue->comments as $comment) {
            $users[] = User::where('id', $comment->user_id)->first();
        }
        
        return view('admin.issues.show', compact('project', 'id', 'issue', 'users'));
    }

    public function create($project)
    {

        return view('admin.issues.create', compact('project'));
    }

    public function store(Request $request, $project)
    {
        $this->validate($request, [
            'programmer'    =>  'required',
            'title'         =>  'required|max:255',
            'priority'      =>  'required',
            'status'        =>  'required',
            'issue'         =>  'required'
        ]);

        $userID = Auth::user()->id;

        Issue::create([
            'assigned_to'   =>  $request->get('programmer'),
            'title'         =>  $request->get('title'),
            'question'      =>  $request->get('issue'),
            'user_id'       =>  $userID,
            'priority'      =>  $request->get('priority'),
            'status'        =>  $request->get('status'),
            'priority'      =>  $request->get('priority'),
            'project_id'    =>  $project
        ]);

        $lastIssue = Issue::orderBy('created_at', 'desc')->first();

        $issueID = $lastIssue->id;

        $files = $request->file('file');

        if (count($files) > 1) {
            foreach ($files as $file) {
                $destinationPath = 'uploads/issue';
                $fileName = $file->getClientOriginalName();
                $uploadSuccess = $file->move($destinationPath, $fileName);

                if ($uploadSuccess) {
                    File::create([
                        'path'      =>  $fileName,
                        'user_id'   =>  $userID,
                        'issue_id'  =>  $issueID
                    ]);
                }
            }
        }

        return redirect('/projects/' . $project);
    }

    public function edit($project, $id)
    {
        $issue = Issue::with('files')->findOrFail($id);

        return view('admin.issues.edit', compact('project', 'issue', 'id'));
    }

    public function update(Request $request, $project, $id)
    {
        $this->validate($request, [
            'programmer'    =>  'required',
            'title'         =>  'required|max:255',
            'priority'      =>  'required',
            'status'        =>  'required',
            'issue'         =>  'required'
        ]);

        $userID = Auth::user()->id;

        $issue = Issue::findOrFail($id);
        $issue->assigned_to =   $request->get('programmer');
        $issue->title       =   $request->get('title');
        $issue->question    =   $request->get('issue');
        $issue->user_id     =   $userID;
        $issue->status      =   $request->get('status');
        $issue->priority    =   $request->get('priority');
        $issue->save();

        return redirect('/projects/' . $project);
    }

    public function destroy($project, $id)
    {
        Issue::findOrFail($id)->delete();

        return redirect('/projects/' . $project);
    }

    public function changePriority(Request $request, $project, $id)
    {
        $newPriority = (int)$request->get('value');

        $issue = Issue::findOrFail($id);
        $issue->priority = $newPriority;
        $issue->save();
    }

    public function changeStatus(Request $request, $project, $id)
    {
        $newStatus = (int)$request->get('value');

        $issue = Issue::findOrFail($id);
        $issue->status = $newStatus;
        $issue->save();
    }
}
