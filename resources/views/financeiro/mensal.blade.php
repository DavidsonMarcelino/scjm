@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-3"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / Financeiro mensal</span></div>
            <div class="col-1">
                <select class="form-control form-breadcrumb" id="meses">
                    <option @if(date("m", strtotime("-3Hours")) == 1) selected @endif value="1">Janeiro</option>
                    <option @if(date("m", strtotime("-3Hours")) == 2) selected @endif value="2">Fevereiro</option>
                    <option @if(date("m", strtotime("-3Hours")) == 3) selected @endif value="3">Março</option>
                    <option @if(date("m", strtotime("-3Hours")) == 4) selected @endif value="4">Abril</option>
                    <option @if(date("m", strtotime("-3Hours")) == 5) selected @endif value="5">Maio</option>
                    <option @if(date("m", strtotime("-3Hours")) == 6) selected @endif value="6">Junho</option>
                    <option @if(date("m", strtotime("-3Hours")) == 7) selected @endif value="7">Julho</option>
                    <option @if(date("m", strtotime("-3Hours")) == 8) selected @endif value="8">Agosto</option>
                    <option @if(date("m", strtotime("-3Hours")) == 9) selected @endif value="9">Setembro</option>
                    <option @if(date("m", strtotime("-3Hours")) == 10) selected @endif value="10">Outubro</option>
                    <option @if(date("m", strtotime("-3Hours")) == 11) selected @endif value="11">Novembro</option>
                    <option @if(date("m", strtotime("-3Hours")) == 12) selected @endif value="12">Dezembro</option>
                </select>
            </div>
            <div class="col-1">
                <select class="form-control form-breadcrumb" id="anos">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="offset-4 col-1">
                <a href="{{route('getFinanceiroDiario')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge btn-middle-table-badge">Diário</button></a>
            </div>
            <div class="col-1">
                <a href="{{route('getFinanceiroSemanal')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Semanal</button></a>
            </div>
            <div class="col-1">
                <a href="{{route('getFinanceiroAnual')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Anual</button></a>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <th width="20%">Data</th>
                <th width="60%">Tipo</th>
                <th width="20%">Valor (R$)</th>
            </thead>
            <tbody id="gastos"></tbody>
            <tfoot id="total"></tfoot>
        </table>

        <script>
            $.ajax({
                method: "POST",
                url: "{{route('postFinanceiroMensal')}}",
                data: {'_token': '{{csrf_token()}}', 'mes': $('#meses').val(), 'ano': $('#anos').val()},
                dataType: "JSON",
                success: function(response){
                    gastos = '';

                    for(let i = 0 ; i < response.financeiro.length ; i++)
                    {
                        gastos += '<tr';
                        if(response.financeiro[i].valor_num > 0)
                        {
                            gastos += ' class="bg-lucro">';
                        }else{
                            gastos += ' class="bg-prejuizo">';
                        }

                        gastos += '<td class="align-middle">' + response.financeiro[i].data + '</td>';
                        gastos += '<td class="align-middle">' + response.financeiro[i].tipo + '</td>'
                        gastos += '<td class="align-middle">' + response.financeiro[i].valor + '</td>';
                        gastos += '</tr>';
                    }

                    total = '<tr><td colspan="3" class="no-border"></td></tr><tr><th colspan="2">Total</th><th'

                    if(response.total.total_num > 0.01){
                        total += ' class="bg-lucro text-lucro">';
                    }else if(response.total.total_num < -0.01){
                        total += ' class="bg-prejuizo text-prejuizo">';
                    }else{
                        total += ' class="text-white">';
                    }

                    total += response.total.total + '</th></tr>';

                    $('#gastos').html(gastos);
                    $('#total').html(total);
                }
            });

            var anos  = $('#anos');
            var meses = $('#meses');
            $.merge(meses, anos).on('change', function(){
                $.ajax({
                    method: "POST",
                    url: "{{route('postFinanceiroMensal')}}",
                    data: {'_token': '{{csrf_token()}}', 'mes': $('#meses').val(), 'ano': $('#anos').val()},
                    dataType: "JSON",
                    success: function(response){
                        gastos = '';

                        for(let i = 0 ; i < response.financeiro.length ; i++)
                        {
                            gastos += '<tr';
                            if(response.financeiro[i].valor_num > 0)
                            {
                                gastos += ' class="bg-lucro">';
                            }else{
                                gastos += ' class="bg-prejuizo">';
                            }

                            gastos += '<td class="align-middle">' + response.financeiro[i].data + '</td>';
                            gastos += '<td class="align-middle">' + response.financeiro[i].tipo + '</td>'
                            gastos += '<td class="align-middle">' + response.financeiro[i].valor + '</td>';
                            gastos += '</tr>';
                        }

                        total = '<tr><td colspan="3" class="no-border"></td></tr><tr><th colspan="2">Total</th><th'

                        if(response.total.total_num > 0.01){
                            total += ' class="bg-lucro text-lucro">';
                        }else if(response.total.total_num < -0.01){
                            total += ' class="bg-prejuizo text-prejuizo">';
                        }else{
                            total += ' class="text-white">';
                        }

                        total += response.total.total + '</th></tr>';

                        $('#gastos').html(gastos);
                        $('#total').html(total);
                    }
                });
            });
        </script>
    </div>
@endsection
