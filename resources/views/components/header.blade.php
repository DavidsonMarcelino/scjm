<div class="linhaHeader"></div>
<header class="row bg-purple vh7">
    <div class="col-2 d-flex align-items-center">
        <a href="{{route('home')}}"><img src="\sistema_joyce\storage\icons\logo.png" style="height: 6vh;!important; user-select: none;"></a>
    </div>
    <form class="offset-9 col-1 vh7" id="sair" title="Sair">
        @csrf
        <button class="btn bg-purple w-100 h-100">Sair</button>
    </form>
</header>