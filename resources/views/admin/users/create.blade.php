@extends('admin.layouts.master')

@section('users', 'active')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="{{ url('/users') }}">Users List</a>
                </li>
                <li class="active">
                    <strong>Add a user</strong>
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
                    <form role="form" action="{{ url('users/create') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="ibox-content">
                            @if ($errors->has())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="form-group @if ($errors->has('role')) has-error @endif">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" >
                                    <option value="">Select a role</option>
                                    <option value="0">Administrator</option>
                                    <option value="1">User</option>
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('accessLevel')) has-error @endif">
                                <label for="accessLevel">Access Level</label>
                                <select class="form-control" name="accessLevel" >
                                    <option value="">Select the access level</option>
                                    <option value="0">All Projects</option>
                                    <option value="1">Mills Project</option>
                                    <option value="2">Liiken Project</option>
                                </select>
                            </div>
                            <div class="form-group @if ($errors->has('status')) has-error @endif">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" >
                                    <option value="">Select the status</option>
                                    <option value="0">Active</option>
                                    <option value="1">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Insert</button>
                            </div>
                        </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->

            </div>
        </div>   <!-- /.row -->
    </div><!-- /.content -->

@stop
