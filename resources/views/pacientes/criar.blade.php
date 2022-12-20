@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-12"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getPacientes')}}">Pacientes</a> / Criar</span></div>
        </div>

        <form method="POST" action="{{route('postCriaPacientes')}}" class="card card-body text-start">
            @csrf
            <div class="row">
                <div class="col-12 text-center"><h5>Informações do paciente</h5></div>
                <div class="col-5">
                    <label for="#paciente">Nome:</label>
                    <input type="text" class="form-control" id="procedimento" name="paciente" placeholder="Digite o nome do paciente" required>
                </div>
                <div class="offset-1 col-2">
                    <label for="#sexo">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-control">
                        <option value="" selected disabled>Escolha o sexo</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
                <div class="offset-1 col-3">
                    <label for="#convenio">Convênio:</label>
                    <select name="convenio" id="convenio" class="form-control">
                        <option value="" selected disabled>Selecione o convênio</option>
                        @foreach($convenios as $c)
                            <option value="{{$c->convenio_id}}">{{$c->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12"><br></div>
                <div class="col-5">
                    <label for="#profissao">Profissão:</label>
                    <input type="text" class="form-control" id="profissao" name="profissao" placeholder="Digite a profissão" required>
                </div>
                <div class="offset-1 col-3">
                    <label for="#data_nascimento">Data de nascimento:</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
                <div class="col-12"><hr></div>
                <div class="col-12 text-center"><h5>Ficha de anaminese</h5></div>
                <div class="col-12"><br></div>
                <div class="col-12">
                    <label for="#doenca">Sofre de alguma doença?</label>
                    <div class="input-group" id="doenca">
                        <div class="input-group-text">
                            <label onclick="$('#doenca_texto').val(''); $('#doenca_texto').prop('disabled', true).prop('placeholder', '');">
                                <input class="form-check-input border-left" type="radio" name="doenca" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label onclick="$('#doenca_texto').val(''); $('#doenca_texto').prop('disabled', false).prop('placeholder', 'Quais?');">
                                <input class="form-check-input" type="radio" name="doenca" value="sim">
                                Sim
                            </label>
                        </div>
                        <input type="text" class="form-control" name="doenca_texto" id="doenca_texto" disabled>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-12">
                    <label for="#medicacao">Faz uso de algum medicamento?</label>
                    <div class="input-group" id="medicacao">
                        <div class="input-group-text">
                            <label onclick="$('#medicacao_texto').val(''); $('#medicacao_texto').prop('disabled', true).prop('placeholder', '');">
                                <input class="form-check-input border-left" type="radio" name="medicacao" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label onclick="$('#medicacao_texto').val(''); $('#medicacao_texto').prop('disabled', false).prop('placeholder', 'Quais?');">
                                <input class="form-check-input" type="radio" name="medicacao" value="sim">
                                Sim
                            </label>
                        </div>
                        <input type="text" class="form-control" name="medicacao_texto" id="medicacao_texto" disabled>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-12">
                    <label for="#tratamento">Está fazendo tratamento médico?</label>
                    <div class="input-group" id="tratamento">
                        <div class="input-group-text">
                            <label onclick="$('#tratamento_texto').val(''); $('#tratamento_texto').prop('disabled', true).prop('placeholder', '');">
                                <input class="form-check-input border-left" type="radio" name="tratamento" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label onclick="$('#tratamento_texto').val(''); $('#tratamento_texto').prop('disabled', false).prop('placeholder', 'Quais?');">
                                <input class="form-check-input" type="radio" name="tratamento" value="sim">
                                Sim
                            </label>
                        </div>
                        <input type="text" class="form-control" name="tratamento_texto" id="tratamento_texto" disabled>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-12">
                    <label for="#operado">Já foi operado?</label>
                    <div class="input-group" id="operado">
                        <div class="input-group-text">
                            <label onclick="$('#operado_texto').val(''); $('#operado_texto').prop('disabled', true).prop('placeholder', '');">
                                <input class="form-check-input border-left" type="radio" name="operado" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label onclick="$('#operado_texto').val(''); $('#operado_texto').prop('disabled', false).prop('placeholder', 'Quais?');">
                                <input class="form-check-input" type="radio" name="operado" value="sim">
                                Sim
                            </label>
                        </div>
                        <input type="text" class="form-control" name="operado_texto" id="operado_texto" disabled>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-12">
                    <label for="#alergia">Possuí alergia a algum medicamento?</label>
                    <div class="input-group" id="alergia">
                        <div class="input-group-text">
                            <label onclick="$('#alergia_texto').val(''); $('#alergia_texto').prop('disabled', true).prop('placeholder', '');">
                                <input class="form-check-input border-left" type="radio" name="alergia" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label onclick="$('#alergia_texto').val(''); $('#alergia_texto').prop('disabled', false).prop('placeholder', 'Quais?');">
                                <input class="form-check-input" type="radio" name="alergia" value="sim">
                                Sim
                            </label>
                        </div>
                        <input type="text" class="form-control" name="alergia_texto" id="alergia_texto" disabled>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-12">
                    <label for="#gestante">Está gestante?</label>
                    <div class="input-group" id="gestante">
                        <div class="input-group-text">
                            <label onclick="$('#gestante_texto').val(''); $('#gestante_texto').prop('disabled', true).prop('placeholder', '');">
                                <input class="form-check-input border-left" type="radio" name="gestante" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label onclick="$('#gestante_texto').val(''); $('#gestante_texto').prop('disabled', false).prop('placeholder', 'Quais?');">
                                <input class="form-check-input" type="radio" name="gestante" value="sim">
                                Sim
                            </label>
                        </div>
                        <input type="text" class="form-control" name="gestante_texto" id="gestante_texto" disabled>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-3">
                    <label for="#cicatrizacao">Já teve problemas com cicatrizacao?</label>
                    <div class="input-group" id="cicatrizacao">
                        <div class="input-group-text">
                            <label>
                                <input class="form-check-input border-left" type="radio" name="cicatrizacao" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input class="form-check-input" type="radio" name="cicatrizacao" value="sim">
                                Sim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <label for="#anestesia">Já teve problemas com anestesia?</label>
                    <div class="input-group" id="anestesia">
                        <div class="input-group-text">
                            <label>
                                <input class="form-check-input border-left" type="radio" name="anestesia" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input class="form-check-input" type="radio" name="anestesia" value="sim">
                                Sim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <label for="#hemorragia">Já teve problemas com hemorragia?</label>
                    <div class="input-group" id="hemorragia">
                        <div class="input-group-text">
                            <label>
                                <input class="form-check-input border-left" type="radio" name="hemorragia" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input class="form-check-input" type="radio" name="hemorragia" value="sim">
                                Sim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <label for="#osso_artificial">Possuí algum osso artificial ou prótese?</label>
                    <div class="input-group" id="osso_artificial">
                        <div class="input-group-text">
                            <label>
                                <input class="form-check-input border-left" type="radio" name="osso_artificial" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input class="form-check-input" type="radio" name="osso_artificial" value="sim">
                                Sim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-3">
                    <label for="#marca_passo">Tem algum marca-passo?</label>
                    <div class="input-group" id="marca_passo">
                        <div class="input-group-text">
                            <label>
                                <input class="form-check-input border-left" type="radio" name="marca_passo" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input class="form-check-input" type="radio" name="marca_passo" value="sim">
                                Sim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <label for="#diabetes">Possuí diabetes?</label>
                    <div class="input-group" id="diabetes">
                        <div class="input-group-text">
                            <label>
                                <input class="form-check-input border-left" type="radio" name="diabetes" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input class="form-check-input" type="radio" name="diabetes" value="sim">
                                Sim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <label for="#insulina">Faz uso de insulina?</label>
                    <div class="input-group" id="insulina">
                        <div class="input-group-text">
                            <label>
                                <input class="form-check-input border-left" type="radio" name="insulina" value="nao" checked>
                                Não
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input class="form-check-input" type="radio" name="insulina" value="sim">
                                Sim
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12"><br></div>
                <div class="col-12">
                <label for="#observacao">Observações:</label>
                    <textarea class="form-control" name="observacao" id="observacao" rows="5" placeholder="Digite a observação"></textarea>
                </div>
            </div>
            <hr>
            @include('components.salvar')
        </form>
        <br><br><br>
    </div>
@endsection