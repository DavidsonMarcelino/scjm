<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Paciente;
use App\Models\Procedimento;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AgendasController extends Controller
{
    public function __construct(
        Agenda       $agenda,
        Paciente     $paciente,
        Procedimento $procedimento,
        Usuario      $usuario
    )
    {
        $this->agenda       = $agenda;
        $this->paciente     = $paciente;
        $this->procedimento = $procedimento;
        $this->usuario      = $usuario;
    }

    public function getAgendas()
    {
        $perfil = $this->usuario->where('usuario_id', $_SESSION['usuario'])->get()->first();

        if($perfil->permissao > 5)
        {
            $usuarios = $this->usuario->where('ativo', 1)->where('deleted', 0)->get();

            return view('agendas.index', compact('usuarios'));
        }else{
            return redirect()->route('getAgenda', $_SESSION['usuario']);
        }
    }

    public function getAgenda($agenda)
    {
        $usuario = $this->usuario->where('usuario_id', $agenda)->get()->first();
        $usuario->nome = explode(' ', $usuario->nome)[0];
        $agenda = $this->agenda->where('usuario_id', $agenda)->get();

        return view('agendas.agenda', compact('agenda', 'usuario'));
    }

    public function getAllAgenda()
    {
        $usuarios = $this->usuario->where('ativo', 1)->where('deleted', 0)->get();
        
        return view('agendas.agendaAll', compact('usuarios'));
    }

    public function getAgendamento(Request $request)
    {
        $hora = date("Y-m-d H:i", strtotime($request->data . ' ' . $request->hora));
        $pacientes     = $this->paciente->where('ativo', 1)->where('deleted', 0)->orderBy('nome', 'ASC')->get();
        $procedimentos = $this->procedimento->where('ativo', 1)->where('deleted', 0)->orderBy('nome', 'ASC')->get();
        $usuario = $request->usuario_id;

        return view('agendas.criar', compact('hora', 'pacientes', 'procedimentos', 'usuario'));
    }

    public function postAgendamento(Request $request)
    {
        $this->agenda->create([
            'usuario_id'      => $request->usuario_id,
            'paciente_id'     => $request->paciente,
            'procedimento_id' => $request->procedimento,
            'status'          => 'A',
            'data_inicio'     => $request->hora,
            'data_criado'     => date("Y-m-d H:i:s", strtotime('-3Hours')),
            'ativo'           => 1,
            'deleted'         => 0
        ]);

        return redirect()->route('getAgenda', $request->usuario_id);
    }

    public function getCalendario(Request $request)
    {
        $datas = $this->agenda->join('procedimento', 'procedimento.procedimento_id', 'agenda.procedimento_id')
        ->join('paciente', 'paciente.paciente_id', 'agenda.paciente_id')
        ->join('usuario', 'usuario.usuario_id', 'agenda.usuario_id')
        ->where('data_inicio', 'like', '%' . $request->data . '%')
        ->where('agenda.usuario_id', $request->usuario)
        ->whereIn('status', ['A', 'P'])
        ->select('agenda.data_inicio', 'procedimento.tempo', 'usuario.nome as usuario', 'paciente.nome as paciente')->get();

        $todosHorarios = [
            '08:00' => "Livre", '08:05' => "Livre", '08:10' => "Livre", '08:15' => "Livre", '08:20' => "Livre", '08:25' => "Livre", '08:30' => "Livre", '08:35' => "Livre", '08:40' => "Livre", '08:45' => "Livre", '08:50' => "Livre", '08:55' => "Livre",
            '09:00' => "Livre", '09:05' => "Livre", '09:10' => "Livre", '09:15' => "Livre", '09:20' => "Livre", '09:25' => "Livre", '09:30' => "Livre", '09:35' => "Livre", '09:40' => "Livre", '09:45' => "Livre", '09:50' => "Livre", '09:55' => "Livre",
            '10:00' => "Livre", '10:05' => "Livre", '10:10' => "Livre", '10:15' => "Livre", '10:20' => "Livre", '10:25' => "Livre", '10:30' => "Livre", '10:35' => "Livre", '10:40' => "Livre", '10:45' => "Livre", '10:50' => "Livre", '10:55' => "Livre",
            '11:00' => "Livre", '11:05' => "Livre", '11:10' => "Livre", '11:15' => "Livre", '11:20' => "Livre", '11:25' => "Livre", '11:30' => "Livre", '11:35' => "Livre", '11:40' => "Livre", '11:45' => "Livre", '11:50' => "Livre", '11:55' => "Livre",
            '12:00' => "Livre", '12:05' => "Livre", '12:10' => "Livre", '12:15' => "Livre", '12:20' => "Livre", '12:25' => "Livre", '12:30' => "Livre", '12:35' => "Livre", '12:40' => "Livre", '12:45' => "Livre", '12:50' => "Livre", '12:55' => "Livre",
            '13:00' => "Livre", '13:05' => "Livre", '13:10' => "Livre", '13:15' => "Livre", '13:20' => "Livre", '13:25' => "Livre", '13:30' => "Livre", '13:35' => "Livre", '13:40' => "Livre", '13:45' => "Livre", '13:50' => "Livre", '13:55' => "Livre",
            '14:00' => "Livre", '14:05' => "Livre", '14:10' => "Livre", '14:15' => "Livre", '14:20' => "Livre", '14:25' => "Livre", '14:30' => "Livre", '14:35' => "Livre", '14:40' => "Livre", '14:45' => "Livre", '14:50' => "Livre", '14:55' => "Livre",
            '15:00' => "Livre", '15:05' => "Livre", '15:10' => "Livre", '15:15' => "Livre", '15:20' => "Livre", '15:25' => "Livre", '15:30' => "Livre", '15:35' => "Livre", '15:40' => "Livre", '15:45' => "Livre", '15:50' => "Livre", '15:55' => "Livre",
            '16:00' => "Livre", '16:05' => "Livre", '16:10' => "Livre", '16:15' => "Livre", '16:20' => "Livre", '16:25' => "Livre", '16:30' => "Livre", '16:35' => "Livre", '16:40' => "Livre", '16:45' => "Livre", '16:50' => "Livre", '16:55' => "Livre",
            '17:00' => "Livre", '17:05' => "Livre", '17:10' => "Livre", '17:15' => "Livre", '17:20' => "Livre", '17:25' => "Livre", '17:30' => "Livre", '17:35' => "Livre", '17:40' => "Livre", '17:45' => "Livre", '17:50' => "Livre", '17:55' => "Livre"
        ];

        foreach($datas as $d)
        {
            $todosHorarios[date('H:i', strtotime($d->data_inicio))] = explode(' ', $d->paciente)[0];
            
            for($i = $d->tempo-5 ; $i > 0 ; $i-=5)
            {
                $todosHorarios[date('H:i', strtotime($d->data_inicio)+($i*60))] = explode(' ', $d->paciente)[0];
            }
        }

        return json_encode($todosHorarios);
    }

    public function getCalendarioAll(Request $request)
    {
        
        $usuarios = $this->usuario->where('ativo', 1)->where('deleted', 0)->get();

        foreach($usuarios as $u)
        {
            $datas[$u->usuario_id]= $this->agenda->join('procedimento', 'procedimento.procedimento_id', 'agenda.procedimento_id')
            ->join('paciente', 'paciente.paciente_id', 'agenda.paciente_id')
            ->join('usuario', 'usuario.usuario_id', 'agenda.usuario_id')
            ->where('data_inicio', 'like', '%' . $request->data . '%')
            ->where('agenda.usuario_id', $u->usuario_id)
            ->whereIn('status', ['A', 'P'])
            ->select('agenda.data_inicio', 'procedimento.tempo', 'usuario.nome as usuario', 'paciente.nome as paciente')->get();

            $todosHorarios[$u->usuario_id] = [
                '08:00' => "Livre", '08:05' => "Livre", '08:10' => "Livre", '08:15' => "Livre", '08:20' => "Livre", '08:25' => "Livre", '08:30' => "Livre", '08:35' => "Livre", '08:40' => "Livre", '08:45' => "Livre", '08:50' => "Livre", '08:55' => "Livre",
                '09:00' => "Livre", '09:05' => "Livre", '09:10' => "Livre", '09:15' => "Livre", '09:20' => "Livre", '09:25' => "Livre", '09:30' => "Livre", '09:35' => "Livre", '09:40' => "Livre", '09:45' => "Livre", '09:50' => "Livre", '09:55' => "Livre",
                '10:00' => "Livre", '10:05' => "Livre", '10:10' => "Livre", '10:15' => "Livre", '10:20' => "Livre", '10:25' => "Livre", '10:30' => "Livre", '10:35' => "Livre", '10:40' => "Livre", '10:45' => "Livre", '10:50' => "Livre", '10:55' => "Livre",
                '11:00' => "Livre", '11:05' => "Livre", '11:10' => "Livre", '11:15' => "Livre", '11:20' => "Livre", '11:25' => "Livre", '11:30' => "Livre", '11:35' => "Livre", '11:40' => "Livre", '11:45' => "Livre", '11:50' => "Livre", '11:55' => "Livre",
                '12:00' => "Livre", '12:05' => "Livre", '12:10' => "Livre", '12:15' => "Livre", '12:20' => "Livre", '12:25' => "Livre", '12:30' => "Livre", '12:35' => "Livre", '12:40' => "Livre", '12:45' => "Livre", '12:50' => "Livre", '12:55' => "Livre",
                '13:00' => "Livre", '13:05' => "Livre", '13:10' => "Livre", '13:15' => "Livre", '13:20' => "Livre", '13:25' => "Livre", '13:30' => "Livre", '13:35' => "Livre", '13:40' => "Livre", '13:45' => "Livre", '13:50' => "Livre", '13:55' => "Livre",
                '14:00' => "Livre", '14:05' => "Livre", '14:10' => "Livre", '14:15' => "Livre", '14:20' => "Livre", '14:25' => "Livre", '14:30' => "Livre", '14:35' => "Livre", '14:40' => "Livre", '14:45' => "Livre", '14:50' => "Livre", '14:55' => "Livre",
                '15:00' => "Livre", '15:05' => "Livre", '15:10' => "Livre", '15:15' => "Livre", '15:20' => "Livre", '15:25' => "Livre", '15:30' => "Livre", '15:35' => "Livre", '15:40' => "Livre", '15:45' => "Livre", '15:50' => "Livre", '15:55' => "Livre",
                '16:00' => "Livre", '16:05' => "Livre", '16:10' => "Livre", '16:15' => "Livre", '16:20' => "Livre", '16:25' => "Livre", '16:30' => "Livre", '16:35' => "Livre", '16:40' => "Livre", '16:45' => "Livre", '16:50' => "Livre", '16:55' => "Livre",
                '17:00' => "Livre", '17:05' => "Livre", '17:10' => "Livre", '17:15' => "Livre", '17:20' => "Livre", '17:25' => "Livre", '17:30' => "Livre", '17:35' => "Livre", '17:40' => "Livre", '17:45' => "Livre", '17:50' => "Livre", '17:55' => "Livre"
            ];

            foreach($datas[$u->usuario_id] as $d)
            {
                $todosHorarios[$u->usuario_id][date('H:i', strtotime($d->data_inicio))] = explode(' ', $d->paciente)[0];
                
                for($i = $d->tempo-5 ; $i > 0 ; $i-=5)
                {
                    $todosHorarios[$u->usuario_id][date('H:i', strtotime($d->data_inicio)+($i*60))] = explode(' ', $d->paciente)[0];
                }
            }
            $todosHorarios['ids'][] = $u->usuario_id;
        }

        return json_encode($todosHorarios);
    }
}
