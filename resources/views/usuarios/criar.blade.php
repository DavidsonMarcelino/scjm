@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getUsuarios')}}">Usuários</a> / Criar</span></div>
        </div>

        <form method="POST" action="{{route('postCriaUsuarios')}}" class="card card-body text-start">
            @csrf
            <div class="row">

                <div class="col-6">
                    <label for="#usuario">Nome:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite o nome do usuário" required>
                </div>
                <div class="offset-1 col-5">
                    <label for="#profissional">Nome:</label>
                    <select class="form-control" id="profissional" name="profissional" required>
                        <option value="" selected disabled>Selecione o tipo de profissional</option>
                        @foreach($profissionais as $p)
                            <option value="{{$p->profissional_id}}">{{$p->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 vh5"></div>
                <div class="col-4">
                    <label for="#login">Login:</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Digite o login" required>
                </div>
                <div class="offset-1 col-3">
                    <label for="#senha">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha" required>
                </div>
                <div class="offset-1 col-3">
                    <label for="#permissao">Nível de acesso:</label>
                    <select class="form-control" id="permissao" name="permissao" required>
                        <option value="" selected disabled>Selecione o nível de acesso</option>
                        <option value="1">Mínimo</option>
                        <option value="2">Básico</option>
                        <option value="3">Acesso a relatórios</option>
                        <option value="4">Acesso ao financeiro</option>
                        <option value="5">Acesso total</option>
                        <option value="6">Administrador</option>
                    </select>
                </div>
            </div>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection