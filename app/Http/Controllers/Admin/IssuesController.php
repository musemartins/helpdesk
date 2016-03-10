<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\User;
use App\Models\File;
use App\Models\Project;
use Auth;
use Validator;
use Mail;
use Illuminate\Support\Facades\Response;

class IssuesController extends Controller
{
    public function index($slug)
    {
        $project = Project::findBySlug($slug);

        $issues = Issue::with('user')->where('project_id', $project->id)->get();

        foreach ($issues as $issue) {
            $users[] = User::where('id', $issue->assigned_to)->first();
        }

        return view('admin.issues.index', compact('issues', 'slug', 'project', 'users'));
    }

    public function show($slug, $id)
    {
        $project = Project::findBySlug($slug);

        $listUsers = User::all();

        $issue = Issue::with('user')->with('files')->with('comments')->findOrFail($id);

        $assignedTo = User::where('id', $issue->assigned_to)->first();

        foreach ($issue->comments as $comment) {
            $users[] = User::where('id', $comment->user_id)->first();
        }
        
        return view('admin.issues.show', compact('slug', 'id', 'issue', 'users', 'listUsers', 'project', 'assignedTo'));
    }

    public function create($slug)
    {
        $users = User::all();

        $project = Project::findBySlug($slug);


        return view('admin.issues.create', compact('slug', 'users', 'project'));
    }

    public function store(Request $request, $slug)
    {
        $this->validate($request, [
            'user'          =>  'required',
            'title'         =>  'required|max:255',
            'priority'      =>  'required',
            'status'        =>  'required',
        ]);

        $userID = Auth::user()->id;

        $project = Project::findBySlug($slug);

        Issue::create([
            'assigned_to'   =>  $request->get('user'),
            'title'         =>  $request->get('title'),
            'question'      =>  $request->get('issue'),
            'user_id'       =>  $userID,
            'priority'      =>  $request->get('priority'),
            'status'        =>  $request->get('status'),
            'priority'      =>  $request->get('priority'),
            'project_id'    =>  $project->id
        ]);

        $lastIssue = Issue::orderBy('created_at', 'desc')->first();

        $issueID = $lastIssue->id;

        $userAssigned = User::where('id', $request->get('user'))->first();
        $userOwner = User::where('id', $userID)->first();
        $url = "dev.flexefelina.pt/helpdesk/public/projects/" . $slug . "/issue/" . $issueID . "/show";
        $data = [
            $userAssigned->email,
            $userAssigned->name,
            $userOwner->email,
            $userOwner->name,
            $url
        ];
        //$data[0], $data[1]

        Mail::send('emails.default', ['data' => $data], function ($m) use ($data) {
            $m->from('mparasols@gmail', 'Helpdesk');

            $m->to($data[0], $data[1])->subject('New ticket assigned to you!');
        });

        return redirect('/projects/' . $slug . '/issue/create/' . $issueID . '/upload');
    }

    public function edit($slug, $id)
    {
        $project = Project::findBySlug($slug);

        $users = User::all();

        $issue = Issue::with('files')->findOrFail($id);

        return view('admin.issues.edit', compact('slug', 'issue', 'id', 'project', 'users'));
    }

    public function update(Request $request, $slug, $id)
    {
        $this->validate($request, [
            'user'          =>  'required',
            'title'         =>  'required|max:255',
            'priority'      =>  'required',
            'status'        =>  'required',
        ]);

        $issue = Issue::findOrFail($id);
        $issue->assigned_to =   $request->get('user');
        $issue->title       =   $request->get('title');
        $issue->question    =   $request->get('issue');
        $issue->status      =   $request->get('status');
        $issue->priority    =   $request->get('priority');
        $issue->save();

        $userAssigned = User::where('id', $request->get('user'))->first();
        $userOwner = User::where('id', $userID)->first();
        $url = "dev.flexefelina.pt/helpdesk/public/projects/" . $slug . "/issue/" . $id . "/show";
        $data = [
            $userAssigned->email,
            $userAssigned->name,
            $userOwner->email,
            $userOwner->name,
            $url
        ];
        //$data[0], $data[1]

        Mail::send('emails.update', ['data' => $data], function ($m) use ($data) {
            $m->from('mparasols@gmail', 'Helpdesk');

            $m->to($data[2], $data[3])->subject('New update on your ticket!');
        });

        return redirect('/projects/' . $slug . '/issue/' . $id . '/edit/upload');
    }

