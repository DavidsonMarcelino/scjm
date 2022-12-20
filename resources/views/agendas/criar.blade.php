@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getAgenda', $usuario)}}">Agenda</a> / Agendar para {{date("d/m/Y \a\s H:i", strtotime($hora))}}</span></div>
        </div>

        <form method="POST" action="{{route('postAgendamento')}}" class="card card-body text-start">
            @csrf
            <input type="hidden" name="usuario_id" value="{{$usuario}}">
            <input type="hidden" name="hora" value="{{$hora}}">
            <div class="row">
                <div class="col-6">
                    <label for="#paciente">Paciente:</label>
                    <select class="form-control" name="paciente" id="paciente" required>
                        <option value="" disabled selected>Selecione o paciente</option>
                        @foreach($pacientes as $p)
                            <option value="{{$p->paciente_id}}">{{$p->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="offset-1 col-5">
                    <label for="#procedimento">Procedimento:</label>
                    <select class="form-control" name="procedimento" id="procedimento" required>
                        <option value="" disabled selected>Selecione o procedimento</option>
                        @foreach($procedimentos as $p)
                            <option value="{{$p->procedimento_id}}">{{$p->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection