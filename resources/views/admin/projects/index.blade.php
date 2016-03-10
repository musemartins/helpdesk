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
                <li class="active">
                    <strong>Projects</strong>
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
                    <div class="ibox-content">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($projects as $key => $project)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td style="font-size: 24px;">
                                        <a href="{{ url('/projects/' . $project->slug) }}" class="btn btn-primary"><i class="fa fa-search"></i></a>
                                        @if (Auth::user()->role == '0')
                                            <a href="{{ url('/projects/' . $project->slug . '/edit') }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="{{ url('/projects/' . $project->slug . '/delete') }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
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