    public function destroy($slug, $id)
    {
        Issue::findOrFail($id)->delete();

        $files = File::where('issue_id', $id)->get();

        foreach ($files as $file) {
            unlink(base_path() . '/public/uploads/issue/' . $file->path);
            $file->delete();
        }

        return redirect('/projects/' . $slug);
    }

    public function changePriority(Request $request, $slug, $id)
    {
        $newPriority = (int)$request->get('value');

        $issue = Issue::findOrFail($id);
        $userID = $issue->user_id;
        $issue->priority = $newPriority;
        $issue->save();

        $userAssigned = User::where('id', $issue->assigned_to)->first();
        $userOwner = User::where('id', $userID)->first();
        $url = "dev.flexefelina.pt/helpdesk/public/projects/" . $slug . "/issue/" . $id . "/show";
        $data = [
            $userAssigned->email,
            $userAssigned->name,
            $userOwner->email,
            $userOwner->name,
            $url
        ];
        //$data[0], $data[1]

        Mail::send('emails.update', ['data' => $data], function ($m) use ($data) {
            $m->from('mparasols@gmail', 'Helpdesk');

            $m->to($data[2], $data[3])->subject('New update on your ticket!');
        });

    }

    public function changeStatus(Request $request, $slug, $id)
    {
        $newStatus = (int)$request->get('value');

        $issue = Issue::findOrFail($id);
        $userID = $issue->user_id;

        $issue->assigned_to = $newStatus;
        $issue->save();

        $userAssigned = User::where('id', $request->get('user'))->first();
        $userOwner = User::where('id', $userID)->first();
        $url = "dev.flexefelina.pt/helpdesk/public/projects/" . $slug . "/issue/" . $id . "/show";
        $data = [
            $userAssigned->email,
            $userAssigned->name,
            $userOwner->email,
            $userOwner->name,
            $url
        ];
        //$data[0], $data[1]

        Mail::send('emails.update', ['data' => $data], function ($m) use ($data) {
            $m->from('mparasols@gmail', 'Helpdesk');

            $m->to($data[2], $data[3])->subject('New update on your ticket!');
        });
    }

    public function changeAssignedTo(Request $request, $slug, $id)
    {
        $newAssignedTo = (int)$request->get('value');

        $issue = Issue::findOrFail($id);

        $userID = $issue->user_id;

        $issue->assigned_to = $newAssignedTo;
        $issue->save();

        $userAssigned = User::where('id', $request->get('user'))->first();
        $userOwner = User::where('id', $userID)->first();
        $mail = 'carlosmartins353@gmail.com';
        $data = [
            $userAssigned->email,
            $userAssigned->name,
            //$userOwner->email,
            $mail,
            $userOwner->name
        ];
        //$data[0], $data[1]

        Mail::send('emails.default', ['data' => $data], function ($m) use ($data) {
            $m->from('mparasols@gmail', 'Helpdesk');

            $m->to($data[2], $data[3])->subject('New update on your ticket!');
        });

    }

    public function getUpload($slug, $id)
    {
        $project = Project::findBySlug($slug);

        return view('admin.issues.files', compact('project', 'slug', 'id'));
    }

    public function upload(Request $request, $slug, $id)
    {
        $destinationPath = base_path() . '/public/uploads/issue/';

        $filename = $request->file('file')->getClientOriginalName();
        $request->file('file')->move($destinationPath, $filename);

        File::create([
            'path'      =>  $filename,
            'user_id'   =>  Auth::user()->id,
            'issue_id'  =>  $id,
        ]);

    }

    public function download($slug, $id, $file)
    {
        $file = public_path() . '/uploads/issue/' . $file;

        return Response::download($file);
    }

    public function getUpdateUpload($slug, $id)
    {
        $files = File::where('issue_id', '=', $id)->get();
        $project = Project::findBySlug($slug);
        $issue = Issue::where('id', $id)->first();

        return view('admin.issues.edit-files', compact('slug', 'id', 'files', 'project', 'issue'));
    }

    public function updateUpload(Request $request, $slug, $id)
    {
        $destinationPath = base_path() . '/public/uploads/issue/';

        $filename = $request->file('file')->getClientOriginalName();
        $request->file('file')->move($destinationPath, $filename);

        File::create([

            'path'      =>  $filename,
            'user_id'   =>  Auth::user()->id,
            'issue_id'  => $id,

        ]);
    }

    public function deleteImage($slug, $id, $fileID)
    {
        $file = File::findOrFail($fileID);

        unlink(base_path() . '/public/uploads/issue/' . $file->path);

        $file->delete();

        return redirect('/projects/' . $slug . '/issue/' . $id . '/edit/upload');
    }
}
