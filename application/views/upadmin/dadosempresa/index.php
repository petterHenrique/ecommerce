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
                        <li class="breadcrumb-item active">Dados Empresa</li>
                    </ul>
                </div>
                <form>
                	<input type="hidden" id="codigo" value="<?=$dados['COD_DADO']?>"/>
                	<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">E-mail:</label>
						<input type="text" class="form-control" value="<?=$dados['DES_EMAIL']?>" id="email" aria-describedby="emailHelp" placeholder="Informe o seu e-mail">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Telefone:</label>
						<input type="text" class="form-control" value="<?=$dados['DES_TELEFONE']?>" id="telefone" aria-describedby="emailHelp" placeholder="Informe o seu telefone">
					</div>
				  	<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">WhatsApp:</label>
						<input type="text" class="form-control" value="<?=$dados['DES_WHATSAPP']?>" id="whats" aria-describedby="emailHelp" placeholder="Informe o seu WhatsApp">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Horário de Atendimento:</label>
						<input type="text" class="form-control" value="<?=$dados['DES_HORARIO']?>" id="horario" aria-describedby="emailHelp" placeholder="Informe o seu horário de atendimento">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Facebook:</label>
						<input type="text" class="form-control" value="<?=$dados['DES_FACEBOOK']?>" id="facebook" aria-describedby="emailHelp" placeholder="Informe o seu facebook">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Instagram:</label>
						<input type="text" class="form-control" value="<?=$dados['DES_INSTAGRAM']?>" id="instagram" aria-describedby="emailHelp" placeholder="Informe o seu instagram">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					  	<label for="comment">Descrição Empresa Rodapé:</label>
					  	<textarea class="form-control" rows="5" id="descricao-rodape"><?=$dados['DES_RODAPE']?></textarea>
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Title (Descrição da loja para otimização em busca): </label>
						<input type="text" value="<?=$dados['DES_TITLE']?>" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Nome da loja com detalhes">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Keywords (Palavras chaves para encontrar a loja ex: especilidades, consultoria ...): </label>
						<input type="text" class="form-control" value="<?=$dados['DES_KEYWORDS']?>" id="keywords" aria-describedby="emailHelp" placeholder="Palavras chave">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					  	<label for="comment">Descrição Empresa (Otimização de busca SEO):</label>
					  	<textarea class="form-control" rows="5" id="description"><?=$dados['DES_DESCRIPTION']?></textarea>
					</div>
				  	<button type="button" class="btn btn-success btn-salvar">Salvar Dados</button>
				</form>
            </div>
        </div>
    </div>
</div>

</body>
	 <?php $this->load->view('upadmin/inc/footer');?>
	 <script>
	 	$(function(){
	 		$(".btn-salvar").on("click", function(){
	 			if(Validar()){
	 				$.ajax({
	 					method:"POST",
	 					url: "<?=base_url()?>/index.php/dadosEmpresaAdmin/salvar",
	 					data: { 
	 						codigo: $("#codigo").val(),
	 						email: $("#email").val(),
	 						telefone: $("#telefone").val(),
	 						whats: $("#whats").val(),
	 						horario: $("#horario").val(),
	 						facebook: $("#facebook").val(),
	 						instagram: $("#instagram").val(),
	 						descricaoRodape: $("#descricao-rodape").val(),
	 						title: $("#title").val(),
	 						keywords: $("#keywords").val(),
	 						description: $("#description").val(),
	 					},
	 					beforeSend: function(){
	 						
	 					},
	 					success: function(data){
	 						alertas.AlertaSucesso("Sucesso", "Dados Atualizados!");
	 					},
	 					error: function(data){
	 						alertas.AlertaErro("Atenção!", data);
	 					},
	 					complete: function(){
	 						setTimeout(function(){
								btnPesquisar.html('<span class="fa fa-search"></span>&nbsp; Buscar');
	 						},800);
	 					}
	 				});
	 			}
	 		});
	 	});

	 	function Validar(){
	 		return true;
	 	}
	 </script>
</html>