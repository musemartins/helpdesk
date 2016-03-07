<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;
use Toastr;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {

    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          =>  'required|max:255',
            'email'         =>  'required|email|max:255|unique:users',
            'password'      =>  'required|max:255',
            'role'          =>  'required',
            'accessLevel'   =>  'required',
            'status'        =>  'required'
        ]);

        User::create([
            'name'          =>  $request->get('name'),
            'email'         =>  $request->get('email'),
            'password'      =>  bcrypt($request->get('password')),
            'role'          =>  $request->get('role'),
            'accessLevel'   =>  $request->get('accessLevel'),
            'status'        =>  $request->get('status')
        ]);

        $message = "User created with success!";
        Toastr::success($message);

        return redirect('/users');

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'id'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          =>  'required|max:255',
            'email'         =>  'required|email|max:255',
            'role'          =>  'required',
            'accessLevel'   =>  'required',
            'status'        =>  'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        $user->accessLevel = $request->get('accessLevel');
        $user->status = $request->get('status');

        if ($request->has('password')) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        $message = "User updated with success!";
        Toastr::success($message);

        return redirect('/users');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        $message = "User deleted with success!";
        Toastr::success($message);

        return redirect('/users');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);

        $user->status = 0;
        $user->save();

        $message = "User activated with success!";
        Toastr::success($message);

        return redirect('/users');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);

        $user->status = 1;
        $user->save();

        $message = "User deactivated with success!";
        Toastr::success($message);

        return redirect('/users');
    }
}
