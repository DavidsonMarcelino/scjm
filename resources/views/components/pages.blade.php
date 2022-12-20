@if($page->lastPage() > 1)
    @if($page->currentPage()-1)<a href="{{route($rota)}}?page={{$page->currentPage()-1}}"><button class="btn btn-purple"><div class="d-flex align-items-center vh3"><img src="\sistema_joyce\storage\icons\anterior.svg" width="12vh"></div></button></a>@endif
        <div class="btn-group" role="group" aria-label="Basic example">
            @for($i = 1 ; $i <= $page->lastPage() ; $i++)
                <a href="{{route($rota)}}?page={{$i}}" class="btn btn-purple"><b class="d-flex align-items-center vh3">{{$i}}</b></a>
            @endfor
        </div>
    @if($page->currentPage()+1 <= $page->lastPage())<a href="{{route($rota)}}?page={{$page->currentPage()+1}}"><button class="btn btn-purple"><div class="d-flex align-items-center vh3"><img src="\sistema_joyce\storage\icons\proximo.svg" width="12vh"></div></button></a>@endif
@endif