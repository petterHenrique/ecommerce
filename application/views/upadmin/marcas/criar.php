<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php $this->load->view('upadmin/inc/header');?>
</head>
<body>
<div class="page">
    <div class="page-main">

        <?php $this->load->view('upadmin/layout/navbar.php');?>

        <div class="my-3 my-md-5">
            <div class="container">
                <div class="my-3 mx-0">
                    <ul class="breadcrumb w-100">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/dashboard/index">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/marcasAdmin/index">Marcas</a>
                        </li>
                        <li class="breadcrumb-item active">Cadastrar nova Marca</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="hidden" value="0" id="codigo-marca"/>
                        <div class="form-group">
                            <label>Nome:</label>
                            <input id="nome-marca" class="form-control" placeholder="Exemplo: Nike">
                        </div>
                        <div class="form-group">
                            <label>Descrição Marca:</label>
                            <textarea id="descricao-marca" style="resize: none;" class="form-control" rows="3" placeholder="Exemplo: Nike apresenta diversos produtos de qualidade ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Title SEO:</label>
                            <input id="title-seo" class="form-control" placeholder="Nome Loja: Produtos Marca Nike">
                        </div>
                        <div class="form-group">
                            <label>Keywords SEO:</label>
                            <input id="keyword-seo" class="form-control" placeholder="Exemplo: nike, tênis nike, acessórios, original">
                        </div>
                        <div class="form-group">
                            <label>Description SEO:</label>
                            <textarea id="description-seo" style="resize: none;" class="form-control" rows="3" placeholder="Exemplo: Nike de ótima qualidade ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Url Amigável:</label>
                            <input id="url-amigavel" class="form-control" placeholder="Exemplo: nome-da-marca">
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input id="ativo" checked type="checkbox" value="">Ativo</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="btn btn-primary btn-file">
                                <i class="fa fa-picture-o" aria-hidden="true"></i> Carregar Foto <input id="foto" type="file" hidden>
                            </label>
                            <hr>
                            <img style="width:250px;height:250px;" src="#" id="foto-marca" />
                        </div>
                        <hr>
                        <div class="text-center">
                            <button id="salvar-marca" class="btn btn-success"><span class="fa fa-floppy-o"></span> Salvar Marca</button>
                        </div>
                        </br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
	<?php $this->load->view('upadmin/inc/footer');?>
	<script src="<?=base_url()?>assets/js/categorias/categoriasAdmin.js"></script>
	<script> 
	const marcas = new Marca();
	$(function(){
		$("#foto-marca").addClass("hidden");
		$("#foto").change(function() {
			LerImagem(this);
			$("#foto-marca").removeClass("hidden");
		});

		$("#salvar-marca").on("click", function(){
			if(marcas.Validar()){
				marcas.Salvar();
			}
		});
	});

	function LerImagem(input) {
	  	if (input.files && input.files[0]) {
	    	var reader = new FileReader();
		    reader.onload = function(e) {
		      $('#foto-marca').attr('src', e.target.result);
		    }
	    	reader.readAsDataURL(input.files[0]);
	  	}
	}

	function Marca(){
		
		var self = this;

		self.MontarModel = function(){

			let model = new FormData();

			model.append("codigoMarca",$("#codigo-marca").val());
			model.append("nomeMarca",$("#nome-marca").val());
			model.append("descricaoMarca",$("#descricao-marca").val());
			model.append("titleSeo",$("#title-seo").val());
			model.append("keywordSeo",$("#keyword-seo").val());
			model.append("descriptionSeo",$("#description-seo").val());
			model.append("urlAmigavel",$("#url-amigavel").val());
			model.append("ativo",$("#ativo").is(":checked") ? true : false);
			model.append("foto",$("#foto")[0].files[0]);
			
			return model;	
		}

		self.Validar = function(){
			if($("#nome-marca").val() == ""){
				$("#nome-marca").focus();
				alertas.AlertaErro("Atenção", "Preencha o campo nome marca.");
				return false;
			}else if($("#descricao-marca").val() == ""){
				$("#descricao-marca").focus();
				alertas.AlertaErro("Atenção", "Preencha o campo descrição marca.");
				return false;
			}else{
				return true;
			}
		}

		self.Salvar = function(){
			$.ajax({
				method: "POST",
				url: "<?=base_url()?>/index.php/marcasAdmin/salvarMarca",
				contentType: false,
        		processData: false,
				data: self.MontarModel(),
				beforeSend: function(){
					loading();
				},
				success: function(data){
					alertas.AlertaSucesso("Sucesso", data.success);
				},
				error: function(data){
					alertas.AlertaErro("Atenção", data.error);
				},
				complete: function(){
					loaded();					
				}
			});
		}

	}
	</script>
</html>