<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<?php require APPPATH . 'views/upadmin/inc/header.php'; ?>
</head>
<body>
    <div id="wrapper">
        <?php $this->load->view('upadmin/inc/menu');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="page-header text-primary">Produtos</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
               		<div class="input-group">
					  <input type="text" class="form-control dados-pesquisa" placeholder="Pesquisar">
					  <span style="border:1px solid #337AB7; cursor:pointer;background:#337AB7;color:white;" class="input-group-addon btn-pesquisar">Buscar</span>
					</div>
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
            <hr>
            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12">
            		<button class="btn btn-default pull-right" onclick="window.location.href='<?=base_url()?>index.php/produtosAdmin/criar'"><i class="fa fa-plus-circle" aria-hidden="true"></i>
 Adicionar</button>
            		<table class="table table-striped">
					    <thead>
					      <tr>
					        <th class="hidden">Código</th>
					        <th>Nome</th>
					        <th>Status</th>
					        <th class="text-right">Ações</th>
					      </tr>
					    </thead>
					    <tbody class="dados-item">
					      <?php foreach ($produtos as $item) { ?>
						      <tr data-codigo="<?=$item['COD_PRODUTO']?>">
						        <td class="hidden"><?=$item['COD_PRODUTO']?></td>
						        <td><a href="<?=base_url()?>/index.php/produtosAdmin/editar?id=<?=$item['COD_PRODUTO']?>" class="text-primary"><?=$item['NOME_PRODUTO']?></a></td>
						        <td>
						        <?php 
						        	echo (bool)$item['TIP_ATIVO'] == true ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
						        ?>
						        </td>
						        <td class="text-right"><i onclick="window.location.href='<?=base_url()?>/index.php/produtosAdmin/editar?id=<?=$item['COD_PRODUTO']?>'" style="cursor:pointer;"  class="fa fa-pencil text-primary btn-editar" aria-hidden="true"></i> / <i style="cursor:pointer;" class="fa fa-trash-o text-danger btn-remover" aria-hidden="true"></i></td>
						      </tr>
					      <?php	} ?>
					    </tbody>
					</table>
            	</div>
            </div>
        </div>
        <!-- /#page-wrapper -->
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
							btnPesquisar.html('Buscar');
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