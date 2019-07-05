<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="pt-br">
<head>
  <title>Finalizar Compra - Nome Loja</title>
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <base href="" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <style>
  	@import url('https://fonts.googleapis.com/css?family=Poppins');
  	.header-checkout{
  		padding: 20px;
  		width: 100%;
	    height: 80px;
	    border-bottom: 1px solid #c2c2c2;
	    overflow: hidden;
	    background: #fff;
  	}
  	.footer-checkout{
  		padding: 20px;
  		width: 100%;
	    height: 80px;
	    border-top: 1px solid #c2c2c2;
	    overflow: hidden;
	    background: #fff;
	    height: 100px;
	    bottom: 0;
  	}
  	.panel-checkout-email{
  		margin-top:25px;
  		padding:20px;
  	}
  	.input-email{
  		max-width: 420px;
    	margin: auto;
  	}
  	.btn-enviar-email-checkout{
  		font-size:20px;
  		text-transform:uppercase;
  	}

  	.coluna-checkout-email{
  		padding:42px;
  		border-radius:4px;
  		border:1px solid #c2c2c2;
  	}

  	.lista{
  		list-style:none;
  		line-height: 2.0;
  	}

  	h2{
  		font-family: 'Poppins', sans-serif;
  	}


  	

  </style>
</head>
	<header class="container header-checkout">
		<div class="row">
			<div class="col"> 
				<h2 class="text-center" style="font-size:14px;">FINALIZAR COMPRA + LOGO LOJA</h2>
			</div>
			<div class="col"> 
				<img class="float-right" src="<?=base_url()?>assets/images/selos/ambiente-seguro.png" title="Ambiente Seguro" title="Ambiente Seguro"/>
			</div>
		</div>
	</header>

	<section class="container">
		<div class="row panel-checkout-email"> 
			  <div class="col-md-3"></div>
			  <div class="col-md-6 col-12 text-center coluna-checkout-email"> 
			  		<h3 class="text-center">Para Prosseguir, informe seu E-mail </h3>
			  		<div class="form-group">
			  			</br>
			  			<input class="form-control input-email" type="email" placeholder="Informe seu e-mail" maxlenght="200">
				  		</br>
				  		<button type="button" style="min-width:220px;min-height:40px;" class="btn btn-success btn-enviar-email-checkout">
								Próximo Passo
								<i class="fas fa-arrow-right"></i>
						</button>
			  		</div>
			  </div>
			  <div class="col-md-3"></div>
		</div>
	</section>

	<section class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="text-center" style="font-size:18px;font-weight:bold;">Usamos seu e-mail de forma 100% segura para:</h2>
			</div>
		</div>	

		<div class="row">

			<div class="col-md-2">

			</div>
			<div class="col-md-4 col-12 text-center">
				<ul class="lista">
				  <li class="text-center"><i class="far fa-check-circle text-success"></i> Identificar seu perfil</li>
				  <li class="text-center"><i class="far fa-check-circle text-success"></i> Agilizar no processo de compra</li>
				</ul>
			</div>
			<div class="col-md-4 col-12 text-center">
				<ul class="lista">
				  <li class="text-center"><i class="far fa-check-circle text-success"></i> Notificar informações do pedido.</li>
				  <li class="text-center"><i class="far fa-check-circle text-success"></i> Gerenciar seu histórico compra.</li>
				</ul>
			</div>
			<div class="col-md-2">

			</div>
		</div>
	</section>
	<footer class="container footer-checkout">
		<div class="row text-center">
			<div class="col"> 
				<img class="img-responsiv float-right" style="margin-top:25px;" src="<?=base_url()?>assets/images/selos/pagamentos.png" title="Formas de Pagamento" title="Formas de Pagamento"/>
			</div>
			<div class="col"> 
				<img class="img-responsive" style="margin-top:15px;" src="<?=base_url()?>assets/images/selos/lets-encrypt.png" title="Segurança" title="Ambiente Seguro"/>
			</div>
		</div>
	</footer>


	<!-- Modal Login Cliente -->
	<div class="modal fade modal-default" id="modalLoginCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	     
	      <div class="modal-body">
	      	<p> 
	      		Olá! <strong style="font-size:20px;" id="nome-cliente-login"></strong></br>
	      		</br>
	      		Identificamos seus dados a partir de compras anteriores. Facilitaremos sua compra, basta 
	      		informar sua senha para autenticar-se em sua conta :)
	      	</p>

	      	<input type="password" class="form-control senha-cliente-login" placeholder="Informe sua senha">
	      </div>
	      <div style="padding: 1rem;" class="text-center">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Utilizar Outro E-mail</button>
	        <button type="button" style="min-width:180px;" class="btn btn-primary btn-logar">Continuar Compra</button>
	      </div>
	    </div>
	  </div>
	</div>
	
