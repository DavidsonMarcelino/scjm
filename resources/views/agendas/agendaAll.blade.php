@extends('components.body')

@section('content')
    <div class="col-8 text-center vh88">
        <div class="table-badge bg-purple text-start d-flex">
            <div class="col-5"><span class="form-control form-breadcrumb"><a href="{{route('home')}}">Home</a> / <a href="{{route('getAgendas')}}">Agenda</a> / Agenda geral (apenas visualização)</span></div>
            <div class="col-2"><input type="date" class="form-control form-breadcrumb" name="data" id="data" value="{{date('Y-m-d', strtotime('+21Hours'))}}"></div>
            <div class="col-7"></div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th width="7%" class="bg-light"></th>
                @foreach($usuarios as $u)
                    <th width="{{93/count($usuarios)}}%">{{$u->nome}}</th>
                @endforeach
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
                url: "{{route('getCalendarioAll')}}",
                type: 'GET',
                data: {'data': $('#data').val()},
                dataType: "JSON",
                success: function(response){
                    html = '';
                    for(let i = 8 ; i < 18 ; i++)
                    {
                        for(let j = 0 ; j < 60 ; j+=5)
                        {
                            html += "<tr>";
                            html += "<th class='align-middle'>" + i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0) + '</th>';
                            for(let k = 0 ; k < response.ids.length ; k++)
                            {
                                if(response[response.ids[k]][i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0)] === 'Livre')
                                {
                                    html += '<td class="align-middle bg-lucro">' + response[response.ids[k]][i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0)] + '</td>';
                                }else{
                                    html += '<td class="align-middle bg-prejuizo">' + response[response.ids[k]][i.toString().padStart(2, 0) + ':' + j.toString().padStart(2, 0)] + '</td>';
                                }
                            }
                            
                            html += "</tr>";
                        }
                    }

                    $('#dados').html(html);
                }
            })
        }
    </script>
@endsection