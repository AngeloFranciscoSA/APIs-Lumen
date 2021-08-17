<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function gerartoken (Request $req){

        $this->validate($req, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $req->email)->first();

        if(is_null($user) or !Hash::check($req->password, $user->password)){
            return response()->json('Usuário e Senha Inválidos', 401);
        }

        $token = JWT::encode(['email' => $req->email], env('JWT_KEY'));

        return [
            'access_token' => $token
        ];
    }
}
