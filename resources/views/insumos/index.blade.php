@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-8"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / Insumos</span></div>
            <div class="col-2">
                <a href="{{route('getMateriais')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge btn-middle-table-badge">Materiais</button></a>
            </div>
            <div class="col-2">
                <a href="{{route('getCriaEstoque')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Adicionar estoque</button></a>
            </div>
        </div>
        <table class="table table-bordered">
            <th width="5%">ID</th>
            <th width="38%">Nome</th>
            <th width="20%">Validade</th>
            <th width="20%">Lote</th>
            <th width="10%">Quantidade</th>
            <th width="7%">Opções</th>
            @foreach($estoque as $e)
                <tr>
                    <td class="align-middle">{{$e->estoque_id}}</td>
                    <td class="align-middle">{{$e->material}}</td>
                    <td class="align-middle">{{date("d/m/Y", strtotime($e->validade))}}</td>
                    <td class="align-middle">{{$e->lote}}</td>
                    <td class="align-middle">{{$e->quantidade}}</td>
                    <td class="align-middle d-flex justify-content-around">
                        <a href="{{route('getEditaEstoque', $e->estoque_id)}}"><img src="\sistema_joyce\storage\icons\editar.svg" width="15vh"></a>
                    </td>
                </tr>
            @endforeach
        </table>
        <?php $rota = "getInsumos"; $page = $estoque;?>
        @include('components.pages')
    </div>
@endsection