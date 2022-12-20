<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(
        Usuario $usuario
    )
    {
        $this->usuario = $usuario;    
    }

    public function login(Request $request)
    {
        $dados = $request->all();

        if(isset($dados['login']) && isset($dados['senha']))
        {
            $user = $this->usuario->where('login', $dados['login'])->where('deleted', 0)->where('ativo', 1)->get()->first();

            if($user)
            {
                if($user->senha === md5($dados['senha']))
                {
                    $response['msg']     = 'Login realizado com sucesso, aguarde o redirecionamento...';
                    $response['success'] = true;
                    $_SESSION['usuario'] = $user->usuario_id;
                }else{
                    $response['msg']     = 'Senha incorreta';
                    $response['success'] = false;
                }
            }else{
                $response['msg']     = 'Usuário inexistente';
                $response['success'] = false;
            }
        }else{
            $response['msg']     = 'Por favor, preencha todos os campos';
            $response['success'] = false;
        }

        return $response;
    }

    public function logout()
    {
        session_destroy();

        return $_SESSION;
    }
}
