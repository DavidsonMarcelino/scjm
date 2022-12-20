<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Homepage</title>
        @include('components.head')
        <?php $caminho = '/sistema_joyce/storage/icons'; ?>
    </head>
    <body>
        <div class="container-fluid tela">
            <div class="row justify-content-center">
                @include('components.header')
                <div class="col-12 vh5"></div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Agendas" onclick="redirect('{{route('getAgendas')}}')">
                        <img src="{{$caminho}}/agendas.svg" height="80vh" alt="Agendas"><br>
                        <b style="height: 20vh">Agendas</b>
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Convênios" onclick="redirect('{{route('getConvenios')}}')">
                        <img src="{{$caminho}}/convenios.svg" height="80vh" alt="Convênios"><br>
                        <b style="height: 20vh">Convênios</b>
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Financeiro"  onclick="redirect('{{route('getFinanceiroMensal')}}')">
                        <img src="{{$caminho}}/financeiro.svg" height="80vh" alt="Financeiro"><br>
                        <b>Financeiro</b>
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Insumos" onclick="redirect('{{route('getInsumos')}}')">
                        <img src="{{$caminho}}/insumos.svg" height="80vh" alt="Insumos"><br>
                        <b>Insumos</b>
                    </button>
                </div>
                <div class="col-12 vh5"></div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Pacientes" onclick="redirect('{{route('getPacientes')}}')">
                        <img src="{{$caminho}}/pacientes.svg" height="80vh" alt="Pacientes"><br>
                        <b>Pacientes</b>
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Profissionais" onclick="redirect('{{route('getProfissionais')}}')">
                        <img src="{{$caminho}}/profissionais.svg" height="80vh" alt="Profissionais"><br>
                        <b>Profissionais</b>
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Procedimentos" onclick="redirect('{{route('getProcedimentos')}}')">
                        <img src="{{$caminho}}/procedimentos.svg" height="80vh" alt="Procedimentos"><br>
                        <b>Procedimentos</b>
                    </button>
                </div>
                <div class="col-12 vh5"></div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Receitas/Recibos" onclick="redirect('{{route('getArquivos')}}')">
                        <img src="{{$caminho}}/receitas.svg" height="80vh" alt="Receitas/Recibos"><br>
                        <b>Receitas/Recibos</b>
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Relatórios" disabled>
                        <img src="{{$caminho}}/relatorios.svg" height="80vh" alt="Relatórios"><br>
                        <b>Relatórios</b>
                    </button>
                </div>
                <div class="col-md-2">
                    <button class="btn home-btn-purple vh20 w100" title="Usuários" onclick="redirect('{{route('getUsuarios')}}')">
                        <img src="{{$caminho}}/usuarios.svg" height="80vh" alt="Usuários"><br>
                        <b>Usuários</b>
                    </button>
                </div>
            </div>
        </div>

        <script>
            function redirect(url)
            {
                window.location.href = url;
            }
        </script>
        @include('components.exit')
    </body>
</html>
