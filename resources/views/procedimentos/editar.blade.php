@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getProcedimentos')}}">Procedimentos</a> / Editar</span></div>
        </div>

        <form method="POST" action="{{route('postEditaProcedimentos', $procedimento->procedimento_id)}}" class="card card-body text-start ">
            @csrf
            <div class="row">
                
                <div class="col-3">
                    <label for="#procedimento">Nome:</label>
                    <input type="text" class="form-control" id="procedimento" name="procedimento" placeholder="Digite o nome do procedimento" value="{{$procedimento->nome}}" required>
                </div>
                <div class="offset-1 col-2">
                    <label for="#valor">valor:</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control" id="valor" name="valor" placeholder="0,00" min="0" step="0.01" value="{{$procedimento->preco}}" required>
                    </div>
                </div>
                <div class="offset-1 col-2">
                    <label for="#tempo">Duração:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="tempo" name="tempo" placeholder="0" min="0" step="1" value="{{$procedimento->tempo}}" required>
                        <span class="input-group-text">Minutos</span>
                    </div>
                </div>
                <div class="offset-1 col-2">
                    <label for="#recorrencia">Aviso de retorno:</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="recorrencia" name="recorrencia" placeholder="0" min="0" step="1" value="{{$procedimento->recorrencia}}" required>
                        <span class="input-group-text">Meses</span>
                    </div>
                </div>
            </div>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection