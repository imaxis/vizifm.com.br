$(document).ready( function() {
    $('.input').keypress(function(e) {
        if(e.which == 13) {
            jQuery(this).blur();
            $('#logar').click();
        }
    });


    $("#lnkLembrarSenha").bind('click', function(){
        $("#dadosLogin").hide(100);
        $("#dadosLembrarSenha").show(100);
        $("#retornaLogin").show(100);
        $("#lembrarSenha").hide(100);
        $("#btLogar").hide(100);
        $("#btLembrar").show(100);
        $("#loading").hide(100);
        $("#msgAlerta").html("Informe seu email para resgatar a senha.");
    });

    $("#lnkRetornaLogin").bind('click', function(){
        $("#dadosLogin").show(100);
        $("#dadosLembrarSenha").hide(100);
        $("#retornaLogin").hide(100);
        $("#lembrarSenha").show(100);
        $("#btLogar").show(100);
        $("#btLembrar").hide(100);
        $("#loading").hide(100);
        $("#msgAlerta").html("Digite o login e senha fornecidos pelo Administrador.");
    });

        $("#lembrar").bind('click', function(){
            var email = $("#email").val();
            $("#btLembrar").hide(100);
            $("#dadosLembrarSenha").hide(100);
            $("#loading").show(100);
            $.ajax({
                url: "app/cms/reenviaSenha.php?email="+email,
                cache: false,
                dataType: 'json',
                success: function(json){
                    $("#loading").hide(100);
                    if(json.status == false){
                        $("#msgAlerta").html("Email não encontrado.");
                        $("#btLogin").hide(100);
                        $("#btLembrar").show(100);
                        $("#dadosLembrarSenha").show(100);
                    }else{
                        $("#msgAlerta").html("Sua senha foi enviada para o endereço <strong>"+json.email+"</strong>");
                            $("#dadosLogin").show(100);
                            $("#dadosLembrarSenha").hide(100);
                            $("#retornaLogin").hide(100);
                            $("#lembrarSenha").show(100);
                            $("#btLogar").show(100);
                            $("#btLembrar").hide(100);
                            $("#loading").hide(100);
                    }
                }
            });
        });


    $("#formlogin").validate({

        // Define as regras
        rules:{
            usuario:{
                required: true
            },
            senha:{
                required: true
            }
        },

        // Define as mensagens de erro para cada regra
        messages:{
            usuario:{
                required: "Informe seu login."
            },
            senha:{
                required: "Informe sua senha."
            }
        },

        // Trata o envio do formulário
        submitHandler: function()
        {
            var usuario = $("#usuario").val();
            var senha = $("#senha").val();
            $.ajax({
                url: "app/cms/login.php?action=Login",
                cache: false,
                type: "POST",
                data: "usuario="+usuario+"&senha="+senha,
                beforeSend: function(){
                    $("#formlogin").hide();
                    $("#loading").show();
                },
                success: function(data){
                    if(data == "true"){
                        $(window.document.location).attr('href',"view/?lc=Iniciar");
                    }else{
                        $("#loading").hide();
                        $("#formlogin").show();
                        if(data = "inativo"){
                            $("#msgAlerta").html("Login desabilitado. Enre em contato com o administrador do sistema.");
                        }else{
                            $("#msgAlerta").html("Login ou senha inválidos. Por favor, tente novamente.");
                        }
                    }
                }
            });
         }
     });

    $('#senha').keyup(function(event) {
      if (event.keyCode == '13') {
         event.preventDefault();
         $("#formlogin").submit();
       }
    });


     // Adiciona o evento ao botão de login
     $('#logar').click(function(){
          $("#formlogin").submit();
     });

});