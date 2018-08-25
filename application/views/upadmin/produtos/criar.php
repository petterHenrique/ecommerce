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

					<div class="row" style="padding:20px;border:1px solid #dadada;background:#f5f5f5;">
						<h2 class="text-primary">Dados Gerais Produto:</h2>
		                <hr>
	            		<div class="form-group col-md-12">
	                        <label>Nome:</label>
	                        <input id="nome-produto" placeholder="Ex: PRODUTO NIKE UNISEX" class="form-control">
	                    </div>
	                    <div class="form-group col-md-4">
	                        <label>EAN:</label>
	                        <input id="ean-produto" placeholder="Ex: 822400" class="form-control">
	                    </div>
	                    <div class="form-group col-md-4">
	                        <label>NCM:</label>
	                        <input id="ncm-produto" placeholder="NOMENCLATURA COMUM DO MERCOSUL" class="form-control">
	                    </div>
	                    <div class="form-group col-md-4">
	                        <label>Estoque:</label>
	                        <input id="estoque-produto" placeholder="Ex: 40" class="form-control">
	                    </div>
	                    <div class="form-group col-md-12">
	                        <label>Descrição:</label>
	                        <textarea id="descricao-produto" style="resize: none;" class="form-control" rows="3"></textarea>
	                    </div>
	                    <div class="form-group col-md-6">
	                        <label>Modelo:</label>
	                        <input id="modelo-produto" placeholder="Ex: ESPORTIVO" class="form-control">
	                    </div>
	                    <div class="form-group col-md-6">
	                        <label>Marca:</label>
	                        <select id="marca-produto" style="padding:6px 12px;" class="select2 form-control">
                        			<option selected value="0">Nenhum</option>
			                        <?php foreach ($marcas as $marca) { ?>
			                        <option value="<?=$marca['COD_MARCA'];?>"><?=$marca['NOME_MARCA'];?></option>
	                        <?php }	?>
	                        </select>
	                    </div>
	                    <hr>
					</div>
					<hr>
					<div class="row" style="padding:20px;border:1px solid #dadada;background:#f5f5f5;">
	                    <h2 class="text-primary">Precificação do Produto:</h2>
	                    <hr>
	                    <div class="form-group col-md-6">
	                        <label>Preço:</label>
	                        <input id="preco-produto" maxlength="20" placeholder="Ex: R$ 0,00" class="form-control">
	                    </div>

	                    <div class="form-group col-md-6">
	                        <label>Preço Promocional:</label>
	                        <input id="promo-produto" maxlength="20" placeholder="Ex: R$ 0,00" class="form-control">
	                    </div>

	                    <div class="form-group col-md-6">
	                        <label>Data Inicial Promoção:</label>
	                        <div class="input-group">
							    <input maxlength="20" type="text" id="dtaInicialPromo-produto" placeholder="Ex: 02/02/2000" class="form-control datepicker">
							    <div class="input-group-addon">
							        <span class="fa fa-calendar"></span>
							    </div>
							</div>
	                    </div>

	                    <div class="form-group col-md-6">
	                        <label>Data Final Promoção:</label>
	                        <div class="input-group">
							    <input maxlength="20" type="text" id="dtaFinalPromo-produto" placeholder="Ex: 02/02/2000" class="form-control datepicker">
							    <div class="input-group-addon">
							        <span class="fa fa-calendar"></span>
							    </div>
							</div>
	                    </div>
					</div>


                    

                    <hr>
                    <div class="row" style="padding:20px;border:1px solid #dadada;background:#f5f5f5;">
	                    <h2 class="text-primary">Dimensões do Produto:</h2>
	                    <hr>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Peso:</label>
	                        <input maxlength="20" id="peso-produto" placeholder="Ex: 0,500 gramas" class="form-control">
	                    </div>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Comprimento:</label>
	                        <input maxlength="20" id="comprimento-produto" placeholder="Ex: 20 cm" class="form-control">
	                    </div>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Largura:</label>
	                        <input maxlength="20" id="largura-produto" placeholder="Ex: 20 cm" class="form-control">
	                    </div>
	                    <div class="form-group col-md-3 col-xs-12">
	                        <label>Altura:</label>
	                        <input maxlength="20" id="altura-produto" placeholder="Ex: 40 cm" class="form-control">
	                    </div>
	                    <hr>
                    </div>
                    <hr>


                    <div class="row" style="padding:20px;border:1px solid #dadada;background:#f5f5f5;">
	                    <h2 class="text-primary">Fotos do Produto:</h2>
	                    <h5 class="text-primary">(limite de 8 fotos)</h5>
	                    <hr>
						  <form action="" class="dropzone" id="fotosProduto">  
						    <div class="fallback"> 
						     <input name="arquivos" type="file" multiple /> 
						    </div> 
						 </form>
	                    <hr>
                    </div>
                    <hr>

                    <div class="row" style="padding:20px;border:1px solid #dadada;background:#f5f5f5;">
	                    <h2 class="text-primary">Variações do Produto:</h2>
	                    <hr>
						  <button class="btn btn-success">Adicionar</button>
	                    <hr>
                    </div>
                    <hr>

                    <div class="row" style="padding:20px;border:1px solid #dadada;background:#f5f5f5;">
	                    <h2 class="text-primary">Otimização de Busca SEO:</h2>
	                    <hr>
	                    <div class="form-group col-md-4 col-xs-12">
	                        <label>Title SEO H1:</label>
	                        <input maxlength="250" id="title-seo" placeholder="Ex: NOME DO PRODUTO" class="form-control">
	                    </div>
	                    <div class="form-group col-md-4 col-xs-12">
	                        <label>Keywords SEO:</label>
	                        <input id="keyword-seo" placeholder="Ex: PALAVRAS CHAVE SEPARADO POR VÍRGULA" class="form-control">
	                    </div>
	                    <div class="form-group col-md-4 col-xs-12">
	                        <label>Url Amigavel:</label>
	                        <input id="urlAmigavel-produto" placeholder="Ex: tenis-nike-stefan-janoski SEPARADO POR ' - '" class="form-control">
	                    </div>
	                    <div class="form-group col-md-12 col-xs-12">
	                        <label>Description SEO:</label>
	                         <textarea maxlength="500" id="description-seo" style="resize: none;" class="form-control" rows="4"></textarea>
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
	const produto = new Produto();
	produto.ConfiguracoesDropZone();
	$(function(){
		produto.InicializaMascaras();
		
		//var myDropzone = new Dropzone("#fotos-produto", { url: "/file/post"});
		

		$("#descricao-produto").summernote({
			height: 400
		});

		$("#salvar-produto").on("click", function(){
			if(produto.Validar()){
				produto.Salvar();
			}
		});
	});


	function Produto(){

		var self = this;

		self.Validar = function(){


		}

		self.Salvar = function(){

		}

		self.ConfiguracoesDropZone = function(){
			Dropzone.options.fotosProduto = {
				url: "<?=base_url()?>/produtosAdmin/uploadImagens",
			  	addRemoveLinks: true,
			  	maxFiles: 8,
			  	autoProcessQueue: false,
			  	acceptedFiles: '.png,.jpg', 
  				dictDefaultMessage: "Faça upload das imagens do produto!",
  				dictRemoveFile: "Remover Arquivo!",
  				init: function() {
				    this.on("maxfilesexceeded", function(file){
				        this.removeFile(file);
				    });
				}
			};
		}

		self.InicializaMascaras = function(){
		$("#preco-produto, #promo-produto").mask("#.##0,00", {reverse: true});;
		$("#peso-produto").mask("#.##0,000", {reverse: true});
		$("#comprimento-produto, #largura-produto, #comprimento-produto").mask("00000000000");
		}
	}

	</script>

	<script> 
	 </script>
</html>