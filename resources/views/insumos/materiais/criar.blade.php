@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getInsumos')}}">Insumos</a> / <a href="{{route('getMateriais')}}">Materiais</a> / Criar</span></div>
        </div>

        <form method="POST" action="{{route('postCriaMateriais')}}" class="card card-body text-start">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="#material">Nome:</label>
                    <input type="text" class="form-control" id="material" name="material" placeholder="Digite o material" required>
                </div>
                <div class="offset-1 col-5">
                    <label for="#marca">Marca:</label>
                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Digite a marca" required>
                </div>
                <div class="col-12"><br></div>
                <div class="col-5">
                    <label for="#tipo">Tipo de material:</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Digite o tipo de material" required>
                </div>
                <div class="offset-1 col-2">
                    <label for="#quantidade_minima">Qtd. de reposição:</label>
                    <input type="number" class="form-control" id="quantidade_minima" name="quantidade_minima" placeholder="Qtd reposição" required>
                </div>
                <div class="offset-1 col-2">
                    <label for="#criar_estoque">Estoque:</label>
                    <input type="checkbox" class="d-none" id="criar_estoque" name="criar_estoque">
                    <span class="btn btn-sm btn-purple inativo" id="btn_criar_estoque" onclick="cadastrar()" title="Redirecionar para cadastro de estoque">Cadastrar estoque</span>
                </div>
            </div>
            <hr>
            @include('components.salvar')
        </form>
    </div>
    <script>
        function cadastrar(){
            if($('#criar_estoque').is(':checked'))
            {
                $('#criar_estoque').prop('checked', false);
                $('#btn_criar_estoque').addClass('inativo');
            }else{
                $('#criar_estoque').prop('checked', true);
                $('#btn_criar_estoque').removeClass('inativo');
            }
        }
    </script>
@endsection