<body>
	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="<?=base_url()?>/assets/js/ui-block.js"></script>
	<script src="<?=base_url()?>/assets/js/block.js"></script>
  	<script>
  		$(function(){
  			$(".input-email").focus();

  			$(".input-email").on("keypress", function(event){
  				if(event.keyCode == 13){
  					enviarEmail($(this).val());
  				}
  			});

  			$(".btn-enviar-email-checkout").on("click", function(){
  				enviarEmail($(".input-email").val());
  			});

  			$(".input-email").on("keypress", function(e){
  				if(e.keyCode == 13){
  					enviarEmail($(this).val());
  				}
  			});

  			$(".btn-logar").on("click", function(){

  				let email = $(".input-email").val();
  				let senha = $(".senha-cliente-login").val();

  				autenticar(email,senha, $(this));
  			});

  			$(".senha-cliente-login").on("keypress", function(e){
  				if(e.keyCode == 13){
  					let email = $(".input-email").val();
  					let senha = $(this).val();

  					autenticar(email,senha, $(".btn-logar"));
  				}
  			});
  		});

  		let validarEmail = function(){
  			if($(".input-email").val() == ""){
  				alert("Preencha o campo E-mail");
  				return false;
  			}else{
  				return true;
  			}
  		}

  		let autenticar = function(email, senha, contexto){

  			$.ajax({
  				url: "<?=base_url()?>index.php/checkout/auth",
  				method: "POST",
  				data: {email:email, senha: senha},
  				beforeSend: function(){
  					contexto.html('<i class="fas fa-spinner fa-spin"></i>');
  				},
  				success: function(data){
  					console.log(data);
  					if(data.sucesso){
  						window.location.href='<?=base_url()?>index.php/checkout/pagamento';
  					}
  				},
  				error: function(data){
  					console.log(data);
  				},
  				complete: function(){
  					contexto.empty();
  					contexto.html("Continuar Compra");
  				}
  			});

  		}

  		let enviarEmail = function(email){
  			if(validarEmail()){
  				$.ajax({
  					url: "<?=base_url()?>/index.php/Checkout/VerificarUsuarioCheckout",
  					method: "POST",
  					data: { email:email },
  					beforeSend: function(){
  						$(".btn-enviar-email-checkout").text("");
  						$(".btn-enviar-email-checkout").html('<i class="fas fa-spinner fa-lg fa-spin fa-lgshutdown -s -t 10"></i>');
  					},
  					success: function(response){
  						if(response.success === true){
	  						if(response.modelo.clienteExistente){
	  							//seta o nome
	  							$(document).find('#nome-cliente-login').text(response.modelo.nomeCliente);
	  							//abre a modal
	  							$("#modalLoginCliente").modal('show');

	  							setTimeout(function(){
	  								$(".senha-cliente-login").focus();
	  							},400);

	  						}else{
	  							window.location.href='<?=base_url()?>index.php/checkout/pagamento';
	  						}
  						}
  						
  					},
  					error: function(response){

  					},
  					complete: function(){
						$(".btn-enviar-email-checkout").text("");
  						$(".btn-enviar-email-checkout").text('Próximo Passo');
  					}
  				});
  			}
  		}
  	</script>
</body>
</html>
