<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserSearchRequest;
use App\Http\Requests\UserUpdateRequest;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::getUsers()->latest()
            ->simplePaginate(config('app.paginate_number'));

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->only('name', 'email', 'role_id'));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function toggleActivate(Request $request, User $user)
    {
        $user->update([
            'is_active' => $request->input('is_active'),
        ]);

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    public function searchUsers(UserSearchRequest $request)
    {
        $users = User::filter($request->validated())->get();
        return response()->json([
            'success' => true,
            'data' => $users->map(function ($user) {
                return [
                    'created_at' => $user->created_at->toDateTimeString(),
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => ['name' => $user->role->name],
                    'editLink' => route('users.edit', $user->id),
                    'toggleActivateLink' => route('admin.user.toggleActivate', $user->id),
                    'is_active' => $user->is_active,
                ];
            }),
            'count' => $users->count(),
        ]);
    }
}
