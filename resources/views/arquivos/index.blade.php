@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-11"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / Receitas e recibos</span></div>
            <div class="col-1">
                <a href="{{route('getCriaArquivos')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Criar</button></a>
            </div>
        </div>
        <table class="table table-bordered">
            <th width="5%">ID</th>
            <th width="80%">Nome</th>
            <th width="5%">Ativo</th>
            <th width="10%">Opções</th>
            @foreach($arquivos as $a)
                <tr>
                    <td class="align-middle">{{$a->arquivo_id}}</td>
                    <td class="align-middle">{{$a->nome}}</td>
                    <td class="align-middle"></td>
                    <td class="align-middle d-flex justify-content-around">
                        <a href="{{route('getEditaArquivos', $a->arquivo_id)}}"><img src="\sistema_joyce\storage\icons\editar.svg" width="15vh"></a>
                        <form action="{{route('postDeletaArquivos', $a->arquivo_id)}}" method="POST">
                            @csrf
                            <button class="no-border bg-none"><img src="\sistema_joyce\storage\icons\excluir.svg" width="15vh"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <?php $rota = "getArquivos"; $page = $arquivos;?>
        @include('components.pages')
    </div>
@endsection