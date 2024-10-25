<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $data = $request->all();

        $response = $this->authService->login($data);

        return response()->json($response, $response['status']);
    }

    public function logout(Request $request)
    {
        $response = $this->authService->logout($request->user());
        return response()->json($response, $response['status']);
    }
}
