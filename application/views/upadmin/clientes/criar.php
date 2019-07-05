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

        <div class="my-3 my-md-5">
            <div class="container">
                <div class="my-3 mx-0">
                    <ul class="breadcrumb w-100 p-0">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/dashboard/index">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>index.php/paginasAdmin/index">Páginas</a>
                        </li>
                        <li class="breadcrumb-item active">Criar</li>
                    </ul>
                    <h2>Cadastrar Página</h2>
                </div>
            <!-- /.row -->
            <div class="row">
            	<div class="col-md-12">
            		<input type="hidden" value="0" id="codigo-pagina"/>
            		<div class="form-group">
                        <label>Nome:</label>
                        <input id="nome-pagina" class="form-control">
                        <p class="help-block">Exemplo: Termos e Condições</p>
                    </div>

                    <div class="form-group">
                        <label>Descrição da Página:</label>
                        <textarea id="descricao-pagina" style="resize: none;" class="form-control" rows="3"></textarea>
                        <p class="help-block">Exemplo: Perfume de ótima qualidade ...</p>
                    </div>

                    <div class="form-group">
                        <div class="checkbox">
						  <label><input id="ativo" checked type="checkbox" value="">Ativa</label>
						</div>
                    </div>
                    </br>
                    <div class="text-center"> 
                    	<button id="salvar-pagina" class="btn btn-success"><span class="fa fa-floppy-o"></span> Salvar Página</button>
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
	<script src="<?=base_url()?>/assets/js/paginas/paginas.js" ></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
	<script> 

	const paginas = new Paginas();

	$(function(){

		$("#salvar-pagina").on("click", function(){
			paginas.ValidarPagina();
		});

		$("#descricao-pagina").summernote({
			height: 400,
			callbacks: {
				onImageUpload: function(files, editor, welEditable) {
	                //sendFile(files[0], editor, welEditable);
	                paginas.UploadImagem(files);
	            }
			}
		});
		
	});

	
	</script>
</html>