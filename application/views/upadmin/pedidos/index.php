<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php require APPPATH . 'views/upadmin/inc/header.php'; ?>
</head>
<body>
<div class="page">
    <div class="page-main">

        <?php $this->load->view('upadmin/layout/navbar.php');?>

        <div class="my-3 my-md-5">
            <div class="container">
                <div class="my-3 mx-0">
                    <ul class="breadcrumb w-100 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/dashboard/index">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="<?=base_url()?>index.php/pedidosAdmin/index">Pedidos</a>
                        </li>
                    </ul>
                    <h2>Pedidos</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input type="text" class="form-control dados-pesquisa" placeholder="Pesquisar...">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-pesquisar">
                                    <span class="fa fa-search"></span>&nbsp; Buscar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        </br>

                    	<!--button class="btn btn-default pull-right" onclick="window.location.href='<?=base_url()?>index.php/produtosAdmin/criar'"><i class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar</button-->

                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                    <thead>
                                    <tr>
                                        <th class="text-center w-1">N° Pedido</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th class="text-center">Pagamento</th>
                                        <th>Atividade</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center"><i class="icon-settings"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>javascript:void(0)
                                    <?php 
                                    	foreach ($pedidos as $pedido) { 
                                    ?>
                        			
                                    <tr>
                                        <td class="text-center">
                                            <?=$pedido['CODIGO_PEDIDO']?>
                                        </td>
                                        <td>
                                            <a href="<?=base_url()?>index.php/pedidosAdmin/detalhe?id=<?=$pedido['COD_PEDIDO']?>"><?=$pedido['NOME_CLIENTE']?></a>
                                        </td>
                                        <td>
        									R$ 
        									<?php 

        									$qtd = (int)$pedido['QTD_PRODUTO'];
        									$vlrProduto = number_format($pedido['VLR_PRODUTO'], 2, '.', ' ');

       										$resultado = $qtd * $vlrProduto;
        									echo number_format($resultado, 2, ',', ' ');
        									?>
        					
                                        </td>
                                        <td class="text-center">

                                        <?php 
                                     
                                        	if($pedido['FORMA_PAGAMENTO'] == "PAGSEGUROCARTAO"){
                                        		echo '<i class="payment payment-visa"></i>';
                                        	}else {
                                        		echo '<i class="payment payment-boleto2"></i>';
                                        	}
                                        ?>

                                            
                                        </td>
                                        <td>
                                            <div class="small text-muted">Registrado</div>
                                            <div><?=date("d/m/Y", strtotime($pedido['DTA_CRIACAO_PEDIDO']));?></div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success"><?=$pedido['DES_STATUS']?></span>
                                        </td>
                                        <td class="text-center">
                                            <div class="item-action dropdown">
                                                <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?=base_url()?>index.php/pedidosAdmin/detalhe?id=<?=$pedido['COD_PEDIDO']?>" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detalhes </a>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Alterar Status </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php 
                                		}
                                    ?>
                                    </tbody>
                                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
	 <?php $this->load->view('upadmin/inc/footer');?>
	 <script>
	 	$(function(){
	 		$(".btn-pesquisar").on("click", function(){
	 			let btnPesquisar = $(".btn-pesquisar");
	 			btnPesquisar.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
	 			let valorPesquisa = $(".dados-pesquisa").val();
	 			$.ajax({
 					method:"POST",
 					url: "<?=base_url()?>/index.php/categoriasadmin/pesquisarCategoria",
 					data:{ dados: valorPesquisa},
 					beforeSend: function(){
 						
 					},
 					success: function(data){
 						$(".dados-item").html(data);
 					},
 					error: function(data){
 						console.log(data);
 						alertas.AlertaErro("Atenção!", data);
 					},
 					complete: function(){
 						setTimeout(function(){
							btnPesquisar.html('<span class="fa fa-search"></span>&nbsp; Buscar');
 						},800);
 					}
 				});
	 		});

	 		$(".btn-remover").on("click", function(){
	 			let codigoExclusao = $(this).closest("tr").data("codigo"); 
	 			alertas.Confirmar("Atenção", "Deseja remover esta categoria?", function(){
	 				$.ajax({
	 					method:"POST",
	 					url: "<?=base_url()?>/index.php/categoriasadmin/excluirCategoria",
	 					data:{ id: codigoExclusao},
	 					beforeSend: function(data){	 						
	 					},
	 					success: function(data){
	 						alertas.AlertaSucesso("Sucesso!", data.success);
 							$("tr[data-codigo="+codigoExclusao+"]").fadeOut(500, function(){
	 							$(this).remove();
	 						});
	 					},
	 					error: function(data){
	 						alertas.AlertaErro("Sucesso!", data.error);
	 					},
	 					complete: function(){
	 					}
	 				});
	 			});
	 		});
	 	});
	 </script>
</html>