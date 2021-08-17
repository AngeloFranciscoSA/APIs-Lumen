<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use App\Models\User;
use Illuminate\Http\Request;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        try{
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }

            $tokenHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $tokenHeader);

            $dadosAuth = JWT::decode($token, env('JWT_KEY'), ['HS256']);
            $user = User::where('email', $dadosAuth->email)->first();

            if (is_null($user)) {
                throw new \Exception();
            }
            return $next($request);
        } catch (\Exception $e){
            return response()->json('Não autorizado!', 401);
        }
    }
}
