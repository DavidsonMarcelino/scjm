<?php

namespace App\Http\Controllers;

use App\Models\Profissional;
use Illuminate\Http\Request;

class ProfissionaisController extends Controller
{
    public function __construct(
        Profissional $profissional
    )
    {
        $this->profissional = $profissional;
    }

    public function getProfissionais()
    {
        $profissionais = $this->profissional->where('deleted', 0)->paginate(15);

        return view('profissionais.index', compact('profissionais'));
    }

    public function criaProfissionais(Request $request)
    {
        $this->profissional->create([
            'nome'        => $request->profissional,
            'data_criado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'ativo'       => 1,
            'deleted'     => 0
        ]);

        return redirect()->route('getProfissionais');
    }

    public function getEditaProfissionais($profissional)
    {
        $profissional = $this->profissional->where('profissional_id', $profissional)->get();

        if(count($profissional))
        {
            $profissional = $profissional[0];
            return view('profissionais.editar', compact('profissional'));
        }else{
            return redirect()->route('error');
        }
    }

    public function postEditaProfissionais($profissional, Request $request)
    {
        $this->profissional->where('profissional_id', $profissional)->update([
            'nome'            => $request->profissional,
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
        ]);
        
        return redirect()->route('getProfissionais');
    }

    public function postDeletaProfissionais($profissional)
    {
        $this->profissional->where('profissional_id', $profissional)->update([
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'deleted' => 1
        ]);

        return redirect()->route('getProfissionais');
    }
}
