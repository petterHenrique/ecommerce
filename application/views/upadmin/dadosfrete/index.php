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
                        <li class="breadcrumb-item active">Dados Frete</li>
                    </ul>
                </div>

				<?php
				 	$dados = empty($dadosFrete) ? array() : $dadosFrete[0];
				 ?>

				 <div class="row"> 
				 	<div class="col-md-12"> 
				 		<p style="padding:20px;background:white;">Preencha os campos de acordo com o seu contrato dos CORREIOS caso possua, caso contrário
				 	preencha somente o campo CEP Origem</p>
					</div>
				 </div>

				<div class="row">
              
                	<input type="hidden" id="codigo" value="<?=$dados['COD_CONFIG']?>"/>
                	<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">CEP Origem:</label>
						<input type="text" class="form-control" value="<?=$dados['CEP_ORIGEM']?>" id="cep" aria-describedby="emailHelp" placeholder="Preencha seu CEP origem">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Código contrato:</label>
						<input type="text" class="form-control" value="<?=$dados['COD_CONTRATO']?>" id="contrato" aria-describedby="emailHelp" placeholder="Informe o código de seu contrato caso possua">
					</div>
				  	<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Senha Contrato:</label>
						<input type="text" class="form-control" value="<?=$dados['SENHA_CONTRATO']?>" id="senhacontrato" aria-describedby="emailHelp" placeholder="Informe a senha do seu contrato Correios">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">R$ Valor Adicional:</label>
						<input type="text"class="form-control" value="<?=$dados['VALOR_ADICIONAL']?>" id="valoradicional" aria-describedby="emailHelp" placeholder="Informe o valor adicional">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Prazo de Entrega Dias:</label>
						<input type="number" class="form-control" value="<?=$dados['PRAZO_ENTREGA_DIAS']?>" id="prazoentregadias" aria-describedby="emailHelp">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
					    <label for="exampleInputEmail1">Valor Declarado:</label>
						<input type="text" class="form-control" value="<?=$dados['VALOR_DECLARADO']?>" id="valordeclarado" aria-describedby="emailHelp">
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
				        <div class="form-group col-md-12 col-xs-12">
	                        <label>Ativo:</label>
	                        <input type="checkbox" <?=$dados['ATIVO'] == "1" ? "checked": "";?> id="ativo">
	                    </div>
					</div>
					<div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
				        <div class="form-group col-md-12 col-xs-12">
	                        <label>Mão Própria:</label>
	                        <input type="checkbox" <?=$dados['MAO_PROPRIA'] == "1" ? "checked": "";?> id="maopropria">
	                    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 text-center"> 
						<button type="button" class="btn btn-success btn-salvar">Salvar Dados</button>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

</body>
	 <?php $this->load->view('upadmin/inc/footer');?>
	 <script>
	  	$("#valoradicional,#valordeclarado").mask("#.##0,00", {reverse: true});;
	 	$(function(){
	 		$(".btn-salvar").on("click", function(){
	 			if(Validar()){
	 				$.ajax({
	 					method:"POST",
	 					url: "<?=base_url()?>/index.php/freteAdmin/salvar",
	 					data: { 
	 						codigo: $("#codigo").val(),
	 						cep: $("#cep").val(),
	 						contrato: $("#contrato").val(),
	 						senhacontrato: $("#senhacontrato").val(),
	 						valoradicional: $("#valoradicional").val(),
	 						prazoentregadias: $("#prazoentregadias").val(),
	 						ativo: $("#ativo").is(":checked") ? true : false,
	 						maopropria: $("#maopropria").is(":checked") ? true : false,
	 						valordeclarado: $("#valordeclarado").val(),
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
	 		
	 		if($("#cep").val() == ""){
	 			$("#cep").focus();
	 			return false;
	 		}

	 		return true;
	 	}

	 	function somenteNumeros(num) {
            var er = /[^0-9.]/;
            er.lastIndex = 0;
            var campo = num;
            if (er.test(campo.value)) {
              campo.value = "";
            }
        }
	 </script>
</html>