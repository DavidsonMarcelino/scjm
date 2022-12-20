<?php

namespace App\Http\Controllers;

use App\Models\Anaminese;
use App\Models\Convenio;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function __construct(
        Anaminese $anaminese,
        Convenio  $convenio,
        Paciente  $paciente
    )
    {
        $this->anaminese = $anaminese;
        $this->convenio  = $convenio;
        $this->paciente  = $paciente;
    }

    public function getPacientes()
    {
        $pacientes = $this->paciente->join('convenio', 'convenio.convenio_id', 'paciente.convenio_id')->where('paciente.deleted', 0)->select('paciente.*', 'convenio.nome as convenio')->paginate(15);

        foreach($pacientes as $p)
        {
            if($p->sexo == 'M')
            {
                $p->sexo = 'Masculino';
            }else{
                $p->sexo = 'Feminino';
            }
        }

        return view('pacientes.index', compact('pacientes'));
    }

    public function getCriaPacientes()
    {
        $convenios = $this->convenio->where('ativo', 1)->where('deleted', 0)->get();

        return view('pacientes.criar', compact('convenios'));
    }

    public function postCriaPacientes(Request $request)
    {
        if($request->doenca == 'sim'){ $request->doenca = $request->doenca_texto; }
        if($request->medicacao == 'sim'){ $request->medicacao = $request->medicacao_texto; }
        if($request->tratamento == 'sim'){ $request->tratamento = $request->tratamento_texto; }
        if($request->operado == 'sim'){ $request->operado = $request->operado_texto; }
        if($request->alergia == 'sim'){ $request->alergia = $request->alergia_texto; }
        if($request->gestante == 'sim'){ $request->gestante = $request->gestan ;}

        if($request->cicatrizacao == 'sim'){    $request->cicatrizacao = 1;    }else{ $request->cicatrizacao = 0;    }
        if($request->anestesia == 'sim'){       $request->anestesia = 1;       }else{ $request->anestesia = 0;       }
        if($request->hemorragia == 'sim'){      $request->hemorragia = 1;      }else{ $request->hemorragia = 0;      }
        if($request->osso_artificial == 'sim'){ $request->osso_artificial = 1; }else{ $request->osso_artificial = 0; }
        if($request->marca_passo == 'sim'){     $request->marca_passo = 1;     }else{ $request->marca_passo = 0;     }
        if($request->hipertensao == 'sim'){     $request->hipertensao = 1;     }else{ $request->hipertensao = 0;     }
        if($request->diabetes == 'sim'){        $request->diabetes = 1;        }else{ $request->diabetes = 0;        }
        if($request->insulina == 'sim'){        $request->insulina = 1;        }else{ $request->insulina = 0;        }

        $anaminese = $this->anaminese->create([
            'doenca'          => $request->doenca,
            'medicacao'       => $request->medicacao,
            'tratamento'      => $request->tratamento,
            'operado'         => $request->operado,
            'cicatrizacao'    => $request->cicatrizacao,
            'anestesia'       => $request->anestesia,
            'hemorragia'      => $request->hemorragia,
            'osso_artificial' => $request->osso_artificial,
            'marca_passo'     => $request->marca_passo,
            'hipertensao'     => $request->hipertensao,
            'diabetes'        => $request->diabetes,
            'insulina'        => $request->insulina,
            'profissao'       => $request->profissao,
            'alergia'         => $request->alergia,
            'gestante'        => $request->gestante,
            'observacao'      => $request->observacao
        ]);

        $this->paciente->create([
            'anaminese_id'    => $anaminese->id,
            'convenio_id'     => $request->convenio,
            'nome'            => $request->paciente,
            'sexo'            => $request->sexo,
            'foto'            => null,
            'data_nascimento' => $request->data_nascimento,
            'data_criado'     => date('Y-m-d H:i:s', strtotime('-3Hours')),
            'ativo'           => 1,
            'deleted'         => 0
        ]);

        return redirect()->route('getPacientes');
    }

    public function getEditaPacientes($paciente)
    {
        $convenios = $this->convenio->where('ativo', 1)->where('deleted', 0)->get();
        $paciente = $this->paciente->join('anaminese', 'anaminese.anaminese_id', 'paciente.anaminese_id')->where('paciente_id', $paciente)->get();
        if(count($paciente))
        {
            $paciente = $paciente[0];
            return view('pacientes.editar', compact('convenios', 'paciente'));
        }else{
            return redirect()->route('error');
        }
    }

    public function postEditaPacientes($paciente, Request $request)
    {
        if($request->doenca == 'sim'){ $request->doenca = $request->doenca_texto; }
        if($request->medicacao == 'sim'){ $request->medicacao = $request->medicacao_texto; }
        if($request->tratamento == 'sim'){ $request->tratamento = $request->tratamento_texto; }
        if($request->operado == 'sim'){ $request->operado = $request->operado_texto; }
        if($request->alergia == 'sim'){ $request->alergia = $request->alergia_texto; }
        if($request->gestante == 'sim'){ $request->gestante = $request->gestan ;}

        if($request->cicatrizacao == 'sim'){    $request->cicatrizacao = 1;    }else{ $request->cicatrizacao = 0;    }
        if($request->anestesia == 'sim'){       $request->anestesia = 1;       }else{ $request->anestesia = 0;       }
        if($request->hemorragia == 'sim'){      $request->hemorragia = 1;      }else{ $request->hemorragia = 0;      }
        if($request->osso_artificial == 'sim'){ $request->osso_artificial = 1; }else{ $request->osso_artificial = 0; }
        if($request->marca_passo == 'sim'){     $request->marca_passo = 1;     }else{ $request->marca_passo = 0;     }
        if($request->hipertensao == 'sim'){     $request->hipertensao = 1;     }else{ $request->hipertensao = 0;     }
        if($request->diabetes == 'sim'){        $request->diabetes = 1;        }else{ $request->diabetes = 0;        }
        if($request->insulina == 'sim'){        $request->insulina = 1;        }else{ $request->insulina = 0;        }

        $this->anaminese->where('anaminese_id', $request->anaminese)->update([
            'doenca'          => $request->doenca,
            'medicacao'       => $request->medicacao,
            'tratamento'      => $request->tratamento,
            'operado'         => $request->operado,
            'cicatrizacao'    => $request->cicatrizacao,
            'anestesia'       => $request->anestesia,
            'hemorragia'      => $request->hemorragia,
            'osso_artificial' => $request->osso_artificial,
            'marca_passo'     => $request->marca_passo,
            'hipertensao'     => $request->hipertensao,
            'diabetes'        => $request->diabetes,
            'insulina'        => $request->insulina,
            'profissao'       => $request->profissao,
            'alergia'         => $request->alergia,
            'gestante'        => $request->gestante,
            'observacao'      => $request->observacao
        ]);

        $this->paciente->where('paciente_id', $paciente)->update([
            'convenio_id'     => $request->convenio,
            'nome'            => $request->paciente,
            'sexo'            => $request->sexo,
            'foto'            => null,
            'data_nascimento' => $request->data_nascimento,
            'data_modificado' => date('Y-m-d H:i:s', strtotime('-3Hours'))
        ]);

        return redirect()->route('getPacientes');
    }

    public function getPesquisaPacientes(Request $request)
    {
        $pacientes = $this->paciente->join('convenio', 'convenio.convenio_id', 'paciente.convenio_id')->where('paciente.nome', 'like', '%' . $request->paciente . '%')->where('paciente.deleted', 0)->select('paciente.*', 'convenio.nome as convenio')->paginate(15);

        foreach($pacientes as $p)
        {
            if($p->sexo == 'M')
            {
                $p->sexo = 'Masculino';
            }else{
                $p->sexo = 'Feminino';
            }
        }

        return view('pacientes.index', compact('pacientes'));
    }
}
