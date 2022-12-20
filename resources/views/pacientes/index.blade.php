@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-5"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getPacientes')}}">Pacientes</a></span></div>
            <div class="col-1">
                <button class="btn btn-purple w-100 h-100 btn-middle-table-badge form-breadcrumb{" onclick="cancelar()" id="cancelar"style="display: none">Cancelar</button>
            </div>
            <div class="col-4">
                <input type="text" class="form-control btn-middle-table-badge w-100" placeholder="Pesquisar" id="input-pesquisa" style="display: none">
            </div>
            <div class="col-1">
                <button class="btn btn-purple w-100 h-100 btn-middle-table-badge" onclick="pesquisar()">Pesquisar</button>
            </div>
            <div class="col-1">
                <a href="{{route('getCriaPacientes')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Criar</button></a>
            </div>
        </div>
        <table class="table table-bordered">
            <th width="5%">ID</th>
            <th width="40%">Nome</th>
            <th width="30%">Convênio</th>
            <th width="10%">Sexo</th>
            <th width="5%">Ativo</th>
            <th width="10%">Opções</th>
            @foreach($pacientes as $p)
                <tr>
                    <td class="align-middle">{{$p->paciente_id}}</td>
                    <td class="align-middle">{{$p->nome}}</td>
                    <td class="align-middle">{{$p->convenio}}</td>
                    <td class="align-middle">{{$p->sexo}}</td>
                    <td class="align-middle"></td>
                    <td class="align-middle d-flex justify-content-around">
                        <a href="{{route('getEditaPacientes', $p->paciente_id)}}"><img src="\sistema_joyce\storage\icons\editar.svg" width="15vh"></a>
                    </td>
                </tr>
            @endforeach
        </table>
        <?php $rota = "getPacientes"; $page = $pacientes;?>
        @include('components.pages')
    </div>
    <script>
        pesquisa = 0;
        function pesquisar()
        {
            if(pesquisa)
            {
                window.location.href = '{{route("getPesquisaPacientes")}}?paciente=' + $('#input-pesquisa').val();
            }else{
                $('#input-pesquisa').show(200);
                $('#cancelar').show(200);
                pesquisa++;
            }
        }
        function cancelar()
        {
            $('#cancelar').hide(200);
            $('#input-pesquisa').hide(200);
            pesquisa--;
        }
    </script>
@endsection