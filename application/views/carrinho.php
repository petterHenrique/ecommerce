<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html>
<head>
  <title>Carrinho de Compras - Nome Loja</title>
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <base href="" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <link rel="stylesheet" href="<?=base_url()?>assets/css/pnotify.custom.min.css"/>

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
  	h2{
  		font-family: 'Poppins', sans-serif;
  	}
  	.quantity {
    float: left;
    margin-right: 15px;
    background-color: #eee;
    position: relative;
    width: 80px;
    overflow: hidden
}

.quantity input {
    margin: 0;
    text-align: center;
    width: 15px;
    height: 15px;
    padding: 0;
    float: right;
    color: #000;
    font-size: 20px;
    border: 0;
    outline: 0;
    background-color: #F6F6F6
}

.quantity input.qtd {
    position: relative;
    border: 0;
    width: 100%;
    height: 40px;
    padding: 10px 25px 10px 10px;
    text-align: center;
    font-weight: 400;
    font-size: 15px;
    border-radius: 0;
    background-clip: padding-box
}

.quantity .minus, .quantity .plus {
    line-height: 0;
    background-clip: padding-box;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    -webkit-background-size: 6px 30px;
    -moz-background-size: 6px 30px;
    color: #bbb;
    font-size: 20px;
    position: absolute;
    height: 50%;
    border: 0;
    right: 0;
    padding: 0;
    width: 25px;
    z-index: 1;
}

.quantity .minus:hover, .quantity .plus:hover {
    background-color: #dad8da
}

