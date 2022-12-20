<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use Illuminate\Http\Request;

class ConveniosController extends Controller
{
    public function __construct(
        Convenio $convenio
    )
    {
        $this->convenio = $convenio;
    }

    public function getConvenios()
    {
        $convenios = $this->convenio->where('deleted', 0)->paginate(15);

        return view('convenios.index', compact('convenios'));
    }

    public function criaConvenios(Request $request)
    {
        $this->convenio->create([
            'nome'        => $request->convenio,
            'data_criado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'ativo'       => 1,
            'deleted'     => 0
        ]);
        
        return redirect()->route('getConvenios');
    }

    public function getEditaConvenios($convenio)
    {
        $convenio = $this->convenio->where('convenio_id', $convenio)->get();

        if(count($convenio))
        {
            $convenio = $convenio[0];
            return view('convenios.editar', compact('convenio'));
        }else{
            return redirect()->route('error');
        }
    }

    public function postEditaConvenios($convenio, Request $request)
    {
        $this->convenio->where('convenio_id', $convenio)->update([
            'nome'            => $request->convenio,
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours'))
        ]);

        return redirect()->route('getConvenios');
    }

    public function postDeletaConvenios($convenio)
    {
        $this->convenio->where('convenio_id', $convenio)->update([
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'deleted' => 1
        ]);

        return redirect()->route('getConvenios');
    }
}
