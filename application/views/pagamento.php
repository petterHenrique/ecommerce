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
  <link rel="stylesheet" href="<?=base_url()?>assets/css/animate.css"/>
  <style>
  	@import url('https://fonts.googleapis.com/css?family=Poppins');
  	.header-checkout{
  		padding: 20px;
  		width: 100%;
	    height: 80px;
	    overflow: hidden;
	    background: #fff;
	    box-shadow:0 0 2px 0 rgba(204,204,204,.5);
  	}
  	.footer-checkout{
  		padding: 20px;
  		width: 100%;
	    height: 80px;
	    border-top: 1px solid #c2c2c2;
	    overflow: hidden;
	    background: #fff;
	    position: fixed;
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

  	.panel-cliente{
  		border: 1px solid #c2c2c2;
  		border-radius:4px;
  		padding:18px;
  	}
  	.panel-entrega{
  		border: 1px solid #c2c2c2;
  		border-radius:4px;
  		padding:18px;
  	}
  	.panel-resumopedido{
  		border: 1px solid #c2c2c2;
  		border-radius:4px;
  		
  	}
  	.hidden{
  		display:none;
  	}

  	#finalizar-pedido{
  		font-size:20px;color:white;
  	}

  	.bandeiras{
  		padding-top:5px;padding-bottom:10px; margin:0 auto;
  	}

  	.conteudo-sucesso-pedido{
  		background:#44781b;
  		color:#ffffff;
  	}
  	/*ultimos estilos css*/
  	.panel{
  		padding:10px;
  		border-radius: 5px;
  		border:1px solid #ccc;
  		box-shadow:0 10px 45px 0 rgba(204,204,204,.7);
  		background:#fff;
  		border-radius: 5px;
  	}
  	.input-checkout{
  		outline: 0;
	    padding: 9px 10px;
	    font-size: 13px;
	    background: #fff;
	    border: 1px solid #b3b3b3;
	    -webkit-appearance: none;
	    transition: all .4s;
	    font-weight: 400;
	    font-family: Roboto,sans-serif!important;
	    border-radius: 5px;
	    box-sizing: border-box;
	    width:100%;
  	}
  	.text-label{
  		font-size:14px;
  	}
  	.form-group-50{
  		width: 50%;
	   
	    position: relative;

	    float: left;
	    box-sizing: border-box;
  	}
  	.box-title{
  		position: relative;
	    box-sizing: border-box;
  	}
  	.title-header-box{
  		font-size:18px;
  	}
  	.f11{
  		font-size: 11px;
  	}
  </style>
