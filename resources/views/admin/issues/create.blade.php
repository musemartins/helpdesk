@extends('admin.layouts.master')

@if (Auth::user()->accessLevel != 0)
    @section('projects', 'active')
@endif

@if (Auth::user()->accessLevel == 0 && $slug == 'mills-parasols')
    @section('mills', 'active')
@elseif (Auth::user()->accessLevel == 0 && $slug == 'liikenhealth')
    @section('liiken', 'active')
@endif

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
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
                <li class="active">
                    <strong>New Issue</strong>
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
                    <form role="form" action="{{ url('projects/' . $slug . '/issue/create') }}" method="POST" enctype="multipart/form-data">
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
                                <input type="text" name="title" id="title" class="form-control" placeholder="Issue Title" >
                            </div>
                            <div class="form-group @if ($errors->has('user')) has-error @endif">
                                <label for="user">Assign to</label>
                                <select class="form-control" id="user" name="user">
                                    <option value="">Select a person</option>
                                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                    @for ($i = 0; $i < count($users); $i++)
                                        @if ($slug == 'liikenhealth')
                                            @if (Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 2 || Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 0)
                                                <option value="{{ $users[$i]->id }}">{{ $users[$i]->name }}</option>
                                            @else
                                                $i++;
                                            @endif
                                        @elseif ($slug == 'mills-parasols')
                                            @if (Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 1 || Auth::user()->id != $users[$i]->id && $users[$i]->accessLevel == 0)
                                                <option value="{{ $users[$i]->id }}">{{ $users[$i]->name }}</option>
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
                                    <option value="0">High</option>
                                    <option value="1">Medium</option>
                                    <option value="2">Low</option>
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('status')) has-error @endif"">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select status</option>
                                    <option value="0">Open</option>
                                    <option value="1">Closed</option>
                                    <option value="2">Feedback</option>
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('issue')) has-error @endif">
                                <label for="issue">Issue</label>
                                <textarea name="issue" id="issue"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="submit-all">Insert</button>
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
