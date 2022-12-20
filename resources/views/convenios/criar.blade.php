@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getConvenios')}}">Convênios</a> / Criar</span></div>
        </div>

        <form method="POST" action="{{route('postCriaConvenios')}}" class="card card-body text-start">
            @csrf
            <label for="#convenio">Nome:</label>
            <input type="text" class="form-control" id="convenio" name="convenio" placeholder="Digite o nome do convênio" required>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection