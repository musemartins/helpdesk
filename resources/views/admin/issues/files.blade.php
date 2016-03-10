@extends('admin.layouts.master')

@section('projects', 'active')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
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
                    <form role="form" action="{{ url('projects/' . $slug . '/issue/create/' . $id . '/upload') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                        {{ csrf_field() }}
                    </form>
                    <div class="ibox-content">
                        <a href="{{ url('/projects/' . $slug) }}" class="btn btn-primary">
                            Continue
                        </a>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div>
        </div>   <!-- /.row -->
    </div><!-- /.content -->
@stop