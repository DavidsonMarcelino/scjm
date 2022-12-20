@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getInsumos')}}">Insumos</a> / Adicionar ao estoque</span></div>
        </div>

        <form method="POST" action="{{route('postEditaEstoque', $estoque->estoque_id)}}" class="card card-body text-start">
            @csrf
            <div class="row">
                <div class="col-5">
                    <label for="#material">Material:</label>
                    <select class="form-control" name="material" id="material" required>
                        @foreach($material as $m)
                            <option value="{{$m->material_id}}" @if($m->material_id === $estoque->material_id) selected @endif>{{$m->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="offset-1 col-2">
                    <label for="#quantidade">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Reposição" value="{{$estoque->quantidade}}" required>
                </div>
                <div class="offset-1 col-2">
                    <label for="#custo">Custo:</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" class="form-control" id="custo" name="custo" placeholder="0,00" step="0.01" value="{{$estoque->custo}}" required>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-3">
                <label for="#validade">Validade</label>
                    <input type="date" class="form-control" id="validade" name="validade" placeholder="Reposição" value="{{$estoque->validade}}" required>
                </div>
                <div class="offset-1 col-2">
                    <label for="#lote">Lote</label>
                    <input type="text" class="form-control" id="lote" name="lote" placeholder="Lote" value="{{$estoque->lote}}" required>
                </div>
            </div>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection