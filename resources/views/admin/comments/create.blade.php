@extends('admin.layouts.master')

@section('projects', 'active')

@section('styles')
    <link rel="stylesheet" href="/bower_components/trumbowyg/dist/ui/trumbowyg.css">
@stop

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
                <li>
                    <a href="{{ url('/projects/' . $project) }}">Issues</a>
                </li>
                <li>
                    <a href="{{ url('/projects/' . $project . '/issue/' . $issue . '/show') }}">Issue</a>
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
                    <form role="form" action="{{ url('projects/' . $project . '/issue/' . $issue . '/create') }}" method="POST" enctype="multipart/form-data">
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
    <script src="/bower_components/trumbowyg/dist/trumbowyg.min.js"></script>
    <script src="/bower_components/trumbowyg/dist/langs/fr.min.js"></script>
    <script src="/bower_components/trumbowyg/dist/plugins/upload/trumbowyg.upload.js"></script>
    <script src="/bower_components/trumbowyg/dist/plugins/base64/trumbowyg.base64.js"></script>
    <script src="/bower_components/trumbowyg/dist/plugins/colors/trumbowyg.colors.js"></script>
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
