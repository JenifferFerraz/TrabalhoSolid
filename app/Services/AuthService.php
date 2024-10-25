<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class AuthService
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function login(array $data)
    {
        if (Auth::attempt(['email' => strtolower($data['email']), 'password' => $data['password']])) {
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;

            return [
                'status' => 200,
                'message' => "Usuário logado com sucesso",
                'usuario' => $user 
            ];
        }

        return [
            'status' => 404,
            'message' => "Usuário ou senha incorreto"
        ];
    }

    public function logout($user)
    {
        $tokenId = $user->token()->id;
        $this->tokenRepository->revokeAccessToken($tokenId);
        
        return [
            'status' => 200,
            'message' => "Usuário deslogado com sucesso!"
        ];
    }
}
