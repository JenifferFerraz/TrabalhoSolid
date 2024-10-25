<?php
namespace App\Services\Contracts;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

interface UserInterface {
    public function getAllUsers();
    public function createUser(UserCreateRequest $request);
    public function getUserById(string $id);
    public function updateUser(UserUpdateRequest $request, string $id);
    public function deleteUser(string $id);
}
