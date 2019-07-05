<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php $this->load->view('upadmin/inc/header');?>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
</head>
<body>
<div class="page">
    <div class="page-main">

        <?php $this->load->view('upadmin/layout/navbar.php');?>

		<?php $banner = $banner[0];?>

        <div class="my-3 my-md-5">
            <div class="container">
                <div class="my-3 mx-0">
                    <ul class="breadcrumb w-100 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/dashboard/index">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/bannersAdmin/index">Baner</a>
                        </li>
                        <li class="breadcrumb-item active">Edição</li>
                    </ul>
                    <h2>Editar Baner</h2>
                </div>
            <!-- /.row -->
            <div class="row">
            	<div class="col-md-12">
            	

            	<input type="hidden" value="<?=$banner['COD_BANER']?>" id="codigo-banner"/>
            		<div class="form-group">
                        <label>Nome Banner:</label>
                        <input id="nome-banner" value="<?=$banner['NOME_BANER']?>" class="form-control">
                        <p class="help-block">Exemplo: Promoção imperdível</p>
                    </div>
                    <div class="form-group">
                        <label>Foto:</label>
                        <input type="file" id="foto-banner" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Url Banner:</label>
                        <input id="url-banner" value="<?=$banner['LINK_BANER']?>" class="form-control">
                        <p class="help-block">Exemplo: http://sualoja.com/categoria</p>
                    </div>
                    <div class="form-group">
                        <label>Posição Banner:</label>
                        <input id="posicao-banner" value="<?=$banner['POSICAO_BANER']?>" class="form-control">
                        <p class="help-block">Exemplo: (1) exibido primeiro (2) por segundo</p>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">

                        	<?php

                        	if($banner['TIP_ATIVO'])

                        	?>

						  <label><input id="ativo" type="checkbox" value="">Ativa</label>
						</div>
                    </div>
                    </br>
                    <div class="text-center"> 
                    	<button id="salvar-banner" class="btn btn-success"><span class="fa fa-floppy-o"></span> Salvar Baner</button>
                    </div>
                    </br>
            	<?php 


            	echo var_dump($banner);

            	?>
                    
            	</div>
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->
    </div>
</body>
	<?php $this->load->view('upadmin/inc/footer');?>
	<script> 

	const banner = new Banner();

	$(function(){

		$("#salvar-banner").on("click", function(){
			banner.ValidarBanner();
		});
	});


	function Banner(){

		var self = this;

		self.MontarModelBanner = function(){

			let formData = new FormData();

			formData.append("nomeBanner", $("#nome-banner").val());
			formData.append("codigoBanner", $("#codigo-banner").val());
			formData.append("urlBanner", $("#url-banner").val());
			formData.append("posicaoBanner", $("#posicao-banner").val());
			formData.append("ativo", $("#ativo").is(":checked") ? true : false);
			formData.append('foto', $('#foto-banner')[0].files[0]);

			return formData;
		}

		self.ValidarBanner = function(){
			if($("#nome-banner").val() == ""){
				alertas.AlertaErro("Atenção", "Preencha o campo nome");
				$("#nome-banner").focus();
				return false;
			}else if($("#posicao-banner").val() == ""){
				alertas.AlertaErro("Atenção", "Informe a posição do baner");
				$("#posicao-banner").focus();
				return false;
			}else if($('#foto-banner').val() == ""){
				alertas.AlertaErro("Atenção", "Selecione um foto");
				$("#foto-banner").focus();
				return false;
			}else{
				self.Salvar();
			}
		}

		self.Salvar = function(){
			$.ajax({
				method: "POST",
				url: "<?=base_url()?>index.php/bannersAdmin/salvarBanner",
				contentType: false,
        		processData: false,
				data: self.MontarModelBanner(),
				success: function(data){
					alertas.AlertaSucesso("Sucesso!", data.success);
					setTimeout(function(){
						window.location.href='<?=base_url()?>index.php/bannersAdmin/index';
					},800);
				},
				error: function(data){
					alertas.AlertaErro("Atenção", data.error);
				},
				complete: function(){

				}
			});
		}

	}
	
	</script>
</html>