@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getInsumos')}}">Insumos</a> / <a href="{{route('getMateriais')}}">Materiais</a> / Editar</span></div>
        </div>

        <form method="POST" action="{{route('postEditaMateriais', $material->material_id)}}" class="card card-body text-start">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="#material">Nome:</label>
                    <input type="text" class="form-control" id="material" name="material" placeholder="Digite o material" value="{{$material->nome}}" required>
                </div>
                <div class="offset-1 col-5">
                    <label for="#marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Digite a marca" value="{{$material->marca}}" required>
                </div>
                <div class="col-12"><br></div>
                <div class="col-5">
                    <label for="#tipo">Tipo de material:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Digite o tipo de material" value="{{$material->tipo}}" required>
                </div>
                <div class="offset-1 col-2">
                    <label for="#quantidade_minima">Qtd. de reposição:</label>
                    <input type="number" class="form-control" id="quantidade_minima" name="quantidade_minima" placeholder="Qtd reposição" value="{{$material->quantidade_reposicao}}" required>
                </div>
                
            </div>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection