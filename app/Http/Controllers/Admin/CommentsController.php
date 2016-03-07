<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Issue;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    public function create($project, $issue)
    {
        return view('admin.comments.create', compact('project', 'issue'));
    }

    public function store(Request $request, $project, $issue)
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

        return redirect('/projects/' . $project . '/issue/' . $issue . '/show');
    }

    public function edit($project, $issue, $id)
    {
        $comment = Comment::findOrFail($id);

        return view('admin.comments.edit', compact('comment', 'project', 'issue', 'id'));
    }

    public function update(Request $request, $project, $issue, $id)
    {
        $this->validate($request, [
            'message'   =>  'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->comment = $request->get('message');
        $comment->save();

        return redirect('/projects/' . $project . '/issue/' . $issue . '/show');
    }
}
