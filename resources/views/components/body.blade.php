<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Homepage</title>
        @include('components.head')
        <?php $caminho = '/sistema_joyce/storage/icons'; ?>
    </head>
    <body>
        <div class="container-fluid tela">
            <div class="row justify-content-center black-over">
                @include('components.header')
                <div class="col-12 vh5"></div>
                @yield('content')
            </div>
        </div>

        @include('components.exit')
    </body>
</html>