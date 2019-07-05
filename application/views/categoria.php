<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Cac Serra - Artigos Caça e Tiro Esportivo, Airsoft, Carabina de Pressão</title>
		<link href="<?=base_url()?>assets/css/bootstrap4.min.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/heroic-features.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

		<!--SEO-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<style type="text/css">
		.text-subfooter{
			color: #808080;
    		font-family: 'PT Sans Narrow',sans-serif;
    		font-size: 13px;
		}
		.menu-institucional-footer{
			list-style: none;
		}
		.menu-institucional-footer li a{
			text-decoration: none;
		}

		.sub-header{
			position:absolute;
			height:30px;
			width:100%;
			margin-top:-56px;
			background:#f5f5f5;
		}
		.sub-header p{
			margin-left:50px;
			font-size:14px;
			margin-top:5px;
		}

		#btn-pesquisar{
			background:#bf0311;
			border:1px solid #bf0311;
			color:#ffffff;
			cursor:pointer;
		}
		.painel-header{
			padding-top:20px;
			padding-bottom:20px;
			margin-top:-25px;
			width:100%;
			background:#222222;
		}
		.panel-pesquisa{
			margin-top:10px;			
		}
		.panel-cart{
			margin-top:16px;
			color:#ffffff;	
		}

		/*migalhas*/
		.categoria-migalhas{
			margin-top:-23px;
			margin-left:15px;
			font-size:16px;
			color:#000000;
			font-weight:bold;
		}

		/*reset css*/
		h1,h2,h3,h4,h5{
			margin: 0;
		    padding: 0;
		    border: 0;
		    font-size: 100%;
		    font: inherit;
		    vertical-align: baseline;
		}


		/*CSS produto*/
		.referencia{
			font-size: .8em;
		    font-family: Open Sans;
		    color: #909090;
		    margin-bottom: 5px;
		    width: 100%;
		    text-align: center;
		}
		.titulo-produto{
			font-size:20px;
		}

		.panel-miniaturas{
			padding-top:10px;
			padding-bottom:10px;
			margin:0 auto;
		}
		.img-principal-produto{
			width:620px;
			height:440px;
		}
		.img-miniaturas{
			width:65px;
			cursor:pointer;
		}

		.text-preco{
			font-size:22px;
			color:#2FD565;
		}

		.btn-adicionar{
			background:#2FD565;
			color:#ffffff;
		}

		.panel-adicionar{
			margin-top:14px;
		}
		.panel-descricao-produto{
			margin-top:14px;
		}
		.panel-orcamento{
			margin-top:14px;
		}

		/*orçamento*/
		.form-orcamento{
			padding:20px;
			background:#222222;
		}
		.input-orcamento{
			border-radius:0px;
			border:2px solid #ffffff;
			background:#222222;
			color: #fff;
		}
		.input-orcamento:focus{
			background:#222222;
			outline: none!important;
		}
		.input-orcamento::-webkit-input-placeholder { /* Chrome/Opera/Safari */
		  	color: #ffffff;
		}
		.input-orcamento::-moz-placeholder { /* Firefox 19+ */
		  	color: #ffffff;
		}
		.input-orcamento:-ms-input-placeholder { /* IE 10+ */
		  	color: #ffffff;
		}
		.input-orcamento:-moz-placeholder { /* Firefox 18- */
		  	color: #ffffff;
		}

		.input-orcamento-select {
			border-radius:0px;
			border:2px solid #ffffff;
			background:#222222;
			color: #ffffff;
		}
		.input-orcamento-select option {
		    border-radius:0px;
			border:2px solid #ffffff;
			background:#222222;
			color: #ffffff;
		}
		.zoom {
			display:inline-block;
			position: relative;
		}
		/* magnifying glass icon */
		.zoom:after {
			content:'';
			display:block; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			right:0;
			background:url(icon.png);
		}
		.zoom img {
			display: block;
		}
		.zoom img::selection { background-color: transparent; }

		.avaliacoes i{
			color:#f2ca27;
		}
		</style>
		 <script> 
	        var site_url = "<?=base_url()?>",
	            segments = ('').split('/');
	    </script>
	</head>
	<body>
		<?php $this->load->view('/inc/header');?>
		</br>
		<!--aqui é a migalha de pao-->
		<div class="container"> 
			<div class="row"> 
				<div class="col-12"> 
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item active" aria-current="page"><a href="<?=base_url()?>index.php">Inicio</a></li>
					    	<li class="breadcrumb-item active" aria-current="page"><h2 class="categoria-migalhas"><?=$categoriaNome[0]['NOME_CATEGORIA'];?></h2></li>
					  	</ol>
					</nav>
				</div>
			</div>
		</div>

		<div class="container">
        	<!-- AQUI SERÁ A SEÃO DE PRODUTOS DESTAQUE-->
   
        	<div class="row text-center">
        		<?php if(empty($produtos)){ ?>

        		<h2 class="text-center">Nenhum produto encontrado :(</h2>
        		<?php	
        			}
        		?>
        		<?php foreach ($produtos as $arma) {?>
        			<div class="col-lg-3 col-md-6 mb-4">
			            <div class="card-produto item-produto margin-top-20">
			            	<?php 
			            		$urlFotoPrincipal = "";

			            		if(!empty($arma['FOTOS'])){
			            			$urlFotoPrincipal = base_url().$arma['FOTOS'][0]['FOTO_PRODUTO'];
			            		}else{
			            			$urlFotoPrincipal = "https://www.ferramentastenace.com.br/wp-content/uploads/2017/11/sem-foto.jpg";
			            		}
			            	?>
				            <img class="img-produto mx-auto" src="<?=$urlFotoPrincipal?>" alt="">
				            <div class="card-body">
				                <h4 class="title-produto margin-top-20"><a href="<?=base_url()?>index.php/produtos/detalhe/<?=$arma['URL_AMIGAVEL_PRODUTO']?>"><?=$arma['NOME_PRODUTO']?></a></h4>
					            <div class="price margin-top-20">
					            	<del class="list-price">
					              		<i>De</i> 
					              		<b class="list">R$ <?=$arma['PRECO_PRODUTO']?></b> 
					              	</del>
					                <?php 
					                	if(!empty($arma['PRECO_PROMO_PRODUTO'])){
					                ?>
					                <em class="sale-price">
					              		<i>Por</i> 
					              		<b class="sale">R$ <?=$arma['PRECO_PROMO_PRODUTO']?></b> 
					              	</em>
					                <?php 
					                	}
					                ?>
					              	<dfn class="condition">
					              		<i> em até </i>
					              		<b class="parcels">6X</b> de <b class="parcel-value">R$ 31,40</b>
					              		<span class="no-interest"> sem juros no</span> 
					              	</dfn> 
					              	<small class="savings">cartão ou <b>R$ 169,56</b> à vista no boleto.</small> 
					            </div>
				            </div>
				            <div class="secao-comprar-produto">
				              	<a href="#" class="btn btn-comprar">Comprar</a>
				            </div>
			            </div>
			        </div>
        		<?php } ?>
      		</div>
		</div>
		<!-- aqui e os produtos da categoria -->
	
        <?php $this->load->view('/inc/footer');?>
        <!-- JS PRODUTO -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="<?=base_url()?>assets/js/produtocatalogo/jquery.zoom.js"></script>
        <script src="<?=base_url()?>assets/js/produtocatalogo/produto.js"></script>
        <script type="text/template" id="loading-orcamento">
        	<div class="lds-css ng-scope" style="width: 200px; height: 200px; margin:0 auto;"><div style="width:100%;height:100%" class="lds-eclipse"><div></div></div>
        	<style type="text/css">@keyframes lds-eclipse {
			  0% {
			    -webkit-transform: rotate(0deg);
			    transform: rotate(0deg);
			  }
			  50% {
			    -webkit-transform: rotate(180deg);
			    transform: rotate(180deg);
			  }
			  100% {
			    -webkit-transform: rotate(360deg);
			    transform: rotate(360deg);
			  }
			}
			@-webkit-keyframes lds-eclipse {
			  0% {
			    -webkit-transform: rotate(0deg);
			    transform: rotate(0deg);
			  }
			  50% {
			    -webkit-transform: rotate(180deg);
			    transform: rotate(180deg);
			  }
			  100% {
			    -webkit-transform: rotate(360deg);
			    transform: rotate(360deg);
			  }
			}
			.lds-eclipse {
			  position: relative;
			}
			.lds-eclipse div {
			  position: absolute;
			  -webkit-animation: lds-eclipse 1s linear infinite;
			  animation: lds-eclipse 1s linear infinite;
			  width: 160px;
			  height: 160px;
			  top: 20px;
			  left: 20px;
			  border-radius: 50%;
			  box-shadow: 0 4px 0 0 #ffffff;
			  -webkit-transform-origin: 80px 82px;
			  transform-origin: 80px 82px;
			}
			.lds-eclipse {
			  width: 200px !important;
			  height: 200px !important;
			  -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
			  transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
			}
			</style> 
			</div>
        </script>
        <script>

        //funções manipulaão produto

        $(function(){

        	//caso selecione a imagem para trocar
        	$("[produtofoto]").on("click", function(){

        		$("[produtofoto]").each(function(index, element){
        			$(element).removeClass('active');
        		});

        		let imagemSelecionada = $(this)[0];

        		let fotoPrincipal = $("#foto-principal > img");

        		//aqui eu seto a url da foto principal
        		fotoPrincipal.attr("src",imagemSelecionada.src);

        		//seta o estilo setado
        	});

        });

        </script>
	</body>
</html>