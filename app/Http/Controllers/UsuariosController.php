<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function __construct(
        Profissional $profissional,
        Usuario      $usuario
    )
    {
        $this->profissional = $profissional;
        $this->usuario      = $usuario;
    }

    public function getUsuarios()
    {
        $usuarios = $this->usuario->join('profissional', 'profissional.profissional_id', 'usuario.profissional_id')->where('usuario.deleted', 0)->select('usuario.*', 'profissional.nome as profissional')->paginate(15);
        
        return view('usuarios.index', compact('usuarios'));
    }
    
    public function getCriaUsuarios()
    {
        $profissionais = $this->profissional->where('deleted', 0)->get();

        return view('usuarios.criar', compact('profissionais'));
    }

    public function criaUsuarios(Request $request)
    {
        $this->usuario->create([
            'nome'            => $request->usuario,
            'profissional_id' => $request->profissional,
            'permissao'       => $request->permissao,
            'login'           => $request->login,
            'senha'           => md5($request->senha),
            'data_criado'     => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'ativo'           => 1,
            'deleted'         => 0
        ]);

        return redirect()->route('getUsuarios');
    }

    public function getEditaUsuarios($usuario)
    {
        $profissionais = $this->profissional->where('deleted', 0)->get();
        $usuario = $this->usuario->where('usuario_id', $usuario)->get();

        if(count($usuario))
        {
            $usuario = $usuario[0];
            return view('usuarios.editar', compact('profissionais', 'usuario'));
        }else{
            return redirect()->route('error');
        }
    }

    public function postEditaUsuarios($usuario, Request $request)
    {
        $this->usuario->where('usuario_id', $usuario)->update([
            'nome'            => $request->usuario,
            'profissional_id' => $request->profissional,
            'permissao'       => $request->permissao,
            'login'           => $request->login,
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours'))
        ]);

        return redirect()->route('getUsuarios');
    }

    public function postDeletaUsuarios($usuario)
    {
        $this->usuario->where('usuario_id', $usuario)->update([
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'deleted' => 1
        ]);

        return redirect()->route('getUsuarios');
    }
}