</head>
<body style="background:#f5f5f5;">
	<header class="header-checkout">
		<div class="row">
			<div class="col"> 
				<h2 class="text-center" style="font-size:14px;"></h2>
			</div>
			<div class="col"> 
				<img class="float-right" src="<?=base_url()?>assets/images/selos/ambiente-seguro.png" title="Ambiente Seguro" title="Ambiente Seguro"/>
			</div>
		</div>
	</header>
	<div class="container" style="margin-top:15px;">

		<div class="row">
		<?php 

		//echo json_encode($_SESSION);

		?>
			<div class="col-md-4"> 
				<div class="panel">
					<?php
					//EXISTE USUÁRIO LOGADO
					if(!empty($_SESSION['clienteLogado'])) {

					//transformo em objeto
					$dadosCliente = (object) $_SESSION['clienteLogado'];

					?>
					<div class="box-title">
						<h5 class="title-header-box">Dados Pessoais</h5>
							
						<div style="cursor:pointer;margin-top:-30px;" class="float-right" editarcliente>
							<i class="far fa-edit text-primary"></i>
						</div>
						
						<p class="f11"> 
							Solicitamos apenas as informações essenciais para a realização da compra.
						</p>
					</div>
					<p style="font-size:14px;"><b>Nome: </b><?=$dadosCliente->nome;?></p>
					<p style="font-size:14px;"><b>E-mail: </b><?=$dadosCliente->email;?></p>


					<?php 
						}else{
					?>
					<div class="box-title">
						<h5 class="title-header-box">Dados Pessoais</h5>
						<p class="f11"> 
							Solicitamos apenas as informações essenciais para a realização da compra.
						</p>
					</div>

					<div class="row hidden">
						<div class="form-group col-sm-6">
							<div class="radio">
								<label>
									<input type="radio" id="tipFisica" name="tipPessoa" value="1" checked="checked">
									Pessoa Física
								</label>
							</div>
						</div>
						<div class="form-group col-sm-6">
							<div class="radio">
								<label>
									<input type="radio" id="tipJuridica" name="tipPessoa" value="">
									Pessoa Jurídica
								</label>
							</div>
						</div>
					</div>

					<div class="form-group w-100">
						<label class="text-label">Nome Completo:</label>
						<input class="input-checkout" placeholder="Nome Completo" type="text" id="nomeCliente">
					</div>
					<div class="form-group w-100">
						<label class="text-label">E-mail:</label>
						<input class="input-checkout" placeholder="Melhor E-mail" value="<?=isset($_SESSION['emailClienteCheckout']) ? $_SESSION['emailClienteCheckout'] : ""?>" type="text" id="emailCliente">
					</div>

					<div> 
						<div class="form-group form-group-50" style="padding-right:5px;">
							<label class="text-label">Cpf:</label>
							<input class="input-checkout" placeholder="000.000.000-00" type="text" id="cpfCliente">
						</div>
						<div class="form-group form-group-50" style="padding-left:5px;">
							<label class="text-label">Telefone:</label>
							<input class="input-checkout" type="text" placeholder="(00) 00000-0000" id="telefoneCliente">
						</div>
					</div>
					<div style="top:5px;">
						<div class="form-group form-group-50" style="padding-right:5px;">
							<label class="text-label">Senha:</label>
							<input class="input-checkout" placeholder="************" type="password" id="senha">
						</div>
						<div class="form-group form-group-50" style="padding-left:5px;">
							<label class="text-label">Repita Senha:</label>
							<input class="input-checkout" type="password" placeholder="************" id="repitasenha">
						</div>
					</div>
					<div style="clear:both;"></div>
			
					<div class="form-group w-100">
						<button class="btn btn-default btn-salvar-cliente" style="background:#33a86f;color:#fff;width:100%;">continuar</button>
					</div>


					<?php
						}
					?>



				</div>

				<!--aqui vai o endereço-->

				<?php if(isset($_SESSION['clienteLogado'])) {?>
				<div class="panel">

					<?php
						if(isset($_SESSION['fretePedido'])){
					?>

					<div class="box-title">
						<h5 class="title-header-box">Entrega</h5>
						<p class="f11"> 
							Selecione uma forma de entrega.
						</p>
					</div>

					<hr>
					<ul class="list-group frete">
					<?php foreach($_SESSION['fretePedido'] as $frete){?>
					  	<li class="list-group-item frete-item" data-tipo="<?=$frete['SERVICO'];?>" data-valor="<?=$frete['VALOR'];?>"><strong><?=$frete['SERVICO'];?></strong> <span><?=$frete['VALOR'];?></span> 
					  		<a class="btn-frete" href="javascript:void(0);">Selecionar</a>
					  	</li>
					<?php 
						}
					?>
					</ul>
					<?php	
						}else {



					?>
					<div class="box-title">
						<h5 class="title-header-box">Entrega</h5>
						<p class="f11"> 
							Informe corretamente seu endereço de entrega, para que possamos
							calcular o frete.
						</p>
					</div>
					<div class="form-group w-100">
						<label class="text-label">CEP:</label>
						<input class="input-checkout" autofocus="true" placeholder="00000-000" type="tel" id="cepCliente">
					</div>
					<div class="form-group w-100">
						<label class="text-label">Endereço:</label>
						<input class="input-checkout" placeholder="Endereço" type="text" id="enderecoCliente">
					</div>
					<div> 
						<div class="form-group form-group-50" style="padding-right:5px;">
							<label class="text-label">Cidade:</label>
							<input class="input-checkout" placeholder="Cidade" type="text" id="cidadeCliente">
						</div>
						<div class="form-group form-group-50" style="padding-left:5px;">
							<label class="text-label">UF:</label>
							<input class="input-checkout" type="text" placeholder="Estado" id="ufCliente">
						</div>
					</div>
					<div> 
						<div class="form-group form-group-50" style="padding-right:5px;">
							<label class="text-label">Número:</label>
							<input class="input-checkout" placeholder="Número" type="text" id="numeroEnderecoCliente">
						</div>
						<div class="form-group form-group-50" style="padding-left:5px;">
							<label class="text-label">Referência:</label>
							<input class="input-checkout" type="text" placeholder="Ex: av. lisboa" id="referenciaEnderecoCliente">
						</div>
					</div>
					<div class="form-group w-100">
						<label class="text-label">Bairro:</label>
						<input class="input-checkout" placeholder="Endereço" type="text" id="bairroEnderecoCliente">
					</div>
					<div class="form-group w-100">
						<button class="btn btn-default btn-salvar-endereco" style="background:#33a86f;color:#fff;width:100%;">continuar</button>
					</div>
					<?php	
						}
					?>
				</div>
				<?php } ?>
			</div>

			<div class="col-md-4"> 
				<?php if(isset($_SESSION['enderecoCliente'])) {?>
				<div class="panel">
					<div class="box-title">
						<h5 class="title-header-box">Forma de Pagamento</h5>
						<p class="f11"> 
							Selecione uma das opções que deseja realizar o pagamento do pedido!
						</p>
					</div>


					<div class="form-group w-100">
						<label class="text-label">Número do Cartão:</label>
						<input class="input-checkout" autofocus="true" placeholder="0000.0000.0000.0000" type="text" id="numero-cartao">
					</div>
					<div class="form-group w-100">
						<label class="text-label">Nome Proprietário Cartão:</label>
						<input class="input-checkout" placeholder="Ex: Fulano de tal" type="text" id="nome-cartao">
					</div>

					<div> 
						<div class="form-group form-group-50" style="padding-right:5px;">
							<label class="text-label">Data Validade Cartão:</label>
							<input class="input-checkout" placeholder="Número" type="text" id="validade-cartao">
						</div>
						<div class="form-group form-group-50" style="padding-left:5px;">
							<label class="text-label">CVV:</label>
							<input class="input-checkout" type="text" placeholder="Código Segurança" id="cvv">
						</div>
					</div>

					<div class="form-group w-100">
						<label class="text-label">Parcelamento:</label>
						<select disabled class="form-control" id="parcelamento">
						</select>
					</div>
			
					<div class="form-group w-100">
						<label class="text-label">CPF Proprietário Cartão:</label>
						<input class="input-checkout" placeholder="CPF Proprietário Cartão" type="text" id="cpf-cartao">
					</div>
				</div>
				<?php } ?>
			</div>

			<div class="col-md-4"> 
				<div class="panel">
					<div class="box-title">
						<h5 class="title-header-box">Resumo da Compra</h5>
						<p class="f11"> 
							Os valores válidos são somente os do carrinho de compras!
						</p>
					</div>
					<hr>
					<table class="produtos">
						<tbody>
							<?php 
							$total = 0.00;
							foreach($this->cart->contents() as $produto) {
								$total+=(number_format($produto['price'],2,".",".") * $produto['qty']);
							?>

							<tr>
								<td class="imagem-quantidade">
									<img src="https://cdn.n49shop.com.br/n49shopv2_seuscabelos/resized/50x58/images/products/3539/5b77171b91193-neez-hair-spray-fixer-extra-forte-250ml_.jpg" alt="Neez Hair Spray Fixer Extra Forte 250ml" class="imagem thumbnail" width="50">
								</td>
								<td class="nome-preco">
									<p class="nome"><b><?=$produto['name']?></b>
										<small>Quantidade: <?=$produto['qty']?> item(ns)</small> 
									</p>
									<p class="preco" 
									data-preco="<?=number_format($produto['price'],2,".",".");?>">
									<?=number_format($produto['price'],2,",",".");?> 

									</p>
								</td>
							</tr>
							<?php }?>
						</tbody> 
					</table>
					<input type="hidden" id="total-amount" value="<?=$total;?>"/>
					<hr>
					<div class="form-group w-100">
						<button class="btn btn-default" id="finalizar-pedido" style="background:#33a86f;color:#fff;width:100%;">Finalizar Pedido</button>
					</div>
				</div>
			</div>

		</div>

	</div>
	
	<?php 

	//echo var_dump($_SESSION);

	?>
	
	<!-- Modal -->
	<div class="modal fade" id="modal-sucesso-pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content conteudo-sucesso-pedido">
	      <div class="modal-body">
	      	</br>
	        <p class="text-center" style="font-size:18px;">Pedido realizado com sucesso! Aguarde que estamos redirecionando ...</p>
	        <p class="text-center"><i class="far fa-check-circle fa-4x"></i></p>
	      </div>
	    </div>
	  </div>
	</div>
