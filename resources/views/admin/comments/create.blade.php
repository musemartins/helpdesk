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
                <li>
                    <a href="{{ url('/projects/' . $slug . '/issue/' . $issue . '/show') }}">{{ $issueInfo->title }}</a>
                </li>
                <li class="active">
                    <strong>New Reply</strong>
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
                    <form role="form" action="{{ url('projects/' . $slug . '/issue/' . $issue . '/create') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="ibox-content">
                            @if ($errors->has())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group @if ($errors->has('reply')) has-error @endif">
                                <label for="reply">Reply</label>
                                <textarea name="message" id="message" cols="30" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Insert</button>
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

            $('#message').trumbowyg();

            var counter = 2;

            $('body').on('click', '.fa-plus', function() {

                $('.files').append('<div class="form-group"><label for="files">File ' + counter + '</label><input type="file" name="file[]"></div>');

                counter += 1;
            });

        });

    </script>
@stop
