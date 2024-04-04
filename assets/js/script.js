 function enviarEmail() {
    var nome = $('input[name=nome]').val();
    var email = $('input[name=email').val();
    var mensagem = $('textarea').val();

    $.ajax({
        url:'http://localhost/php7/mvc_laiz/cotato/enviar_email',
        type:'POST',
        data: {nome:nome, email:email, msg:mensagem},
        success: function(html){
            $('.msg').hmtl(html);
        }
    });

 }