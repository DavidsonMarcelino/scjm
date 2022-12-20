@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-3"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / Financeiro anual</span></div>
            <div class="col-1">
                <select class="form-control form-breadcrumb" id="anos">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                </select>
            </div>
            <div class="offset-5 col-1">
                <a href="{{route('getFinanceiroDiario')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge btn-middle-table-badge">Diário</button></a>
            </div>
            <div class="col-1">
                <a href="{{route('getFinanceiroSemanal')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Semanal</button></a>
            </div>
            <div class="col-1">
                <a href="{{route('getFinanceiroMensal')}}"><button class="btn btn-purple w-100 h-100 btn-table-badge">Mensal</button></a>
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
                url: "{{route('postFinanceiroAnual')}}",
                data: {'_token': '{{csrf_token()}}', 'ano': $('#anos').val()},
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

            $("#anos").on('change', function(){
                $.ajax({
                    method: "POST",
                    url: "{{route('postFinanceiroAnual')}}",
                    data: {'_token': '{{csrf_token()}}', 'ano': $('#anos').val()},
                    dataType: "JSON",
                    success: function(response){
                        gastos = '';
console.log(response);
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
