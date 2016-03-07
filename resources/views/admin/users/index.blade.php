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
                <li class="active">
                    <strong>Users List</strong>
                </li>
            </ol>
        </div>
    </div>
            
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <table id="usersTable" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Access Level</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role == '0')
                                                <button class="btn btn-primary">Administrator</button>
                                            @elseif ($user->role == '1')
                                                <button class="btn btn-primary">User</button>
                                            @elseif ($user->role == '2')
                                                <button class="btn btn-primary">Programmer</button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->accessLevel == '0')
                                                <button class="btn btn-info">All Projects</button>
                                            @elseif ($user->accessLevel == '1')
                                                <button class="btn btn-info">Mills Parasols</button>
                                            @elseif ($user->accessLevel == '2')
                                                <button class="btn btn-info">LiikenHealth</button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->status == '0')
                                                <button class="btn btn-primary">Active</button>
                                            @elseif ($user->status == '1')
                                                <button class="btn btn-danger">Inactive</button>

                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == '0')
                                                <a href="{{ url('/users/' . $user->id . '/edit') }}" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i></a>
                                                <a href="{{ url('/users/' . $user->id . '/delete') }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <!-- DataTables -->


    <!-- page script -->
    <script>
        $(function () {
            $('#usersTable').DataTable();
        });
    </script>
@stop
