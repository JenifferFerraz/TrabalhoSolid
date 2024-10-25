<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Contracts\UserInterface;

class UserService implements UserInterface
{
    public function getAllUsers() {
        return User::select('id', 'name', 'email', 'created_at')->paginate(10);
    }

    public function createUser(UserCreateRequest $request) {
        $data = $request->validated();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getUserById(string $id) {
        return User::find($id);
    }

    public function updateUser(UserUpdateRequest $request, string $id) {
        $data = $request->validated();
        $user = User::find($id);
        if (!$user) return null;

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function deleteUser(string $id) {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        }
        return false;
    }
}