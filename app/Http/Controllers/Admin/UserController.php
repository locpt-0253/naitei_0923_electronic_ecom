<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(10);

        return view('admin.users.index', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.edit', ['user' => $user, 'roles' => Role::all()]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()
            ->route('admin.users.edit', ['user' => $user, 'roles' => Role::all()])
            ->with('success', __('Update :resource :status', ['resource' => __('User'), 'status' => __('Success')]));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', __('Delete :resource :status', ['resource' => __('User'), 'status' => __('Success')]));
    }
}
