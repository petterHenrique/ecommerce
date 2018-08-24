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
    <div id="wrapper">
        <?php $this->load->view('upadmin/inc/menu');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                	<hr>
                	<ul class="breadcrumb">
					    <li><a href="<?=base_url()?>index.php/dashboard/index">Home</a></li>
					    <li><a href="<?=base_url()?>index.php/produtosAdmin/index">Produtos</a></li>
					    <li class="active">Cadastro</li>
					</ul>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12">
            		<input type="hidden" value="0" id="codigo-produto"/>

					<div class="row" style="padding:20px;border:1px solid #dadada;background:rgba(220,220,220,.8);">
						<h2 class="text-primary">Dados Gerais Produto:</h2>
		                <hr>
	            		<div class="form-group col-md-12">
	                        <label>Nome:</label>
	                        <input id="nome-produto" class="form-control">
	                        <p class="help-block">Exemplo: Bolsa da nike</p>
	                    </div>
	                    <div class="form-group col-md-6">
	                        <label>EAN:</label>
	                        <input id="ean-produto" class="form-control">
	                        <p class="help-block">Exemplo: 5022142</p>
	                    </div>
	                    <div class="form-group col-md-6">
	                        <label>NCM:</label>
	                        <input id="ncm-produto" class="form-control">
	                    </div>
	                    <div class="form-group col-md-12">
	                        <label>Descrição:</label>
	                        <textarea id="descricao-produto" style="resize: none;" class="form-control" rows="3"></textarea>
	                    </div>
	                    <div class="form-group col-md-6">
	                        <label>Modelo:</label>
	                        <input id="modelo-produto" class="form-control">
	                    </div>
	                    <div class="form-group col-md-6">
	                        <label>Marca:</label>
	                        <input id="modelo-produto" class="form-control">
	                    </div>
	                    <hr>
					</div>
					<hr>
					<div class="row" style="padding:20px;border:1px solid #dadada;background:rgba(220,220,220,.8);">
	                    <h2 class="text-primary">Precificação do Produto:</h2>
	                    <hr>
	                    <div class="form-group col-md-6">
	                        <label>Preço:</label>
	                        <input id="preco-produto" class="form-control">
	                    </div>

	                    <div class="form-group col-md-6">
	                        <label>Preço Promocional:</label>
	                        <input id="promo-produto" class="form-control">
	                    </div>

	                     <div class="form-group col-md-6">
	                        <label>Data Inicial Promoção:</label>
	                        <input id="dtaInicialPromo-produto" class="form-control">
	                    </div>

	                    <div class="form-group col-md-6">
	                        <label>Data Final Promoção:</label>
	                        <input id="dtaFinalPromo-produto" class="form-control">
	                    </div>

					</div>


                    

                    
                    <div class="row" style="padding:20px;border:1px solid #dadada;background:rgba(220,220,220,.8);">
	                    <h2 class="text-primary">Dimensões do Produto:</h2>
	                    <hr>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Peso:</label>
	                        <input id="peso-produto" class="form-control">
	                    </div>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Comprimento:</label>
	                        <input id="comprimento-produto" class="form-control">
	                    </div>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Largura:</label>
	                        <input id="largura-produto" class="form-control">
	                    </div>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Altura:</label>
	                        <input id="altura-produto" class="form-control">
	                    </div>
	                    <hr>
                    </div>
                    <hr>


                    <div class="row" style="padding:20px;border:1px solid #dadada;background:rgba(220,220,220,.8);">
	                    <h2 class="text-primary">Fotos do Produto:</h2>
	                    <hr>
	                    
	                    <hr>
                    </div>
                    <hr>


                    <div class="row" style="padding:20px;border:1px solid #dadada;background:rgba(220,220,220,.8);">
	                    <h2 class="text-primary">Otimização de Busca SEO:</h2>
	                    <hr>
	                    <div class="form-group col-md-4 col-xs-12">
	                        <label>Title SEO H1:</label>
	                        <input id="title-seo" class="form-control">
	                    </div>
	                    <div class="form-group col-md-4 col-xs-12">
	                        <label>Keywords SEO:</label>
	                        <input id="keyword-seo" class="form-control">
	                    </div>
	                    <div class="form-group col-md-4 col-xs-12">
	                        <label>Url Amigavel:</label>
	                        <input id="urlAmigavel-produto" class="form-control">
	                    </div>
	                    <div class="form-group col-md-12 col-xs-12">
	                        <label>Description SEO:</label>
	                         <textarea id="description-seo" style="resize: none;" class="form-control" rows="3"></textarea>
	                    </div>
	                    <hr>
                    </div>
					

					
                    </br>
                    <div class="text-center"> 
                    	<button id="salvar-produto" class="btn btn-success"><span class="fa fa-floppy-o"></span> Salvar Produto</button>
                    </div>
                    </br>
            	</div>
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->
    </div>
</body>
	<?php $this->load->view('upadmin/inc/footer');?>
	<script src="<?=base_url()?>assets/js/categorias/categoriasAdmin.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
	<script> 
	const categoria = new Categorias();
	$(function(){

		$("#descricao-produto").summernote({
			height: 400
		});

		$("#foto-categoria").addClass("hidden");
		$("#foto").change(function() {
			LerImagem(this);
			$("#foto-categoria").removeClass("hidden");
		});

		$("#salvar-categoria").on("click", function(){
			if(categoria.Validar()){
				categoria.Salvar();
			}
		});
	});

	function LerImagem(input) {
	  	if (input.files && input.files[0]) {
	    	var reader = new FileReader();
		    reader.onload = function(e) {
		      $('#foto-categoria').attr('src', e.target.result);
		    }
	    	reader.readAsDataURL(input.files[0]);
	  	}
	}
	</script>
</html>