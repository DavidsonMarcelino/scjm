<script>
    $('#sair').submit(function(event){
        event.preventDefault();

        $.ajax({
            url: "{{route('logout')}}",
            type: "post",
            data: $(this).serialize(),
            dataType: "JSON",
            success: function(response){
                window.location.href = '{{route("home")}}';
            }
        });
    });
</script>