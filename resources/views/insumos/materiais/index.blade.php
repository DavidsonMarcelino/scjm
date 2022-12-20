@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-11"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getInsumos')}}">Insumos</a> / Materiais</span></div>
            <div class="col-1">
                <a href="{{route('getCriaMateriais')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Criar</button></a>
            </div>
        </div>
        <table class="table table-bordered">
            <th width="5%" title="ID">ID</th>
            <th width="27%" title="Nome">Nome</th>
            <th width="27%" title="Marca">Marca</th>
            <th width="12%" title="Quantidade mínima">Qtd. mínima</th>
            <th width="12%" title="Quantidade atual">Qtd. atual</th>
            <th width="10%" title="Ativo">Ativo</th> 
            <th width="7%" title="Opções">Opções</th>
            @foreach($material as $m)
                <tr @if($m->quantidade < $m->quantidade_reposicao) class="bg-reposicao" title="Reposição necessária" @endif>
                    <td class="align-middle">{{$m->material_id}}</td>
                    <td class="align-middle">{{$m->nome}}</td>
                    <td class="align-middle">{{$m->marca}}</td>
                    <td class="align-middle">{{$m->quantidade_reposicao}}</td>
                    <td class="align-middle">{{$m->quantidade}}</td>
                    <td class="align-middle"></td>
                    <td class="align-middle d-flex justify-content-around">
                        <a href="{{route('getEditaMateriais', $m->material_id)}}"><img src="\sistema_joyce\storage\icons\editar.svg" width="15vh"></a>
                    </td>
                </tr>
            @endforeach
        </table>
        <?php $rota = "getMateriais"; $page = $material;?>
        @include('components.pages')
    </div>
@endsection