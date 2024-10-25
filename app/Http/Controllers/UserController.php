<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Services\UserService; // Importando o UserService
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();

        return [
            'status' => 200,
            'message' => 'Usuários encontrados!!',
            'users' => $users
        ];
    }

    public function me()
    {
        $user = $this->userService->getCurrentUser();

        return [
            'status' => 200,
            'message' => 'Usuário logado!',
            'usuario' => $user
        ];
    }

    public function store(UserCreateRequest $request)
    {
        $user = $this->userService->createUser($request);

        return [
            'status' => 200,
            'message' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    public function show(string $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário encontrado com sucesso!!',
            'user' => $user
        ];
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = $this->userService->updateUser($request, $id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'Usuário não encontrado! Que triste!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!!',
            'user' => $user
        ];
    }

    public function destroy(string $id)
    {
        if ($this->userService->deleteUser($id)) {
            return [
                'status' => 200,
                'message' => 'Deu certo !'
            ];
        }

        return [
            'status' => 404,
            'message' => ':(((((!'
        ];
    }

    public function updateJeniffer(Request $request, string $id)
    {
        $user = $this->userService->updateUserWithDifferentLogic($request, $id);

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'E agora José!',
                'user' => null
            ];
        }

        return [
            'status' => 200,
            'message' => 'Usuário atualizado com a update da Jeniffer :D!',
            'user' => $user
        ];
    }
}
