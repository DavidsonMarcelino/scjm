@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getUsuarios')}}">Usuários</a> / Editar</span></div>
        </div>

        <form method="POST" action="{{route('postEditaUsuarios', $usuario->usuario_id)}}" class="card card-body text-start">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="#usuario">Nome:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite o nome do usuário" value="{{$usuario->nome}}" required>
                </div>
                <div class="offset-1 col-5">
                    <label for="#profissional">Nome:</label>
                    <select class="form-control" id="profissional" name="profissional" required>
                        @foreach($profissionais as $p)
                            <option value="{{$p->profissional_id}}" @if($p->profissional_id == $usuario->profissional_id) selected @endif >{{$p->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 vh5"></div>
                <div class="col-5">
                    <label for="#login">Login:</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Digite o login" value="{{$usuario->login}}" required>
                </div>
                <div class="offset-1 col-3">
                    <label for="#permissao">Nível de acesso:</label>
                    <select class="form-control" id="permissao" name="permissao" required>
                        <option value="1" @if($usuario->permissao == 1) selected @endif >Mínimo</option>
                        <option value="2" @if($usuario->permissao == 2) selected @endif >Básico</option>
                        <option value="3" @if($usuario->permissao == 3) selected @endif >Acesso a relatórios</option>
                        <option value="4" @if($usuario->permissao == 4) selected @endif >Acesso ao financeiro</option>
                        <option value="5" @if($usuario->permissao == 5) selected @endif >Acesso total</option>
                        <option value="6" @if($usuario->permissao == 6) selected @endif >Administrador</option>
                    </select>
                </div>
            </div>
            <hr>
            @include('components.salvar')
        </form>
    </div>
@endsection