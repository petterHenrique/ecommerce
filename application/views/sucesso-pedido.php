<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="pt-br">
<head>
  <title>Pedido Realizado - Nome Loja</title>
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <base href="" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="<?=base_url()?>assets/css/dashboard.css"/>
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
  	.panel-sucesso{
  		padding:20px;
  	}
  	.title-sucesso{
  		font-size:28px;
  	}
  	.box-numero-pedido{
  		color:#fff;
  		padding:20px;
  		border-radius:10px;
  		background:#1c7ed6;
  	}
  </style>
</head>
	<header class="container header-checkout">
		<div class="row">
			<div class="col"> 
				<h2 class="text-center" style="font-size:14px;">LOGO LOJA</h2>
			</div>
			<div class="col"> 
				<img class="float-right" src="<?=base_url()?>assets/images/selos/ambiente-seguro.png" title="Ambiente Seguro" title="Ambiente Seguro"/>
			</div>
		</div>
	</header>

	<div class="container">
		<div class="row"> 
			<div class="col-12 col-md-8 col-sm-8 col-lg-8 panel-sucesso"> 
				<p class="text-success"><i class="far fa-thumbs-up fa-4x"></i> <span class="title-sucesso">Compra efetuada com sucesso!</span></p>

				<p>Um e-mail foi enviado para <b><?=$cliente['EMAIL']?></b> contendo os itens de envio do pedido!</p>



			</div>
			<div class="col-12 col-md-4 col-sm-4 col-lg-4 panel-sucesso"> 
				<div class="box-numero-pedido"> 
					<h4 class="text-center">Número do Pedido</h4>
					<h2 class="text-center">#<?=$codigoPedido;?></h2>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="col-12 col-md-6 col-sm-6 col-lg-6 panel-sucesso"> 
				<div style="background:#ebebeb;border-radius:4px;padding:14px;"> 
					<p> 
					A entrega de seu pedido está prevista para ser realizada em até 1 dias úteis após a confirmação do pagamento (que normalmente acontece em 1 dia útil para operações autorizadas na primeira tentativa).
					Fique atento, finais de semana e feriados não entram no cálculo dos prazos acima.
					</p>
				</div>
			</div>

			<div class="col-12 col-md-6 col-sm-6 col-lg-6 panel-sucesso"> 
				<div style="border:1px solid #ebebeb;border-radius:4px;padding:10px;"> 
					<p> 
					Forma de pagamento : <?=(bool)$pagamento['TIP_BOLETO'] == true ? "Boleto" : "Cartão Crédito"; ?>&nbsp;
					</p>
					<p> 
						<?php 
						if((bool)$pagamento['TIP_BOLETO']){ ?>

						<i style="color:#1c7ed6;" class="fas fa-2x fa-newspaper"></i>
						<a style="text-decoration:none;color:#1c7ed6;" href="<?=$pagamento['BOLETO']?>" target="_blank">
						Imprimir Boleto
						</a>
						<?php 
						} else {
							echo '<i class="far fa-2x fa-credit-card"></i>';
						}
					?>
					</p>
					<p> 
					<?=$pagamento['OBSERVACOES'];?>
					</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-4 panel-sucesso"> 
				<h6><i class="fas fa-user"></i> Informações do Cliente</h6>
				<p>
					<?=$cliente['NOME']?>, 
					<?=$cliente['CPF']?></br>
					<?=$cliente['EMAIL']?></br>
					<?=$cliente['TELEFONE']?>  <?=$cliente['CELULAR']?>

				</p>
			
			</div>

			<div class="col-4 panel-sucesso"> 
				<h6><i class="fas fa-map-marker-alt"></i> Endereço de Entrega</h6>
				<p>
					<?=$enderecoEntrega['RUA']?>, 
					<?=$enderecoEntrega['NUMERO']?></br>
					<?=$enderecoEntrega['BAIRRO']?>, 
					<?=$enderecoEntrega['CIDADE']?> - <?=$enderecoEntrega['ESTADO']?></br>
					Complemento <?=$enderecoEntrega['COMPLEMENTO']?>

				</p>
			
			</div>
			

			<div class="col-4 panel-sucesso"> 
				<h6><i class="fas fa-shipping-fast"></i> Informações do Frete</h6>
				<p>
					Tipo Frete: <?=$frete['TIP_FRETE']?></br>
					Valor: R$ <?=$frete['VLR_FRETE']?></br>
					Prazo Entrega: <?=$frete['PRAZO']?></br>

				</p>
			
			</div>
<?php 

echo var_dump($pagamento);

?>
		</div>
		<div class="row">
			<div class="col-12 panel-sucesso">
				<table class="table">
				  <thead>
				    <tr>
				      <th scope="col">Nome</th>
				      <th scope="col">Quantidade</th>
				      <th scope="col">SubTotal</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  		foreach ($itens as $item) {
				  	?>
					<tr>
				      <td><?=$item['NOME_PRODUTO']?></td>
				      <td><?=$item['QTD_PRODUTO']?></td>
				      <td><?=$item['VLR_TOTAL']?></td>
				    </tr>
				  	<?php 
				  		}
				  	?>
				  </tbody>
				</table>
				<hr>
			</div>
			<div class="col-12">
				<div class="text-center">
					<h6>Frete: R$ <?=$frete['VLR_FRETE']?></h6>
					<h6 >Total do pedido: R$ <?=$valorTotalPedido?></h6>
					</br>
					<button class="btn btn-success" onclick="window.location.href='<?=base_url()?>'">Voltar a página inicial</button>
					</br>
				</div>
					</br>
			</div>
		</div>
	</div>


	
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="<?=base_url()?>/assets/js/ui-block.js"></script>
	<script src="<?=base_url()?>/assets/js/block.js"></script>

</body>
</html>
