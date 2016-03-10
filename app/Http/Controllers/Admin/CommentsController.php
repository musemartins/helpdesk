<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\Project;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    public function create($slug, $issue)
    {
        $project = Project::findBySlug($slug);

        $issueInfo = Issue::findOrFail($issue);

        return view('admin.comments.create', compact('slug', 'issue', 'project', 'issueInfo'));
    }

    public function store(Request $request, $slug, $issue)
    {
        $this->validate($request, [
            'message'   =>  'required'
        ]);

        $userID = Auth::user()->id;

        Comment::create([
            'comment'   =>  $request->get('message'),
            'issue_id'  =>  $issue,
            'user_id'   =>  $userID
        ]);

        return redirect('/projects/' . $slug . '/issue/' . $issue . '/show');
    }

    public function edit($slug, $issue, $id)
    {
        $project = Project::findBySlug($slug);

        $issueInfo = Issue::findOrFail($issue);

        $comment = Comment::findOrFail($id);

        return view('admin.comments.edit', compact('comment', 'slug', 'issue', 'id', 'project', 'issueInfo'));
    }

    public function update(Request $request, $slug, $issue, $id)
    {
        $this->validate($request, [
            'message'   =>  'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = $request->get('message');
        $comment->save();

        return redirect('/projects/' . $slug . '/issue/' . $issue . '/show');
    }
}