<?php //echo json_encode($_SESSION) ?>

	<div id="editarClienteModal" class="modal" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Editar Cadastro</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="contextoClienteEdicao">
	        	<div class="form-group w-100">
					<label class="text-label">Nome Completo:</label>
					<input class="input-checkout" autofocus="true" placeholder="Nome Completo" type="text" id="nomeCliente" value="<?=$dadosCliente->nome;?>">
				</div>
				<div class="form-group w-100">
					<label class="text-label">E-mail:</label>
					<input class="input-checkout" placeholder="Melhor E-mail" value="<?=$dadosCliente->email;?>" type="text" id="emailCliente">
				</div>
				<div> 
					<div class="form-group form-group-50" style="padding-right:5px;">
						<label class="text-label">Cpf:</label>
						<input class="input-checkout" placeholder="000.000.000-00" type="text" id="cpfCliente"
						value="<?=$dadosCliente->cpf;?>">
					</div>
					<div class="form-group form-group-50" style="padding-left:5px;">
						<label class="text-label">Telefone:</label>
						<input class="input-checkout" type="text" placeholder="(00) 00000-0000" id="telefoneCliente" value="<?=$dadosCliente->telefone;?>">
					</div>
				</div>
				
				<div class="form-group form-group-100" style="padding-right:5px;">
					<label class="text-label">Senha Antiga:</label>
					<input class="input-checkout" placeholder="************" type="password" id="senha">
				</div>
					
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" id="editarCliente">Salvar</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	      </div>
	    </div>
	  </div>
	</div>

	</body>
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="<?=base_url()?>/assets/js/jquery.mask.js"></script>
	<script src="<?=base_url()?>/assets/js/ui-block.js"></script>
	<script src="<?=base_url()?>/assets/js/block.js"></script>
	<!--pagseguro-->
	<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
	</script>

	<script> 

		const pagamento = new Pagamento();

		$(function(){

			//inicializa as maskaras
			pagamento.InicializarMascaras();

			$("#nomeCliente").focus();

			//busca cep

			$("[editarcliente]").on("click", function(){

				$("#editarClienteModal").modal({backdrop: 'static'},'show');

			});

			$("#editarCliente").on("click", function(){

				

			});

			$("#cepCliente").on("change", function(){

				pagamento.BuscarEndereco($(this).val());

			});

			$(".btn-salvar-cliente").on("click", function(){

				pagamento.SalvarCliente();

			});

			$(".btn-salvar-endereco").on("click", function(){

				pagamento.SalvarEndereco();

			});

			$("#finalizar-pedido").on("click", function(){

				pagamento.FinalizarPedido();

			});

			pagamento.InicializaPagseguro();

			$("#numero-cartao").on("blur", function(){

				let numCartao = $(this).val().replace(/\s/g,'');
				pagamento.BuscarParcelamento(numCartao);
			});

			$("#cvv").on("change", function(){
				pagamento.GerarTokenCartaoPagseguro();
			});

			$(document).on("click", ".btn-frete", function(){

				$(".frete-item").each(function(item, element){

					$(element).removeClass("active");
					$(element).removeClass("frete-selecionado");

				});

				$(this).closest(".frete-item").addClass("active");
				$(this).closest(".frete-item").addClass("frete-selecionado");

				//abre panel de pagamento
				$(".panel-pagamento").removeClass("hidden");
				$(".panel-pagamento").addClass("fadeIn").addClass("animated");
				$("html, body").animate({ scrollTop: $(document).height() }, 1000);
				$("#numero-cartao").focus();
			});

		});

		function Pagamento(){

			var self = this;


			self.BandeiraCartao = undefined;
			self.NumeroCartao = undefined;
			self.TokenCartao = undefined;

			self.InicializaPagseguro = function(){
				PagSeguroDirectPayment.setSessionId('<?=$tokenPagseguro;?>');
				self.BuscarMetodosPagamento();
			}
			self.BuscarMetodosPagamento = function(){
				PagSeguroDirectPayment.getPaymentMethods({
					success: function(response){

						if(response.error == false){

							let bandeirasCartaoCredito = response.paymentMethods.CREDIT_CARD.options;
							
							let optionsCartaoCredito = "";

							let urlCaminhoIcones= 'https://stc.pagseguro.uol.com.br/';

							for (var item in bandeirasCartaoCredito) {

							let objetoBandeira = bandeirasCartaoCredito[item];
								optionsCartaoCredito += "<img src='"+urlCaminhoIcones+objetoBandeira.images.SMALL.path+"' />";
							}
							$(".bandeiras").html(optionsCartaoCredito);
						}
		        	}
				});
			}
			self.BuscarParcelamento = function(numCartao){
				if(numCartao >= 6){

					let marcaCartao = undefined;

					let totalCompra = $("#total-amount").val();

					loading("Calculando!");

					self.NumeroCartao = numCartao;

					PagSeguroDirectPayment.getBrand({
						cardBin: numCartao,
						success: function(response){

							marcaCartao = response.brand.name;
							//busco o parcelamento do cartão
							self.BandeiraCartao = marcaCartao;

							PagSeguroDirectPayment.getInstallments({
								amount: totalCompra,
								brand: marcaCartao,
								success: function(response){
									if(response.error == false){
										console.log(response);
										let parcelamentos = response.installments[marcaCartao];

										let juros = "";
										let numeroParcelas="";
										$.each(parcelamentos,function(key, value){

					juros = value.interestFree == true ? 'S/ juros' : 'C/ juros';
					numeroParcelas += '<option value="'+value.quantity+'|'+value.installmentAmount+'">'+value.quantity+' x de '+ self.FormatarMoeda(value.installmentAmount) +' - Total: '+ self.FormatarMoeda(value.installmentAmount * value.quantity) +' '+ juros +'</option>';


										});
										console.log(numeroParcelas);
										//adiciona no parcelamento
										$("#parcelamento").prop("disabled", false);

										$("#parcelamento").html(numeroParcelas);
									}

								},
								error: function(response){
									alert("Cartão Inválido");
								}
							});
						},
						complete: function(){
							loaded();
						},
						error: function(response){
							alert("Cartão Inválido");
						}
					});
				}
			}

			self.FinalizarPedido = function(){
				if(self.ValidarPedido()){
					if($("#cartao-credito").hasClass("active")){
						self.PagamentoCartao();
					}else if($("#boleto").hasClass("active")){
						self.PagamentoBoleto();
					}else{
						//self.PagamentoDeposito();
						//deposito bancário
						//ideal é buscar do banco de dados o banco
						//e o restante dos dados
						self.PagamentoCartao();
					}
				}
			}

			self.PagamentoBoleto = function(){

				//fretes
				let tipoFrete = $(document).find(".frete-selecionado").data('tipo');
				let valorFrete = Number.parseFloat($(document).find(".frete-selecionado").data('valor').replace(",",".")).toFixed(2);

				$.ajax({
					method: "POST",
					url: '<?=base_url()?>index.php/checkout/finalizarPedidoBoleto',
					beforeSend: function(){
						loading("Concluindo pedido");
					},
					data: {
						tipoFrete: tipoFrete,
						vlrFrete: valorFrete
					},
					success: function(data){

						console.log(data);

						if(data.sucesso){
							$("#modal-sucesso-pedido").modal('show');
							setTimeout(function(){
								window.location.href='<?=base_url()?>index.php/checkout/sucesso?codigoPedido='+data.codigoPedido
							},1200);
						}
						console.log(data);
					},
					error: function(data){
						console.log(data);
					},
					complete: function(){
						loaded();
					}
				});

			}

			self.PagamentoCartao = function(){

				//debugger;

				//self.GerarTokenCartaoPagseguro();

				debugger;
				let qtdParcelamento= $("#parcelamento").val().split('|')[0];
				let vlrParcelamento= $("#parcelamento").val().split('|')[1];
				let nomeCartao = $("#nome-cartao").val();
				let cpfCartao = $("#cpf-cartao").val().replace(".","").replace(".","").replace(".","");

				//fretes
				let tipoFrete = $(document).find(".frete-selecionado").data('tipo');
				let valorFrete = Number.parseFloat($(document).find(".frete-selecionado").data('valor').replace(",",".")).toFixed(2);

				$.ajax({
					method: "POST",
					url: '<?=base_url()?>index.php/checkout/finalizarPedido',
					beforeSend: function(){
						loading("Concluindo pedido");
					},
					data: {
						tipFormaPagamento: "cartaocredito",
						qtdParcelamento:qtdParcelamento, 
						vlrParcelamento: vlrParcelamento,
						nomeCartao: nomeCartao,
						cpfCartao:cpfCartao,
						tipoFrete: tipoFrete,
						vlrFrete: valorFrete,
						tokenCartao: self.TokenCartao
					},
					success: function(data){
						if(data.sucesso){
							$("#modal-sucesso-pedido").modal('show');
							setTimeout(function(){
								window.location.href='<?=base_url()?>index.php/checkout/sucesso?codigoPedido='+data.codigoPedido
							},1200);
						}
						console.log(data);
					},
					error: function(data){
						console.log(data);
					},
					complete: function(){
						loaded();
					}
				});
			}

			self.GerarTokenCartaoPagseguro = function(){

				let codigoSeguranca = $("#cvv").val();
				let mesExpiracao = $("#validade-cartao").val().split('/')[0];
				let anoExpiracao = $("#validade-cartao").val().split('/')[1];

				PagSeguroDirectPayment.createCardToken({
					cardNumber: self.NumeroCartao,
					brand: self.BandeiraCartao,
					cvv: codigoSeguranca,
					expirationMonth: mesExpiracao,
					expirationYear: anoExpiracao,
					success: function(response){
						self.TokenCartao = response.card.token;

						//$(document).find("#token-cartao").val(response.card.token);
					},
					error: function(response){
						console.log(response);
					}
				});
			}


			self.ValidarPedido = function(){
				return true;
			}

			self.FormatarMoeda = function(int){
        		var valor = int.toFixed(2);
        		valor = valor.replace(".", ",");	       	
        		return "R$ "+ valor;
			}
			self.InicializarMascaras = function(){
				$("#cpfCliente, #cpf-cartao").mask('000.000.000-00', {reverse: true});
				$("#telefoneCliente").mask('(00) 00000-0000');
				$("#cepCliente").mask('00000-000');

				//cartao credito
				$("#numero-cartao").mask("0000 0000 0000 0000");
				$("#validade-cartao").mask('00/0000');
			}

			self.BuscarEndereco = function(cep){

				$.get("https://viacep.com.br/ws/"+cep.replace("-","")+"/json/", function(data){
						
					$("#cidadeCliente").val(data.localidade);
					$("#ufCliente").val(data.uf);
					$("#enderecoCliente").val(data.logradouro);
					$("#bairroEnderecoCliente").val(data.bairro);

				},'json');
			}

			self.SalvarCliente = function(){

				if(self.ValidarCliente()){
					$.ajax({
						method: "POST",
						url:"<?=base_url()?>index.php/checkout/SalvarClienteCheckout",
						data: {dadosCliente: self.MontarViewModelCliente()},
						beforeSend: function(){
							loading("Aguarde ...");
							console.log("enviando ...");
						},
						success: function(data){
							console.log(data);
							if(data.sucesso){
								location.reload();
							}
						},
						error: function(data){
							console.log(data);
						},
						complete: function(){
							loaded();
							//location.reload();
						}
					});
				}
			}

			self.SalvarEndereco = function(){
				if(self.ValidarEndereco()){
					$.ajax({
						method: "POST",
						url:"<?=base_url()?>index.php/checkout/SalvarEnderecoCheckout",
						data: {
							cep:$("#cepCliente").val(),
							logradouro:$("#enderecoCliente").val(),
							numeroEnderecoCliente: $("#numeroEnderecoCliente").val(),
							cidadeCliente: $("#cidadeCliente").val(),
							estadoCliente: $("#ufCliente").val(),
							bairroCliente: $("#bairroEnderecoCliente").val(),
							complementoEndereco: $("#referenciaEnderecoCliente").val(),
						},
						beforeSend: function(){
							loading("Aguarde ...");
							console.log("enviando ...");
						},
						success: function(data){
							console.log(data);
							if(data.sucesso){
								location.reload();
							}
						},
						error: function(data){
							console.log(data);
						},
						complete: function(){
							loaded();
							//location.reload();
						}
					});
				}
			}

			self.ValidarEndereco = function(){
				if($("#cepCliente").val() == ""){
					alert("Preencha campo CEP");
					$("#cepCliente").focus();
					return false;
				}
				else if($("#enderecoCliente").val() == ""){
					alert("Preencha campo Endereço");
					$("#enderecoCliente").focus();
					return false;
				}
				else if($("#numeroEnderecoCliente").val() == ""){
					alert("Preencha campo Número Endereço");
					$("#numeroEnderecoCliente").focus();
					return false;
				}
				else if($("#bairroEnderecoCliente").val() == ""){
					alert("Preencha campo Bairro");
					$("#bairroEnderecoCliente").focus();
					return false;
				}else{
					return true;
				}
			}

			self.ValidarCliente = function(){

				let cpf = $("#cpfCliente").val();
				if($("#emailCliente").val() == ""){
					alert("Preencha campo E-mail");
					$("#emailCliente").focus();
					return false;
				}else if($("#nomeCliente").val() == ""){
					alert("Preencha campo Nome Completo");
					$("#nomeCliente").focus();
					return false;
				}
				else if($("#cpfCliente").val() == "" || self.ValidarCpf(cpf.replace(".","").replace("-","").replace(".","")) == false){
					alert("Preencha campo Cpf");
					$("#cpfCliente").focus();
					return false;
				}
				else if($("#telefoneCliente").val() == ""){
					alert("Preencha campo Telefone");
					$("#telefoneCliente").focus();
					return false;
				}
				
				return true;
				
			}

			self.MontarViewModelCliente = function(){
				let objetoCliente = {
					//dados cliente
					nomeCliente: $("#nomeCliente").val(),
					cpfCliente: $("#cpfCliente").val(),
					telefoneCliente: $("#telefoneCliente").val(),
					emailCliente: $("#emailCliente").val(),					
					//dados endereço
					//cep: $("#cepCliente").val(),
					//logradouro: $("#enderecoCliente").val(),
					//numeroEnderecoCliente: $("#numeroEnderecoCliente").val(),
					//cidadeCliente: $("#cidadeCliente").val(),
					//estadoCliente: $("#ufCliente").val(),
					//bairroCliente: $("#bairroEnderecoCliente").val(),
					//complementoEndereco: $("#referenciaEnderecoCliente").val(),
				}
				return objetoCliente;
			}	

			//funcoes de validar cpf

			self.ValidarCpf = function(strCPF) {

				var Soma;
			    var Resto;
			    Soma = 0;
			  	if (strCPF == "00000000000") return false;
			     
			  	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
			  	Resto = (Soma * 10) % 11;
			   
			    if ((Resto == 10) || (Resto == 11))  Resto = 0;
			    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
			   
			  	Soma = 0;
			    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
			    Resto = (Soma * 10) % 11;
			   
			    if ((Resto == 10) || (Resto == 11))  Resto = 0;
			    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
			    return true;
			}
		}

		class GerenciamentoCheckout{

			constructor(){

			}

			editarCliente(){

				let cliente = {
					
				};

			}

		}

		const gerenciamento = new GerenciamentoCheckout();
	</script>
</body>
</html>
