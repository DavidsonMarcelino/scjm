@extends('components.body')

@section('content')
    <?php $caminho = '/sistema_joyce/storage/icons/'; ?>
    <div class="row justify-content-center vh88">
        @foreach($usuarios as $u)
            <div class="col-3">
                <button class="btn btn-perfil home-btn-purple vh32 w100" title="{{$u->nome}}" onclick="window.location.href = '{{route('getAgenda', $u->usuario_id)}}'">
                    <img src="{{$caminho}}/{{$u->foto}}" height="150vh" alt="{{$u->nome}}"><br><br>
                    <b style="height: 20vh">{{$u->nome}}</b>
                </button>
            </div>
        @endforeach
        <div class="col-3">
            <button class="btn btn-perfil home-btn-purple vh32 w100" title="Agenda geral" onclick="window.location.href = '{{route('getAllAgenda')}}'">
                <img src="{{$caminho}}/padrao.png" height="150vh" alt="Agenda geral"><br><br>
                <b style="height: 20vh">Agenda geral</b>
            </button>
        </div>
    </div>
@endsection