<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        User::create($request->all());
        return ResponseService::success('Cadastro realizado com sucesso', Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request){
        $credentials = $request->all();
        if (!Auth::attempt($credentials)){
            throw ValidationException::withMessages([
                'Email e/ou Senha inválidos.',
                Response::HTTP_UNPROCESSABLE_ENTITY
            ]);
        }
        
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('ACCESS_TOKEN')->plainTextToken;
        $role = $user->returnRole();
        $name = $user->name;

        return ResponseService::loginSuccess('Logado com sucesso!', Response::HTTP_OK, $token, $role, $name);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return ResponseService::success('Deslogado com sucesso!');
    }
}
