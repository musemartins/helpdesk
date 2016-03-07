@extends('admin.layouts.master')

@section('projects', 'active')

@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Projects</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="{{ url('/projects') }}">Projects</a>
                </li>
                <li class="active">
                    <strong>Issues</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
            <div class="col-lg-8">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="m-b-md">
										@if (Auth::user()->id == $issue->user_id)
                                        	<a href="{{ url('/projects/' . $project . '/issue/' . $id . '/edit') }}" target="_blank" class="btn btn-white btn-xs pull-right">Edit Issue</a>
										@endif
                                        <h2>{{ $issue->title }}</h2>
                                    </div>
                                    <dl class="dl-horizontal">
                                        <dt>Status:</dt>
                                        <dd>
                                            @if (Auth::user()->id != $issue->user->id AND Auth::user()->role != '2')
                                                @if ($issue->status == 0)
                                                    <span class="label label-warning">Open</span>
                                                @elseif ($issue->status == 1)
                                                    <span class="label label-primary">Closed</span>
                                                @elseif ($issue->status == 2)
                                                    <span class="label label-success">Feedback</span>
                                                @endif
                                            @else
                                                <select name="status" id="status" data-project="{{ $project }}" data-id="{{ $issue->id }}">
                                                    <option value="0" @if ($issue->status == 0) selected @endif>Open</option>
                                                    <option value="1" @if ($issue->status == 1) selected @endif>Closed</option>
                                                    <option value="2" @if ($issue->status == 2) selected @endif>Feedback</option>
                                                </select>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5">
                                    <dl class="dl-horizontal">

                                        <dt>Submited by:</dt> <dd>{{ $issue->user->name }}</dd>
                                        <dt>Assigned To:</dt> <dd>{{ $issue->assigned_to }}</dd>
                                        <dt>Messages:</dt> <dd>  TODO</dd>
                                    </dl>
                                </div>
                                <div class="col-lg-7" id="cluster_info">
                                    <dl class="dl-horizontal" >

                                        <dt>Last Updated:</dt> <dd>{{ $issue->updated_at }}</dd>
                                        <dt>Created:</dt> <dd> 	{{ $issue->created_at }} </dd>
                                    </dl>
                                </div>
                            </div>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
	                                <div class="panel blank-panel">
		                                <div class="panel-body">

			                                <div class="tab-content">
				                                <div class="tab-pane active" id="tab-1">
				                                    <div class="feed-activity-list">
				                                    	<div class="feed-element">
				                                            <div class="media-body ">
				                                                <strong>{{ $issue->user->name }}</strong> <span class="label label-primary">Ticket</span><br>
				                                                <small class="text-muted">{{ $issue->created_at }}</small>
				                                                <div class="well">
				                                                	{!! $issue->question !!}
				                                                	<br>
				                                                	<br>
				                                                	@if (Auth::user()->id == $issue->user->id)
                                                                        <a href="{{ url('/projects/' . $project . '/issue/' . $id . '/edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                                                    @elseif (Auth::user()->id != $issue->user->id AND Auth::user()->role == '2')
                                                                        <a href="{{ url('/projects/' . $project . '/issue/' . $id . '/create') }}"><i class="fa fa-mail-reply"></i></a>
                                                                    @endif
				                                                </div>
				                                            </div>
				                                        </div>
														
														@for ($i = 0; $i < count($issue->comments); $i++)
					                                        <div class="feed-element">
					                                            <div class="media-body ">
					                                                <strong>{{ $users[$i]->name }}</strong>@if ($users[$i]->id == $issue->user->id) <span class="label label-primary">Owner</span> @else <span class="label label-success">Programmer</span> @endif<br>
					                                                <small class="text-muted">{{ $issue->comments[$i]->created_at }}</small>
					                                                <div class="well">
					                                                    {!! $issue->comments[$i]->comment !!}
					                                                    <br>
					                                                    <br>
                                                                        @if (Auth::user()->id == $issue->comments[$i]->user_id)
                                                                            <a href="{{ url('/projects/' . $project . '/issue/' . $id . '/answer/' . $issue->comments[$i]->id . '/edit') }}"><i class="fa fa-pencil-square-o"></i></a>
                                                                        @elseif (Auth::user()->id != $issue->comments[$i]->user_id)
                                                                            <a href="{{ url('/projects/' . $project . '/issue/' . $id . '/create') }}"><i class="fa fa-mail-reply"></i></a>
                                                                        @endif
					                                                </div>
					                                            </div>
					                                        </div>
														@endfor
				                                    </div>
				                                </div>
			                                </div>

		                                </div>

	                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="wrapper wrapper-content project-manager">
                    <p class="small font-bold">
                        @if (Auth::user()->id != $issue->user->id AND Auth::user()->role != '2')
                            @if ($issue->priority == 0)
                                <span><i class="fa fa-circle text-danger"></i> High Priority</span>
                            @elseif ($issue->priority == 1)
                                <span><i class="fa fa-circle text-warning"></i> Medium Priority</span>
                            @elseif ($issue->priority == 2)
                                <span><i class="fa fa-circle text-success"></i> Low Priority</span>
                            @endif
                        @else
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority" data-project="{{ $project }}" data-id="{{ $issue->id }}">
                                <option value="0" @if ($issue->priority == 0) selected @endif>High Priority</option>
                                <option value="1" @if ($issue->priority == 1) selected @endif>Medium Priority</option>
                                <option value="2" @if ($issue->priority == 2) selected @endif>Low Priority</option>
                            </select>
                        @endif
                    </p>
                    <h5>Project files</h5>
                    <ul class="list-unstyled project-files">
                    	@foreach ($issue->files as $file)
                        	<li><a href="#"><i class="fa fa-file"></i> {{ $file->path }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
@stop

@section('scripts')
    <script>

        $(document).ready(function() {

            $('#priority').change(function() {

                var baseURL = "{{ url('/') }}";
                var value = $(this).val();
                var project = $(this).data('project');
                var id = $(this).data('id');

                $.ajax({
                    url: baseURL + '/projects/' + project + '/issue/' + id + '/priority',
                    method: "POST",
                    data: {value: value},
                    success: function() {
                        location.reload();
                    }
                })

            });

            $('#status').change(function() {

                var baseURL = "{{ url('/') }}";
                var value = $(this).val();
                var project = $(this).data('project');
                var id = $(this).data('id');

                $.ajax({
                    url: baseURL + '/projects/' + project + '/issue/' + id + '/status',
                    method: "POST",
                    data: {value: value},
                    success: function() {
                        location.reload();
                    }
                });

            });

        });

    </script>
@stop
