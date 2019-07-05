<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php $this->load->view('upadmin/inc/header');?>

    <style>
    .some{
    	display:none;
    }
    </style>
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
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/categoriasAdmin/index">Categorias</a>
                        </li>
                        <li class="breadcrumb-item active">Cadastrar nova Categoria</li>
                    </ul>
                    <h2>Criar nova Categoria</h2>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="hidden" value="0" id="codigo-categoria"/>
                        <div class="form-group">
                            <label>Nome:</label>
                            <input id="nome-categoria" class="form-control" placeholder="Exemplo: Cosmético">
                        </div>
                        <div class="form-group">
                            <label>Categoria Pai:</label>
                            <select id="categoria-pai" style="padding:6px 12px;" class="select2 form-control">
                                <option selected value="0">Nenhum</option>
                                <?php foreach ($categorias as $categoria) { ?>
                                    <option value="<?=$categoria['COD_CATEGORIA'];?>"><?=$categoria['NOME_CATEGORIA'];?></option>
                                <?php }	?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Descrição da Categoria:</label>
                            <textarea id="descricao-categoria" style="resize: none;" class="form-control" rows="3" placeholder="Exemplo: Perfume de ótima qualidade..."></textarea>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Title SEO:</label>
                            <input maxlength="250" id="title-seo" placeholder="Ex: NOME DA CATEGORIA" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Keywords SEO:</label>
                            <input id="keyword-seo" placeholder="Ex: PALAVRAS CHAVE SEPARADO POR VÍRGULA" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Url Amigavel:</label>
                            <input id="url-amigavel"  placeholder="Ex: categoria-teste SEPARADO POR ' - '" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Description SEO:</label>
                            <textarea maxlength="500" id="description-seo" style="resize: none;" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input id="ativo" checked type="checkbox" value="">Ativo</label>
                            </div>
                        </div>
                        <!--div class="form-group">
                            <label class="btn btn-primary btn-file">
                                <i class="fa fa-picture-o" aria-hidden="true"></i> Carregar Foto <input id="foto" type="file" hidden>
                            </label>
                            <hr>
                            <img class="some" style="width:250px;height:250px;" src="" id="foto-categoria" />
                        </div>
                        <hr-->
                        <div class="text-center">
                            <button id="salvar-categoria" class="btn btn-success"><span class="fa fa-floppy-o"></span> Salvar Categoria</button>
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
	const categoria = new Categorias();
	$(function(){
		$("#foto-categoria").addClass("hidden");
		$("#foto").change(function() {
			LerImagem(this);
			$("#foto-categoria").removeClass("some");
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