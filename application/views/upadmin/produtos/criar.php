<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php $this->load->view('upadmin/inc/header');?>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<style>
/*CUSTOM PAGINA PRODUTO*/
.panel-produto{
    background: #fff;
    padding:20px;
    border:1px solid #dadada;
}
</style>
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
                            <a href="<?=base_url()?>index.php/produtosAdmin/index">Produtos</a>
                        </li>
                        <li class="breadcrumb-item active">Cadastrar novo Produto</li>
                    </ul>
                </div>
                <div class="row row-cards">
                    <div class="col">
                        <input type="hidden" value="0" id="codigo-produto"/>

                        <div class="row panel-produto">
                            <h3 class="text-primary w-100">Dados Gerais Produto:</h3>
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
                                <input id="estoque-produto" type="number" onkeyup="somenteNumeros(this);" placeholder="Ex: 40" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Descrição:</label>
                                <div id="descricao-produto" style="height: 300px"></div>
                            </div>
                            <hr />
                            <div class="form-group col-md-4">
                                <label>Modelo:</label>
                                <input id="modelo-produto" placeholder="Ex: ESPORTIVO" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Marca:</label>
                                <select id="marca-produto" style="padding:6px 12px;" class="select2 form-control">
                                    <option selected value="0">Nenhum</option>
                                    <?php foreach ($marcas as $marca) { ?>
                                        <option value="<?=$marca['COD_MARCA'];?>"><?=$marca['NOME_MARCA'];?></option>
                                    <?php }	?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Categorias:</label>
                                <select id="categorias-produto" multiple style="padding:6px 12px;" class="select2 form-control">
                                    <?php foreach ($categorias as $categoria) { ?>
                                        <option value="<?=$categoria['COD_CATEGORIA'];?>"><?=$categoria['NOME_CATEGORIA'];?></option>
                                    <?php }	?>
                                </select>
                            </div>
                            <hr>
                        </div>
                        <hr>
                        <div class="row panel-produto">
                            <h3 class="text-primary w-100">Precificação do Produto:</h3>
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
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Data Final Promoção:</label>
                                <div class="input-group">
                                    <input maxlength="20" type="text" id="dtaFinalPromo-produto" placeholder="Ex: 02/02/2000" class="form-control datepicker">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fa fa-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row panel-produto">
                            <h3 class="text-primary w-100">Dimensões do Produto:</h3>
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


                        <div class="row panel-produto">
                            <h3 class="text-primary w-100">Fotos do Produto:</h3>
                            <h5 class="text-primary w-100">(limite de 8 fotos)</h5>
                            <hr>
                            <form action="" class="dropzone" id="fotosProduto">
                                <div class="fallback">
                                    <input name="arquivos" type="file" multiple />
                                </div>
                            </form>
                            <hr>
                        </div>
                        <hr>

                        <div class="row panel-produto">
                            <h3 class="text-primary w-100">Variações do Produto:</h3>
                            <hr>
                            <button class="btn btn-success">
                                <span class="fa fa-plus"></span>&nbsp; Adicionar
                            </button>
                        </div>
                        <hr>

                        <div class="row panel-produto">
                            <h3 class="text-primary w-100">Otimização de Busca SEO:</h3>
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

                            <div class="form-group col-md-12 col-xs-12">
                                <label>Ativo:</label>
                                <input type="checkbox" id="produtoAtivo">
                            </div>

                             <div class="form-group col-md-12 col-xs-12">
                                <label>Produto Arma:</label>
                                <input type="checkbox" id="produtoArma">
                            </div>

                             <div class="form-group col-md-12 col-xs-12">
                                <label>Produto Destaque:</label>
                                <input type="checkbox" id="produtoDestaque">
                            </div>
                            <hr>
                        </div>
                        <div class="text-center my-4">
                            <button id="salvar-produto" class="btn btn-success"><span class="fa fa-floppy-o"></span> Salvar Produto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</body>

	<script src="<?=base_url()?>assets/js/categorias/categoriasAdmin.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <?php $this->load->view('upadmin/inc/footer');?>

	<script>
        var toolbarOptions = [
            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'font': [] }],
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction
            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'align': [] }],
            ['clean']                                         // remove formatting button
        ,['code-block']];

        var editorTexto = new Quill('#descricao-produto', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });

        const produto = new Produto();


        Dropzone.autoDiscover = false;
        produto.ConfiguracoesDropZone();

        $(function(){

            produto.InicializaMascaras();

            //var myDropzone = new Dropzone("#fotos-produto", { url: "/file/post"});

            $("#salvar-produto").on("click", function(){
                //if(produto.Validar()){
                    produto.Salvar();
                //}
            });
        });


        function Produto(){

            var self = this;

            self.ObjetoDropZone = undefined;

            self.Validar = function(){

                //valida dados gerais do produto
                if($("#nome-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha o nome do Produto!");
                    $("#nome-produto").focus();
                    return false;
                }else if($("#ean-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha o código EAN do Produto!");
                    $("#ean-produto").focus();
                    return false;
                }else if($("#estoque-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha o estoque do Produto!");
                    $("#estoque-produto").focus();
                    return false;
                }
                //precificação do produto
                else if($("#preco-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha o código EAN do Produto!");
                    $("#preco-produto").focus();
                    return false;
                }

                //dimensoes do produto

                else if($("#peso-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha o peso do Produto!");
                    $("#peso-produto").focus();
                    return false;
                }
                else if($("#comprimento-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha o comprimento do Produto!");
                    $("#comprimento-produto").focus();
                    return false;
                }
                else if($("#largura-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha a largura do Produto!");
                    $("#largura-produto").focus();
                    return false;
                }
                else if($("#altura-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha a altura do Produto!");
                    $("#altura-produto").focus();
                    return false;
                }
                //validação de SEO
                else if($("#title-seo").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha título do Produto para SEO!");
                    $("#title-seo").focus();
                    return false;
                }
                else if($("#keyword-seo").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha pelo menos uma palavra chave do seu Produto!");
                    $("#keyword-seo").focus();
                    return false;
                }
                else if($("#urlAmigavel-produto").val() == ""){
                    alertas.AlertaErro("Atenção", "Preencha a Url Amigável!");
                    $("#urlAmigavel-produto").focus();
                    return false;
                }else{
                    return true;
                }
            }

            self.Salvar = function(){

            	var formdata = new FormData();

            	//adiciono um array de arquivos
            	var totalArquivos = self.ObjetoDropZone.files.length;

				for (var x = 0; x < totalArquivos; x++) {
				    formdata.append("fotos[]", self.ObjetoDropZone.files[x]);
				}

            	formdata.append("modelo", JSON.stringify(self.MontarViewModel()));

                $.ajax({
                    method: "POST",
                    url: "<?=base_url()?>/index.php/produtosAdmin/salvarProduto",
                    data: formdata,
                    processData: false,
        			contentType: false,
                    success: function(data){
                    	if(data.sucesso){
                    		alertas.AlertaSucesso("Ok","Dados salvos com sucesso!");

                    		setTimeout(function(){
                    			window.location.href='<?=base_url()?>/index.php/produtosAdmin/index';
                    		},1800);
                    	}
                    },
                    error: function(data){
                        alertas.AlertaErro("Atenção",data.error);
                    },
                    complete: function(){
                        
                    }
                });
            }

            self.MontarViewModel = function(){

                //TODO: Acrescentar no banco SKU 
                let objeto = {
                    codigoProduto: $("#codigo-produto").val(),
                    nomeProduto: $("#nome-produto").val(),
                    eanProduto: $("#ean-produto").val(),
                    ncmProduto: $("#ncm-produto").val(),
                    estoqueProduto: $("#estoque-produto").val(),
                    descricaoProduto: JSON.stringify(editorTexto.getContents()), //editorTexto.container.innerText,
                    modelProduto: $("#modelo-produto").val(),
                    marcaProduto: $("#marca-produto").val(),
                    categorias: $("#categorias-produto").val(),
                    //precificacao do produto
                    precoProduto: $("#preco-produto").val(),
                    promoProduto: $("#promo-produto").val(),
                    dtaInicialPromo: $("#dtaInicialPromo-produto").val(),
                    dtaFinalProdmo: $("#dtaFinalPromo-produto").val(),

                    //dimensoes do produto
                    pesoProduto: $("#peso-produto").val(),
                    comprimentoProduto: $("#comprimento-produto").val(),
                    larguraProduto: $("#largura-produto").val(),
                    alturaProduto: $("#altura-produto").val(),


                    //fotos do produto
                    fotosProduto: self.ObjetoDropZone.files,

                    //SEO do produto
                    tituloSeo: $("#title-seo").val(),
                    keyWordsSeo: $("#keyword-seo").val(),
                    urlAmigavelProduto: $("#urlAmigavel-produto").val(),
                    descriptionSeo: $("#description-seo").val(),

                    tipAtivo: $("#produtoAtivo").is(":checked") ? true : false,
                    tipArma: $("#produtoArma").is(":checked") ? true : false,
                    tipDestaque: $("#produtoDestaque").is(":checked") ? true : false
                }
                return objeto;
            }

            self.ConfiguracoesDropZone = function(){

                let config = undefined;

                self.ObjetoDropZone =  new Dropzone("#fotosProduto", 
                	{ 
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
	                        }),
	                        
	                        this.on("addedfile", function(file) { 
	                        	
	                        });
                    	}
                	}
                );
            }

            self.InicializaMascaras = function(){
                $("#preco-produto, #promo-produto").mask("#.##0,00", {reverse: true});;
                $("#peso-produto").mask("#.##0,000", {reverse: true});
                $("#comprimento-produto, #largura-produto, #comprimento-produto").mask("00000000000");
            }
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