<?php

namespace App\Http\Controllers;

use App\Models\Financeiro;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function __construct(
        Financeiro $financeiro
    )
    {
        $this->financeiro = $financeiro;
    }

    public function postFinanceiroDiario(Request $request)
    {
        $financeiro = $this->financeiro->where('data', 'like', date('Y-m-d', strtotime($request->data)) .'%')->orderby('data', 'DESC')->get();
        $t = 0;

        foreach($financeiro as $f)
        {
            $f->data = date("d/m H:i", strtotime($f->data));
            switch($f->tipo)
            {
                case('CE'):
                    $f->tipo = 'Correção de estoque';
                    break;
                case('EE'):
                    $f->tipo = 'Entrada de estoque';
                    break;
                case('PP'):
                    $f->tipo = 'Pagamento de paciente';
                    break;
                // case(''):

                //     break;
            }
            $t += $f->valor;
            $f->valor_num = $f->valor;
            $f->valor = number_format($f->valor, 2, ',', ' ');
        }

        $total['total_num'] = $t;
        $total['total'] = number_format($total['total_num'], 2, ',', ' ');

        return json_encode(['financeiro' => $financeiro, 'total' => $total]);
    }

    public function postFinanceiroSemanal(Request $request)
    {
        $financeiro = [];
        for($i = date('w', strtotime($request->data)) ; $i >= 0 ; $i--)
        {
            $semana[] = date('Y-m-d', strtotime($request->data)-($i*86400));
        }
        for($i = date('w', strtotime($request->data))+1 ; $i < 7 ; $i++)
        {
            $semana[] = date('Y-m-d', strtotime($request->data)+(($i-date('w', strtotime($request->data)))*86400));
        }
        
        foreach($semana as $s)
        {
            $financa[] = $this->financeiro->where('data', 'like', date('Y-m-d', strtotime($s)) .'%')->orderby('data', 'DESC')->get();
        }

        foreach($financa as $fin)
        {
            foreach($fin as $f)
            {
                $financeiro[] = $f;
            }
        }

        $t = 0;
        foreach($financeiro as $f)
        {
            $f->data = date("d/m H:i", strtotime($f->data));
            switch($f->tipo)
            {
                case('CE'):
                    $f->tipo = 'Correção de estoque';
                    break;
                case('EE'):
                    $f->tipo = 'Entrada de estoque';
                    break;
                case('PP'):
                    $f->tipo = 'Pagamento de paciente';
                    break;
                // case(''):

                //     break;
            }
            $t += $f->valor;
            $f->valor_num = $f->valor;
            $f->valor = number_format($f->valor, 2, ',', ' ');
        }

        $total['total_num'] = $t;
        $total['total'] = number_format($total['total_num'], 2, ',', ' ');

        return json_encode(['financeiro' => $financeiro, 'total' => $total]);
    }

    public function postFinanceiroMensal(Request $request)
    {
        $financeiro = $this->financeiro->where('data', 'like', date('Y-m', strtotime($request->ano . '-' . $request->mes)) .'%')->orderby('data', 'DESC')->get();
        $t = 0;

        foreach($financeiro as $f)
        {
            $f->data = date("d/m H:i", strtotime($f->data));
            switch($f->tipo)
            {
                case('CE'):
                    $f->tipo = 'Correção de estoque';
                    break;
                case('EE'):
                    $f->tipo = 'Entrada de estoque';
                    break;
                case('PP'):
                    $f->tipo = 'Pagamento de paciente';
                    break;
                // case(''):

                //     break;
            }
            $t += $f->valor;
            $f->valor_num = $f->valor;
            $f->valor = number_format($f->valor, 2, ',', ' ');
        }

        $total['total_num'] = $t;
        $total['total'] = number_format($total['total_num'], 2, ',', ' ');

        return json_encode(['financeiro' => $financeiro, 'total' => $total]);
    }

    public function postFinanceiroAnual(Request $request)
    {
        $financeiro = $this->financeiro->where('data', 'like', date('Y', strtotime($request->ano)) .'-%')->orderby('data', 'DESC')->get();
        $t = 0;

        foreach($financeiro as $f)
        {
            $f->data = date("d/m H:i", strtotime($f->data));
            switch($f->tipo)
            {
                case('CE'):
                    $f->tipo = 'Correção de estoque';
                    break;
                case('EE'):
                    $f->tipo = 'Entrada de estoque';
                    break;
                case('PP'):
                    $f->tipo = 'Pagamento de paciente';
                    break;
                // case(''):

                //     break;
            }
            $t += $f->valor;
            $f->valor_num = $f->valor;
            $f->valor = number_format($f->valor, 2, ',', ' ');
        }

        $total['total_num'] = $t;
        $total['total'] = number_format($total['total_num'], 2, ',', ' ');

        return json_encode(['financeiro' => $financeiro, 'total' => $total]);
    }
}
