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
            <h2>Projects</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="#">Projects</a>
                </li>
                <li>
                    <a href="#">{{ $project->name }}</a>
                </li>
                <li class="active">
                    <strong>Issues</strong>
                </li>
            </ol>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <a href="{{ url('/projects/' . $slug . '/issue/create') }}" class="pull-right"><i class="fa fa-plus"></i>&nbsp; Add an issue</a>
                    </div>
                    <div class="ibox-content">
                        <table id="usersTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Issue ID</th>
                                    <th width="30%">Title</th>
                                    <th>Assigned To</th>
                                    <th>
                                        Submited By
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Updated
                                    </th>
                                    <th>
                                        Priority
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($issues as $key => $issue)
                                <tr>
                                    <td>{{ $issue->id }}</td>
                                    <td>
                                        {{ $issue->title }}
                                    </td>
                                    <td>
                                        {{ $users[$key]->name }}
                                    </td>
                                    <td>
                                        {{ $issue->user->name }}
                                    </td>
                                    <td>
                                        @if ($issue->status == 0)
                                            <span class="btn btn-sm btn-warning">Open</span>
                                        @elseif ($issue->status == 1)
                                            <span class="btn btn-sm btn-success">Closed</span>
                                        @elseif ($issue->status == 2)
                                            <span class="btn btn-sm btn-primary">Feedback</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($issue->updated_at != $issue->created_at)
                                            {{ $issue->updated_at }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($issue->priority == 0)
                                            <span class="btn btn-sm btn-danger">High</span>
                                        @elseif ($issue->priority == 1)
                                            <span class="btn btn-sm btn-warning">Medium</span>
                                        @elseif ($issue->priority == 2)
                                            <span class="btn btn-sm btn-primary">Low</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 24px;">
                                        <a href="{{ url('/projects/' . $slug . '/issue/' . $issue->id . '/show') }}" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                        @if (Auth::user()->id == $issue->user->id || Auth::user()->role == '0')
                                            <a href="{{ url('/projects/' . $slug . '/issue/' . $issue->id . '/edit') }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="{{ url('/projects/' . $slug . '/issue/' . $issue->id . '/delete') }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </div><!-- /.content -->
@stop

@section('scripts')
    <!-- DataTables -->
    @if (Auth::user()->id == 6)
        <script>
            $(function () {
                $('#usersTable').DataTable({
                    "order": [[ 4, "desc" ]],
                    "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                    "pageLength": 25
                });
            });
        </script>
    @else
        <script>
        $(function () {
            $('#usersTable').DataTable({
                "order": [[ 4, "desc" ]],
            });
        });
        </script>
    @endif
@stop
