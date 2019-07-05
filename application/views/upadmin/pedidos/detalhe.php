<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php $this->load->view('upadmin/inc/header');?>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<style>
/*CUSTOM PAGINA PRODUTO*/
.panel-produto{
    background: #fff;
    padding:20px;
    border:1px solid #dadada;
}
</style>
<body>


<div class="page">
    <div class="page-main" id="pedido-impressao">

        <?php $this->load->view('upadmin/layout/navbar.php');?>

        <div class="my-3 my-md-5">
            <div class="container">
                <div class="my-3 mx-0">
                    <ul class="breadcrumb w-100">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/dashboard/index">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/pedidosAdmin/index">Pedidos</a>
                        </li>
                        <li class="breadcrumb-item active">Detalhe</li>
                    </ul>
                </div>

                <!-- ações -->
                <div class="row"> 
                	<div class="col-12"> 
                		<div class="pull-right"> 
                			<button id="imprimir-pedido" class="btn btn-default"> 
	                			<i class="fa fa-print" aria-hidden="true"></i>
	                			Imprimir
	                		</button>

	                		<button class="btn btn-default"> 
	                			<i class="fa fa-hand-o-up" aria-hidden="true"></i>
	                			Alterar Status
	                		</button>

	                		<button class="btn btn-default"> 
	                			<i class="fa fa-file-o" aria-hidden="true"></i>
	                			Emitir NF-e
	                		</button>
                		</div>
                	</div>
                </div>


                </br>

                <div class="row">

                	<!--Dados do Cliente-->
	                <div class="col-4">
	                	<div class="panel-produto"> 
	                		<h3 class="text-primary">Dados do Cliente</h3>
			                <input type="hidden" id="codigo-cliente" value=" <?=$cliente['COD_CLIENTE']?>"/>
			                <p><b>Nome:</b> <?=$cliente['NOME']?></p>
			                <p><b>E-mail:</b> <?=$cliente['EMAIL']?></p>
			                <p><b>Telefone:</b> <?=$cliente['TELEFONE']?></p>
			                <p><b>Celular:</b> <?=$cliente['CELULAR']?></p>
			                <p><b>CPF:</b> <?=$cliente['CPF']?></p>
	                	</div>
	                </div>

                  	<!--Dados de Entrega-->
                  	<div class="col-4">
	                	<div class="panel-produto"> 
	                		<h3 class="text-primary">Endereço de Entrega</h3>
			                <p><b>CEP:</b> <?=$enderecoEntrega['CEP']?></p>
			                <p><b>Rua:</b> <?=$enderecoEntrega['RUA']?></p>
			                <p><b>Bairro:</b> <?=$enderecoEntrega['BAIRRO']?>, <?=$enderecoEntrega['NUMERO']?></p>
			                <p><b>Cidade:</b> <?=$enderecoEntrega['CIDADE']?> - <?=$enderecoEntrega['ESTADO']?></p>
			                <p><b>Complemento:</b> <?=$enderecoEntrega['COMPLEMENTO']?></p>
	                	</div>
	                </div>
	              
                    <!--Dados de Pagemento-->
                  	<div class="col-4">
	                	<div class="panel-produto"> 
	                		<h3 class="text-primary">Dados de Pagamento</h3>
	                		<?php 
	                			if(!empty($pagamento)){
                			?>
								<p><b>Códig Transação:</b> <?=$pagamento['CODIGO_TRANSACAO']?></p>
				                <p><b>Origem:</b> <?=$pagamento['NOME_PAGAMENTO']?></p>
	                		<?php
		                		}else{?>
		                		<h4 class="text-left">Nenhum registro encontrado!</h4>
		                	<?php	
		                		}
	                		?>
			               
	                	</div>
	                </div>

                  
                </div>

                <!-- itens do pedido -->
                <hr>

                <div class="row">
                	<div class="col-8">
                		<div class="panel-produto"> 
                			<h3 class="text-primary">Itens do Pedido</h3>
                			<table class="table">
							    <thead>
							      <tr>
							        <th>SKU</th>
							        <th>Nome</th>
							        <th>Valor</th>
							        <th>QTD</th>
							        <th>TOTAL</th>
							      </tr>
							    </thead>
							    <tbody>
							    	<?php 
							    	foreach ($itens as $item) {
							    	 ?>
							    	<tr>
								        <td><?=$item['SKU_PRODUTO']?></td>
								        <td><?=$item['NOME_PRODUTO']?></td>
								        <td><?=$item['VLR_PRODUTO']?></td>
								        <td><?=$item['QTD_PRODUTO']?></td>
								        <td><span class="text-success">R$ <?=$item['VLR_TOTAL']?></span></td>
								    </tr>
							    	<?php 
							    		}
							    	?>
							    </tbody>
							</table>
                		</div>
                	</div>
                	<div class="col-4">
                		<div class="panel-produto"> 
                			<h1>R$ 5000,00</h1>
                		</div>
                	</div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
    <?php $this->load->view('upadmin/inc/footer');?>

    <script src="<?=base_url()?>assets/js/printThis.js"></script>
	<script>
		$("#imprimir-pedido").on("click", function(){
			
		});
	</script>
</html>