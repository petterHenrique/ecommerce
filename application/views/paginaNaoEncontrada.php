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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/pnotify.custom.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
	 

	<h1>Não encontrado!</h1>	
   
	<script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
	<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>

	<script src="<?=base_url()?>assets/js/pnotify.custom.min.js"></script>
	<script src="<?=base_url()?>assets/js/notificacao.js"></script>
	<script src="<?=base_url()?>assets/js/ui-block.js"></script>
	<script src="<?=base_url()?>assets/js/block.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script>

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

            new Typed("#wpChamada", {
                strings: [ 'fácil', 'simples', 'eficiente', 'dinâmica', 'atrativa' ],
                typeSpeed: 70,
                shuffle: true,
                loop: true,
                backDelay:1200,
                showCursor: false
            });
		});
		function ValidarAutenticacao(){
			var self = this;

			self.Validar = function(){
				if($("#email").val() == ""){
					alertas.AlertaErro("Atenção", "Preencha seu e-mail corretamente!");
					$("#email").focus();
					return false;
				}else if($("#senha").val() ==""){
					alertas.AlertaErro("Atenção", "Preencha sua senha corretamente!");
					$("#senha").focus();
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
