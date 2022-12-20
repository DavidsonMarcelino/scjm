@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getProfissionais')}}">Profissionais</a> / Criar</span></div>
        </div>

        <form method="POST" action="{{route('postCriaProfissionais')}}" class="card card-body text-start">
            @csrf
            <label for="#profissional">Nome:</label>
            <input type="text" class="form-control" id="profissional" name="profissional" placeholder="Digite o nome do profissional" required>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection