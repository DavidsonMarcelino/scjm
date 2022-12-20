<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Login</title>
        @include('components.head')
    </head>
    <body>
        <div class="container-fluid tela">
            <div class="row justify-content-center">
                <form class="col-8 col-md-4 card" style="margin-top: 30vh;" id="formLogin">
                    <div class="card-body">
                        @csrf
                        <label for="#login">Login:</label>
                        <input type="text" class="form-control" id="login" name="login" placeholder="Digite seu login">
                        <label for="#senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                        <button class="btn btn-purple float-end" id ="login_btn" style="padding: 1% 4%; margin-top: 2%;">Login</button>
                    </div>
                    <span class="alert" id="alert" style="padding: 10px; display: none;"></span>
                </form>
            </div>
        </div>
        <script>
            $('#formLogin').submit(function(event){
                event.preventDefault();

                $.ajax({
                    url: "{{route('login')}}",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    success: function(response){
                        if(response.success)
                        {
                            $('#login_btn, #login, #senha').attr('disabled', true);
                            $('#alert').stop(true, true)
                            $('#alert').html(response.msg).removeClass('alert-danger').addClass('alert-success').show().delay(1000).fadeOut(2000);
                            window.location.href = '{{route("home")}}';
                        }else{
                            $('#alert').stop(true, true)
                            $('#alert').html(response.msg).removeClass('alert-success').addClass('alert-danger').show().delay(1000).fadeOut(2000);
                        }
                    }
                });
            })
        </script>
    </body>
</html>