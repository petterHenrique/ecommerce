<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Upsy - E-commerce Gerenciamento</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?=base_url()?>assets/css/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url()?>assets/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="<?=base_url()?>assets/css/pnotify.custom.min.css" rel="stylesheet" type="text/css">

    <link href="<?=base_url()?>assets/css/login.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><img class="img-responsive img-center" src="<?=base_url()?>assets/images/logo-admin.png" /></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control email" id="email" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control senha" id="senha" placeholder="Senha" name="password" type="password">
                                </div>
                                <div class="form-group">
                                	<a href="#">Esqueceu sua senha?</a>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="#" class="btn btn-lg btn-primary btn-block btn-logar">Entrar</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="spinner" style="display:none;">
    <img style="width:80px;" src="http://thinkfuture.com/wp-content/uploads/2013/10/loading_spinner.gif" />
	</div>

    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
	<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
	<script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
	<script src="<?=base_url()?>assets/js/sb-admin-2.js"></script>

	<script src="<?=base_url()?>assets/js/pnotify.custom.min.js"></script>

	<script src="<?=base_url()?>assets/js/notificacao.js"></script>
	
	<script src="<?=base_url()?>assets/js/ui-block.js"></script>

	<script src="<?=base_url()?>assets/js/block.js"></script>

	<script>
		const validarLogin = new ValidarAutenticacao(); 
		$(function(){
			$(".btn-logar").on('click', function(event){
				event.preventDefault();
				validarLogin.Validar();
			});

			$(".email, .senha").on("keyup", function(event){
				event.preventDefault();
				if(event.keyCode == 13){
					validarLogin.Validar();
				}
			});

			$(".btn-logar").on('keypress', function(event){
				event.preventDefault();
				if(event.keyCode == 13){
					validarLogin.Validar();
				}
			});
		});
		function ValidarAutenticacao(){
			var self = this;

			self.Validar = function(){
				if($("#senha").val() =="" || $("#email").val() == ""){
					alertas.AlertaErro("Atenção", "Preencha seu login corretamente!");
					return false;
				}else{
					self.Logar();
				}
			}

			self.Logar = function(){

				let email = $("#email").val();
				let senha = $("#senha").val();

				$.ajax({
					method:'POST',
					url: "<?=base_url()?>index.php/login/logar",
					data:{email: email, senha: senha },
					beforeSend: function(){
						loading();
					},
					success: function(data){
						alertas.AlertaSucesso("Sucesso", data);
						setTimeout(function(){
							window.location.href ="<?=base_url()?>index.php/Dashboard/index";
						},1800);
					},
					error: function(data){
						alertas.AlertaErro("Atenção", data.responseJSON);
					},
					complete: function(){
						loaded();
					}
				});
			}
		}
	</script>
</body>
</html>
