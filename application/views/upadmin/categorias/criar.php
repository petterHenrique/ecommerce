<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php $this->load->view('upadmin/inc/header');?>
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
					    <li><a href="<?=base_url()?>index.php/categoriasadmin/index">Categorias</a></li>
					    <li class="active">Cadastro</li>
					</ul>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12">
            		<input type="hidden" value="0" id="codigo-categoria"/>
            		<div class="form-group">
                        <label>Nome:</label>
                        <input id="nome-categoria" class="form-control">
                        <p class="help-block">Exemplo: Cosméticos</p>
                    </div>
                    <div class="form-group">
                        <label>Categoria Pai:</label> 
                        <select id="categoria-pai" style="padding:6px 12px;" class="select2 form-control">
                        <option selected value="0">Nenhum</option>
                        <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?=$categoria['COD_CATEGORIA'];?>"><?=$categoria['NOME_CATEGORIA'];?></option>
                        <?php }	?>
                        </select>
                        <p class="help-block">Exemplo: cosméticos > perfumes</p>
                    </div>
                    <div class="form-group">
                        <label>Descrição da Categoria:</label>
                        <textarea id="descricao-categoria" style="resize: none;" class="form-control" rows="3"></textarea>
                        <p class="help-block">Exemplo: Perfume de ótima qualidade ...</p>
                    </div>
                    <div class="form-group">
                        <label>Url Amigável:</label>
                        <input id="url-amigavel" class="form-control">
                        <p class="help-block">Exemplo: nome-do-produto</p>
                    </div>
                    <div class="form-group">
                        <label>Title: (SEO)</label>
                        <input id="title-seo" class="form-control">
                        <p class="help-block">Exemplo: perfumes, importados</p>
                    </div>
                    <div class="form-group">
                        <label>Keywords: (SEO)</label>
                        <input id="keyword-seo" class="form-control">
                        <p class="help-block">Exemplo: perfumes, importados</p>
                    </div>
                    <div class="form-group">
                        <label>Description: (SEO)</label>
                        <textarea id="description-seo" style="resize: none;" class="form-control" rows="3"></textarea>
                        <p class="help-block">Exemplo: Perfume de ótima qualidade ...</p>
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
						<img style="width:250px;height:250px;" src="" id="foto-categoria" />
                    </div>
                    <hr>
                    <div class="text-center"> 
                    	<button id="salvar-categoria" class="btn btn-success"><span class="fa fa-floppy-o"></span> Salvar Categoria</button>
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
	<script> 
	const categoria = new Categorias();
	$(function(){
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