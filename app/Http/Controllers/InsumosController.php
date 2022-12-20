<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Material;
use App\Models\Financeiro;
use Illuminate\Http\Request;

class InsumosController extends Controller
{
    public function __construct(
        Estoque  $estoque,
        Financeiro $financeiro,
        Material $material
    )
    {
        $this->estoque    = $estoque;
        $this->financeiro = $financeiro;
        $this->material   = $material;
    }
    
    public function getInsumos()
    {
        $estoque = $this->estoque->join('material', 'material.material_id', 'estoque.material_id')
        ->where('material.ativo', 1)->where('material.deleted', 0)->where('estoque.quantidade', '>', 0)
        ->where('validade', '>', date('Y-m-d', strtotime('-3Hours')))
        ->select('estoque.*', 'material.nome as material')->paginate(15);

        return view('insumos.index', compact('estoque'));
    }

    // Estoque
    public function getCriaEstoque()
    {
        $material = $this->material->where('ativo', 1)->where('deleted', 0)->select('material_id', 'nome')->get();

        return view('insumos.criar', compact('material'));
    }

    public function postCriaEstoque(Request $request)
    {
        $this->estoque->create([
            'material_id' => $request->material,
            'quantidade'  => $request->quantidade,
            'tipo'        => $request->tipo,
            'custo'       => $request->custo,
            'validade'    => $request->validade,
            'lote'        => $request->lote,
        ]);

        $this->financeiro->create([
            'tipo'  => 'EE',
            'valor' => -($request->custo * $request->quantidade),
            'data'  => date('Y-m-d H:i:s', strtotime('-3Hours'))
        ]);

        return redirect()->route('getCriaEstoque');
    }

    public function getEditaEstoque($estoque)
    {
        $material = $this->material->where('ativo', 1)->where('deleted', 0)->select('material_id', 'nome')->get();
        $estoque = $this->estoque->where('estoque_id', $estoque)->get();

        if(count($estoque))
        {
            $estoque = $estoque[0];
            return view('insumos.editar', compact('material', 'estoque'));
        }else{
            return redirect()->route('error');
        }
    }

    public function postEditaEstoque($estoque, Request $request)
    {
        $estoque = $this->estoque->where('estoque_id', $estoque)->get()->first();

        if($estoque->quantidade != $request->quantidade && $estoque->custo != $request->custo)
        {
            $correcao['custo'] = round($estoque->custo - $request->custo, 2) * $estoque->quantidade;
            $correcao['quantidade'] = ($estoque->quantidade - $request->quantidade) * $estoque->custo;
            $correcao = $correcao['custo'] + $correcao['quantidade'];
        }elseif($estoque->quantidade != $request->quantidade && $estoque->custo == $request->custo){
            $correcao = ($estoque->quantidade - $request->quantidade) * $request->custo;
        }elseif($estoque->quantidade == $request->quantidade && $estoque->custo != $request->custo){
            $correcao = round($estoque->custo - $request->custo, 2) * $request->quantidade;
        }else{
            $this->estoque->where('estoque_id', $estoque->estoque_id)->update([
                'material_id' => $request->material,
                'quantidade'  => $request->quantidade,
                'tipo'        => $request->tipo,
                'custo'       => $request->custo,
                'validade'    => $request->validade,
                'lote'        => $request->lote,
            ]);

            return redirect()->route('getInsumos');
        }

        $this->financeiro->create([
            'tipo'  => 'CE',
            'valor' => $correcao,
            'data'  => date('Y-m-d H:i:s', strtotime('-3Hours'))
        ]);

        $this->estoque->where('estoque_id', $estoque->estoque_id)->update([
            'material_id' => $request->material,
            'quantidade'  => $request->quantidade,
            'tipo'        => $request->tipo,
            'custo'       => $request->custo,
            'validade'    => $request->validade,
            'lote'        => $request->lote,
        ]);

        return redirect()->route('getInsumos');
    }

    // Materiais
    public function getMateriais()
    {
        $material = $this->material->where('deleted', 0)->paginate(15);

        foreach($material as $m)
        {
            $estoque = $this->estoque->where('material_id', $m->material_id)->where('estoque.quantidade', '>', 0)
            ->where('validade', '>', date('Y-m-d', strtotime('-3Hours')))->get('quantidade');

            $total = 0;
            foreach($estoque as $e)
            {
                $total += $e->quantidade;
            }

            $m->quantidade = $total;
        }

        return view('insumos.materiais.index', compact('material'));
    }

    public function criaMateriais(Request $request)
    {
        $this->material->create([
            'nome'                 => $request->material,
            'marca'                => $request->marca,
            'quantidade_reposicao' => $request->quantidade_minima,
            'data_criado'          => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'ativo'                => 1,
            'deleted'              => 0
        ]);

        if($request->criar_estoque){
            return redirect()->route('criaEstoque');
        }else{
            return redirect()->route('getMateriais');
        }
    }

    public function getEditaMateriais($material)
    {
        $material = $this->material->where('material_id', $material)->get();

        if(count($material))
        {
            $material = $material[0];
            return view('insumos.materiais.editar', compact('material'));
        }else{
            return redirect()->route('error');
        }
    }

    public function postEditaMateriais($material, Request $request)
    {
        $this->material->where('material_id', $material)->update([
            'nome'                 => $request->material,
            'marca'                => $request->marca,
            'quantidade_reposicao' => $request->quantidade_minima,
            'data_modificado'      => date('Y-m-d H:i:s', strtotime('-3Hours'))
        ]);

        return redirect()->route('getMateriais');
    }
}
