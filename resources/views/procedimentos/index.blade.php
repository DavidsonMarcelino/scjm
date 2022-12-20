@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-11"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / Procedimentos</span></div>
            <div class="col-1">
                <a href="{{route('getCriaProcedimentos')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Criar</button></a>
            </div>
        </div>
        <table class="table table-bordered">
            <th width="5%">ID</th>
            <th width="50%">Nome</th>
            <th width="15%">Preço</th>
            <th width="15%">Duração</th>
            <th width="5%">Ativo</th>
            <th width="10%">Opções</th>
            @foreach($procedimento as $p)
                <tr>
                    <td class="align-middle">{{$p->procedimento_id}}</td>
                    <td class="align-middle">{{$p->nome}}</td>
                    <td class="align-middle">R${{$p->preco}}</td>
                    <td class="align-middle">{{$p->tempo}} Minutos</td>
                    <td class="align-middle"></td>
                    <td class="align-middle d-flex justify-content-around">
                        <a href="{{route('getEditaProcedimentos', $p->procedimento_id)}}"><img src="\sistema_joyce\storage\icons\editar.svg" width="15vh"></a>
                        <form action="{{route('postDeletaProcedimentos', $p->procedimento_id)}}" method="POST">
                            @csrf
                            <button class="no-border bg-none"><img src="\sistema_joyce\storage\icons\excluir.svg" width="15vh"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <?php $rota = "getProcedimentos"; $page = $procedimento;?>
        @include('components.pages')
    </div>
@endsection