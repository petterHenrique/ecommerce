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
                        <li class="breadcrumb-item active">Categorias</li>
                    </ul>
                    <h2>Categorias</h2>
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
                        <a href="/index.php/categoriasAdmin/criar" class="btn btn-default my-4">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp; Adicionar
                        </a>
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
                            <?php foreach ($categorias as $item) { ?>
                                <tr data-codigo="<?=$item['COD_CATEGORIA']?>">
                                    <td class="hidden"><?=$item['COD_CATEGORIA']?></td>
                                    <td><a href="<?=base_url()?>/index.php/categoriasAdmin/editar?id=<?=$item['COD_CATEGORIA']?>" class="text-primary"><?=$item['NOME_CATEGORIA']?></a></td>
                                    <td>
                                        <?php
                                        echo (bool)$item['TIP_ATIVO'] == true ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
                                        ?>
                                    </td>
                                    <td class="text-right"><i onclick="window.location.href='<?=base_url()?>/index.php/categoriasAdmin/editar?id=<?=$item['COD_CATEGORIA']?>'" style="cursor:pointer;"  class="fa fa-pencil text-primary btn-editar" aria-hidden="true"></i> / <i style="cursor:pointer;" class="fa fa-trash-o text-danger btn-remover" aria-hidden="true"></i></td>
                                </tr>
                            <?php	} ?>
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