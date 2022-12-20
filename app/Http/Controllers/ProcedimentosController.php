<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use Illuminate\Http\Request;

class ProcedimentosController extends Controller
{
    public function __construct(
        Procedimento $procedimento
    )
    {
        $this->procedimento = $procedimento;
    }

    public function getProcedimentos()
    {
        $procedimento = $this->procedimento->where('deleted', 0)->paginate(15);

        return view('procedimentos.index', compact('procedimento'));
    }

    public function criaProcedimentos(Request $request)
    {
        $this->procedimento->create([
            'nome'        => $request->procedimento,
            'preco'       => $request->valor,
            'tempo'       => $request->tempo,
            'recorrencia'     => $request->recorrencia,
            'data_criado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'ativo'       => 1,
            'deleted'     => 0
        ]);

        return redirect()->route('getProcedimentos');
    }

    public function getEditaProcedimentos($procedimento)
    {
        $procedimento = $this->procedimento->where('procedimento_id', $procedimento)->get();

        if(count($procedimento))
        {
            $procedimento = $procedimento[0];
            return view('procedimentos.editar', compact('procedimento'));
        }else{
            return redirect()->route('error');
        }
    }

    public function postEditaProcedimentos($procedimento, Request $request)
    {
        $this->procedimento->where('procedimento_id', $procedimento)->update([
            'nome'            => $request->procedimento,
            'preco'           => $request->valor,
            'tempo'           => $request->tempo,
            'recorrencia'     => $request->recorrencia,
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours'))
        ]);

        return redirect()->route('getProcedimentos');
    }

    public function postDeletaProcedimentos($procedimento)
    {
        $this->procedimento->where('procedimento_id', $procedimento)->update([
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'deleted'         => 1
        ]);

        return redirect()->route('getProcedimentos');
    }
}