.quantity .minus {
    bottom: 0
}
.shopping-cart {
    margin-top: 20px;
}
.btn-finalizar-compra{
	width: 280px;
	padding:4px;
	font-size:20px;
}
.btn-mais, .btn-menos{
	z-index: 0000;
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
	</br>
	<div class="container">
	    
	<?php if(count($produtos) > 0) { ?>

	    <div class="card shopping-cart">
	    	<?php //echo var_dump($produtos);?>
            <div class="card-body">
                    <!-- PRODUCT -->
                    <?php 

                    $total = 0.00;

                    foreach($produtos as $produto) { ?>
                    <div style="padding:10px; box-shadow:0px 0px 5px #ccc;">
	                    <div class="row linha-produto" data-row="<?=$produto['rowid']?>" data-codigoproduto="<?=$produto['id']?>">
	                        <div class="col-12 col-sm-12 col-md-2 text-center">
	                                <img class="img-responsive" src="<?=$produto['options']['img']?>" alt="" width="120" height="80">
	                        </div>
	                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
	                            <h4 class="product-name"><strong><?=$produto['name']?></strong></h4>
	                         
	                        </div>
	                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
	                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
	                             	<h6>R$ <strong><?=number_format($produto['price'], 2, ',', '.')?></strong> </h6>
	                            </div>
	                            <div class="col-4 col-sm-4 col-md-4">
	                                <div class="quantity">
	                                    <input type="button" value="+" class="plus btn-mais">
	                                    <input type="text" step="1" max="99" min="1" value="<?=$produto['qty']?>" title="Qty" class="qtd"
	                                           size="4">
	                                    <input type="button" value="-" class="minus btn-menos">
	                                </div>
	                            </div>
	                            <div class="col-2 col-sm-2 col-md-2 text-right">
	                                <button type="button" class="btn btn-outline-danger btn-remover btn-xs">
	                                    <i class="fa fa-trash" aria-hidden="true"></i>
	                                </button>
	                            </div>
	                        </div>
	                    </div>
                    </div>
                    <?php 
                    	
                    	 $total+=number_format((float)$produto['subtotal'], 2, '.', '');

                    } 
                    ?>
            </div>
            <div class="card-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                        	<div class="input-group float-right">
                            	<input type="text" class="form-control" placeholder="Informe seu código do cupom" aria-label="Input group example" aria-describedby="btnGroupAddon">
							    <div class="input-group-prepend" style="cursor:pointer;">
							      	<div class="input-group-text" style="width:140px;" id="btnGroupAddon">Aplicar Cupom</div>
							    </div>
							</div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    	<div class="col-md-6 col-sm-6 col-12">
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                        	<div class="input-group float-right">
                            	<input type="text" class="form-control" id="cepCarrinhoDestino" placeholder="Informe seu CEP" aria-label="Input group example" aria-describedby="btnGroupAddon">
							    <div class="input-group-prepend" style="cursor:pointer;">
							      	<div class="input-group-text" style="width:140px;" id="btnGroupAddon">Calcular Frete</div>
							    </div>
							</div>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                    	<div class="col-md-6 col-sm-6 col-12">
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                        	<div class="resumo-total-compra float-right">
                        	<p class="text-right">Valor Frete: <b>R$ 0,00</b></br>
                        	Valor Desconto: <b>R$ 0,00</b></br>
                        	Subtotal: <b class="vlr-total-produtos">R$ <?=number_format((float)$total, 2, ',', '');?></b></br>
                        	Total: <b class="vlr-total-produtos">R$ <?=number_format((float)$total, 2, ',', '');?></b></p>
                        	</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        	<button class="btn btn-success btn-finalizar-compra float-right">Finalizar Compra</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <?php } else { ?>
		<div style="padding:20px;">
			<h1 class="text-center">Oopss</h1>
        	</br>
        	<h2 class="text-center">Seu carrinho de compras está vazio!</h2>
        	</br>
        	<h4 class="text-center">Clique no botão abaixo e continue suas compras :)</h4>
        	</br>
        	<center> 
        	<button onclick="window.location.href='<?=base_url()?>'" style="margin:0 auto;" class="btn btn-primary text-center">Continuar Comprando !</button>
        	</center>
		</div>
        <?php } ?>
	</div>
	</br>
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

	
<body>
	<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="<?=base_url()?>/assets/js/pnotify.custom.min.js"></script>
	<script src="<?=base_url()?>/assets/js/jquery.mask.js"></script>
	<script src="<?=base_url()?>/assets/js/ui-block.js"></script>
	<script src="<?=base_url()?>/assets/js/block.js"></script>
	<script src="<?=base_url()?>/assets/js/notificacao.js"></script>
  	<script>
  		const carrinho = new CarrinhoCompras();

  		$(function(){
  			
  			carrinho.AplicarMascaras();

  			$("#cepCarrinhoDestino").on('keypress', function(event){

  				if(event.keyCode == 13){
  					carrinho.CalcularFrete($(this).val());
  				}

  			});

  			$(".btn-mais").on("click", function(){

  				//loading();

  				let elementoQtd = $(this).closest('.quantity').find(".qtd");
  				let totalAtual = Number.parseInt(elementoQtd.val()) + 1;
  				let rowId = $(this).closest('.linha-produto').data('row');
  				let codigoProduto = $(this).closest('.linha-produto').data('codigoproduto');

  				elementoQtd.val(totalAtual);
  				carrinho.AtualizarCarrinho(rowId, totalAtual, codigoProduto);

  				//atualiza os valores do carrinho 

  				setTimeout(function(){
  					carrinho.AtualizarTotalizadoresValores();
  				},200);

  			});

  			$(".btn-menos").on("click", function(){

  				//loading();

  				let elementoQtd = $(this).closest('.quantity').find(".qtd");
  				let totalAtual = Number.parseInt(elementoQtd.val()) - 1;
  				let rowId = $(this).closest('.linha-produto').data('row');
  				let codigoProduto = $(this).closest('.linha-produto').data('codigoproduto');

  				if(totalAtual == 0){
  					totalAtual = 1;
  				}

  				elementoQtd.val(totalAtual);
  				carrinho.AtualizarCarrinho(rowId, totalAtual, codigoProduto);

  				setTimeout(function(){
  					carrinho.AtualizarTotalizadoresValores();
  				},200);

  			});

  			$(".btn-remover").on("click", function(){
  				let rowId = $(this).closest(".linha-produto").data('row');
  				carrinho.RemoverItemCarrinho(rowId);
  			});

  			//finalizar a compra
  			$(".btn-finalizar-compra").on("click", function(){

  				$(this).text("");
  				$(this).append('<i class="fas fa-spinner fa-lg fa-spin fa-lgshutdown -s -t 10"></i>');

  				carrinho.ValidarCarrinhoCompras();
  			});
  		});

  		function CarrinhoCompras(){

  			var self = this;

  			self.AplicarMascaras = function(){
  				$("#cepCarrinhoDestino").mask("99999-999");
  			}

  			self.AtualizarCarrinho = function(rowId, qtd, codigoProduto){

  				$.ajax({
  					url: "<?=base_url()?>/index.php/carrinho/atualizarCarrinho",
  					method: "POST",
  					dataType: 'json',
  					data: {rowId : rowId, qtd: qtd, codigoProduto: codigoProduto},
  					success: function(response){
  						
  					},
  					error: function(response){
  						let total = $(".qtd").val() - 1;
  						$(".qtd").val(total);

  						console.log(response);
  						alertas.AlertaErro("Atenção", response.responseJSON.error);
  					}
  				});
  			}

  			self.RemoverItemCarrinho = function(rowId){

  				let linhaExclusao = rowId;
  				
  				$.post("<?=base_url()?>index.php/carrinho/removerItemCarrinho", { rowId : rowId}, function(response){
  					if(response.sucesso){

  						$(document).find("[data-row='"+linhaExclusao+"']").fadeOut(500, function(){
  							$(this).remove();
  						});
  						
  						if($(".linha-produto").size() == 1){
  							window.location.reload();
  						}

  					}
  				},'json');


  			}

  			self.CalcularFrete = function(cep){
  				$.post("<?=base_url()?>index.php/carrinho/calcularFrete",
  					{
  						cep: cep.replace("-","")
  					}
  				,function(reponse){
  					console.log(response);
  				},'json');
  			}

  			self.AtualizarTotalizadoresValores = function(){

  				$.ajax({
  					url: "<?=base_url()?>index.php/carrinho/calcularCarrinhoCompras",
  					method: "POST",
  					data: {},
  					dataType: 'json',
  					beforeSend: function(){
  						//loading("Atualizando");
  					},
  					success: function(response){
  						console.log("resultado");
  						console.log(response);
  						$(document).find(".vlr-total-produtos").text(response.totalProdutos);
  					},
  					error: function(response){
  						console.log(response);
  					},
  					complete: function(){
  						//loaded();
  					}
  				});
  			}
  			
  			self.ValidarCarrinhoCompras = function(){
  				
  				let validar = true;

  				if(validar){
  					window.location.href='<?=base_url()?>index.php/checkout';
  				}
  			}
  		}
  	</script>
</body>
</html>
