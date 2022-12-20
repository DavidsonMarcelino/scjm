<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;

class ArquivosController extends Controller
{
    public function __construct(
        Arquivo $arquivo
    )
    {
        $this->arquivo = $arquivo;
    }

    public function getArquivos()
    {
        $arquivos = $this->arquivo->where('arquivo_id', )->paginate(15);

        return view('arquivos.index', compact('arquivos'));
    }

    public function viewArquivo()
    {
        return \PDF::loadview('arquivos.view')->stream();
    }
}
