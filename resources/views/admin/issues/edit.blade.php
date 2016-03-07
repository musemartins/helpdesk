@extends('admin.layouts.master')

@section('projects', 'active')

@section('styles')
    <link rel="stylesheet" href="/helpdesk/public//bower_components/trumbowyg/dist/ui/trumbowyg.css">
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
                    <form role="form" action="{{ url('projects/' . $project . '/issue/' . $issue->id . '/edit') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group @if ($errors->has('programmer')) has-error @endif">
                                <label for="programmer">Assign to</label>
                                <select class="form-control" id="programmer" name="programmer">
                                    <option value="">Select a person</option>
                                    <option value="Carlos Martins" @if ($issue->assigned_to == "Carlos Martins") selected @endif>Carlos Martins</option>
                                    <option value="João Sá" @if ($issue->assigned_to == "João Sá") selected @endif>João Sá</option>
                                    <option value="Tiago Silva" @if ($issue->assigned_to == "Tiago Silva") selected @endif>Tiago Silva</option>
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('priority')) has-error @endif"">
                                <label for="priority">Priority</label>
                                <select class="form-control" id="priority" name="priority">
                                    <option value="">Select the priority</option>
                                    <option value="0" @if ($issue->priority == "0") selected @endif>High</option>
                                    <option value="1" @if ($issue->priority == "1") selected @endif>Medium</option>
                                    <option value="2" @if ($issue->priority == "2") selected @endif>Low</option>
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('status')) has-error @endif"">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">Select status</option>
                                    <option value="0" @if ($issue->status == "0") selected @endif>Open</option>
                                    <option value="1" @if ($issue->status == "1") selected @endif>Closed</option>
                                    <option value="2" @if ($issue->status == "2") selected @endif>Feedback</option>
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('issue')) has-error @endif">
                                <label for="issue">Issue</label>
                                <textarea name="issue" id="issue">{!! $issue->question !!}</textarea>
                            </div>
                            <!--
                            <div class="form-group">
                                <label for="uploadfiles">Upload Files <a><i class="fa fa-plus"></i></a></label>
                            </div>
                            <div class="files">
                                <div class="alert alert-danger">Only use the first {{ count($issue->files) }} file inputs if you want to edit one of the files!</div>
                                <?php $i = 1; ?>
                                @foreach ($issue->files as $file)
                                    <div class="form-group">
                                        <label for="files">File {{ $i }}</label>
                                        <input type="file" name="file[]" value="{{ $file->path }}">
                                        <span>{{ $file->path }}</span>
                                    </div>
                                    <?php $i++; ?>
                                @endforeach
                                <div class="form-group">
                                    <label for="files">File {{ count($issue->files) + 1 }}</label>
                                    <input type="file" name="file[]">
                                </div>
                            </div>
                            -->
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->

            </div>
        </div>   <!-- /.row -->
    </div><!-- /.content -->

@stop

@section('scripts')
    <script src="/helpdesk/public//bower_components/trumbowyg/dist/trumbowyg.min.js"></script>
    <script src="/helpdesk/public//bower_components/trumbowyg/dist/langs/fr.min.js"></script>
    <script src="/helpdesk/public//bower_components/trumbowyg/dist/plugins/upload/trumbowyg.upload.js"></script>
    <script src="/helpdesk/public//bower_components/trumbowyg/dist/plugins/base64/trumbowyg.base64.js"></script>
    <script src="/helpdesk/public//bower_components/trumbowyg/dist/plugins/colors/trumbowyg.colors.js"></script>
    <script type="text/javascript">
        $(function () {
             $('input[type="file"]').change(function () {
                  if ($(this).val() != "") {
                         $(this).css('color', 'black');
                         $(this).next().hide();
                  }else{
                         $(this).css('color', 'transparent');
                         $(this).next().show();
                  }
             });
        });
    </script>
    <script>
        
        $(document).ready(function() {

            $('#issue').trumbowyg();

            var counter = {{ count($issue->files) }} + 2;

            console.log(counter);

            $('body').on('click', '.fa-plus', function() {
                
                $('.files').append('<div class="form-group"><label for="files">File ' + counter + '</label><input type="file" name="file[]"></div>');

                counter += 1;
            });

        });

    </script>
@stop
