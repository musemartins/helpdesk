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
                    @foreach ($files as $file)
                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                            <div class="thumbnail">
                                <img class="img-responsive" src="{{ url('/uploads/issue/' . $file->path) }}" height="200">
                                <div class="caption">
                                    <a href="{{ url('/projects/' . $slug . '/issue/' . $id . '/edit/upload/' . $file->id . '/delete') }}" class="btn btn-danger center-block ">Delete image</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="ibox-content">
                        <form role="form" action="{{ url('projects/' . $slug . '/issue/create/' . $id . '/upload') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                            {{ csrf_field() }}
                        </form>
                        <br>
                        <a href="{{ url('/projects/' . $slug) }}" class="btn btn-primary">
                            Continue
                        </a>
                    </div>
                </div><!-- /.box -->

            </div>
        </div>   <!-- /.row -->
    </div><!-- /.content -->
@stop

@section('scripts')
    <script>
        /* __________________ RESPONSIVE EQUAL HEIGHTS __________________*/
        /*! jquery.matchHeight-min.js v0.5.1   |   http://brm.io/jquery-match-height/   |   License: MIT  */

        (function(a){a.fn.matchHeight=function(b){if("remove"===b){var f=this;this.css("height","");a.each(a.fn.matchHeight._groups,function(g,h){h.elements=h.elements.not(f)});return this}if(1>=this.length){return this}b="undefined"!==typeof b?b:!0;a.fn.matchHeight._groups.push({elements:this,byRow:b});a.fn.matchHeight._apply(this,b);return this};a.fn.matchHeight._apply=function(b,g){var h=a(b),f=[h];g&&(h.css({display:"block","padding-top":"0","padding-bottom":"0","border-top":"0","border-bottom":"0",height:"100px"}),f=c(h),h.css({display:"","padding-top":"","padding-bottom":"","border-top":"","border-bottom":"",height:""}));a.each(f,function(i,l){var k=a(l),j=0;k.each(function(){var m=a(this);m.css({display:"block",height:""});m.outerHeight(!1)>j&&(j=m.outerHeight(!1));m.css({display:""})});k.each(function(){var m=a(this),n=0;"border-box"!==m.css("box-sizing")&&(n+=e(m.css("border-top-width"))+e(m.css("border-bottom-width")),n+=e(m.css("padding-top"))+e(m.css("padding-bottom")));m.css("height",j-n)})});return this};a.fn.matchHeight._applyDataApi=function(){var b={};a("[data-match-height], [data-mh]").each(function(){var f=a(this),g=f.attr("data-match-height");b[g]=g in b?b[g].add(f):f});a.each(b,function(){this.matchHeight(!0)})};a.fn.matchHeight._groups=[];var d=-1;a.fn.matchHeight._update=function(b){if(b&&"resize"===b.type){b=a(window).width();if(b===d){return}d=b}a.each(a.fn.matchHeight._groups,function(){a.fn.matchHeight._apply(this.elements,this.byRow)})};a(a.fn.matchHeight._applyDataApi);a(window).bind("load resize orientationchange",a.fn.matchHeight._update);var c=function(b){var f=null,g=[];a(b).each(function(){var i=a(this),k=i.offset().top-e(i.css("margin-top")),j=0<g.length?g[g.length-1]:null;null===j?g.push(i):1>=Math.floor(Math.abs(f-k))?g[g.length-1]=j.add(i):g.push(i);f=k});return g},e=function(b){return parseFloat(b)||0}})(jQuery);


        $(document).ready(function () {


            /* ----------  equal height columns   -------- */
            $('.img-responsive').css('height', '200px');



        }); // end document ready
    </script>
@stop