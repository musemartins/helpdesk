@extends('admin.layouts.master')

@section('projects', 'active')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-6">
            <h2>{{ $project->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="{{ url('/projects') }}">Projects</a>
                </li>
                <li>
                    <a href="{{ url('/projects/' . $slug) }}">{{ $project->name }}</a>
                </li>
                <li>
                    <a href="{{ url('/projects/' . $slug . '/issue/' . $issue->id . '/show') }}">{{ $issue->title }}</a>
                </li>
                <li class="active">
                    <strong>Edit Issue</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="ibox float-e-margins">
                    <!-- form start -->
                    <form role="form" action="{{ url('projects/' . $slug . '/issue/' . $issue->id . '/edit') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="ibox-content">
                            @if ($errors->has())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group @if ($errors->has('title')) has-error @endif">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Issue Title" value="{{ $issue->title }}">
                            </div>
                            <div class="form-group @if ($errors->has('user')) has-error @endif">
                                <label for="user">Assign to</label>
                                <select class="form-control" id="user" name="user">
                                    <option value="">Select a person</option>
                                    @for ($i = 0; $i < count($users); $i++)
                                        @if ($slug == 'liikenhealth')
                                            @if (Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 2 || Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 0)
                                                <option value="{{ $users[$i]->id }}" @if($users[$i]->id == $issue->assigned_to) selected  @endif>{{ $users[$i]->name }}</option>
                                            @else
                                                $i++;
                                            @endif
                                        @elseif ($slug == 'mills-parasols')
                                            @if (Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 1 || Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 0)
                                                <option value="{{ $users[$i]->id }}" @if($users[$i]->id == $issue->assigned_to) selected  @endif>{{ $users[$i]->name }}</option>
                                            @else
                                                $i++;
                                            @endif
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('priority')) has-error @endif"">
                            <label for="priority">Priority</label>
                            <select class="form-control" id="priority" name="priority">
                                <option value="">Select the priority</option>
                                <option value="0" @if ($issue->priority == 0) selected @endif>High</option>
                                <option value="1" @if ($issue->priority == 1) selected @endif>Medium</option>
                                <option value="2" @if ($issue->priority == 2) selected @endif>Low</option>
                            </select>
                        </div>
                        <div class="form-group @if ($errors->has('status')) has-error @endif"">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Select status</option>
                            <option value="0" @if ($issue->status == 0) selected @endif>Open</option>
                            <option value="1" @if ($issue->status == 1) selected @endif>Closed</option>
                            <option value="2" @if ($issue->status == 2) selected @endif>Feedback</option>
                        </select>
                </div>
                <div class="form-group @if ($errors->has('issue')) has-error @endif">
                    <label for="issue">Issue</label>
                    <textarea name="issue" id="issue">{!! $issue->question !!}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="submit-all">Edit</button>
            </div><!-- /.box-body -->
            </form>
        </div><!-- /.box -->

    </div>
    </div>   <!-- /.row -->
    </div><!-- /.content -->

@stop

@section('scripts')
    <script>

        $(document).ready(function() {

            $('#issue').trumbowyg();

        });
    </script>
@stop
