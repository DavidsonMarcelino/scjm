@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-3"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getAgendas')}}">Agenda</a> / {{$usuario->nome}}</span></div>
            <div class="col-2"><input type="date" class="form-control form-breadcrumb" name="data" id="data" value="{{date('Y-m-d', strtotime('+21Hours'))}}"></div>
            <div class="col-7"></div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th width="7%" class="bg-light"></th>
                <th width="7%">00</th>
                <th width="7%">05</th>
                <th width="7%">10</th>
                <th width="7%">15</th>
                <th width="7%">20</th>
                <th width="7%">25</th>
                <th width="7%">30</th>
                <th width="7%">35</th>
                <th width="7%">40</th>
                <th width="7%">45</th>
                <th width="7%">50</th>
                <th width="7%">55</th>
            </tr>
            <tbody id="dados">
               
            </tbody>
        </table>
    </div>
    <script>
        getAgenda();
        $("#data").on('input', function(){
            getAgenda();
        });

        function getAgenda(){
            $.ajax({
                url: "{{route('getCalendario')}}",
                type: 'GET',
                data: {'data': $('#data').val(), 'usuario': '{{$usuario->usuario_id}}'},
                dataType: "JSON",
                success: function(response){
                    html = '';
                    for(let i = 8 ; i < 18 ; i++)
                    {
                        html += "<tr>";
                        html += "<td class='align-middle'>" + i.toString().padStart(2, 0) + "h";

                        for(let j = 0 ; j < 60 ; j+=5)
                        {
                            if(response[i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0)] === 'Livre')
                            {
                                html += '<td class="align-middle bg-lucro clicavel" onclick="agendarConsulta(' + "'" +i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0) + "'" + ')">' + response[i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0)] + '</td>';
                            }else{
                                html += '<td class="align-middle bg-prejuizo clicavel" onclick="getConsulta(' + "'" +i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0) + "'" + ')">' + response[i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0)] + '</td>';
                            }
                        }
                        html += "</tr>";
                   }

                   $('#dados').html(html);
                }
            })
        }

        function agendarConsulta(horario)
        {
            window.location.href = "{{route('getAgendamento')}}?data=" + $('#data').val() + "&hora=" + horario + "&usuario_id={{$usuario->usuario_id}}";
        }

        function getConsulta(horario)
        {
            console.log(horario);
            // window.location.href = "";
        }
    </script>
@endsection