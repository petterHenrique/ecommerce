<?php 
//dados do produto
$produtoCompleto = $produto['produto'];
$fotosProduto = $produto['fotos'];
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title><?=$produtoCompleto['TITLE_SEO'];?></title>
		<link href="<?=base_url()?>assets/csstema/bootstrap.min.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csstema/nouislider.min.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csstema/slick-theme.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csstema/slick.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csstema/style.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/css/animate.css" rel="stylesheet">
		<link href="<?=base_url()?>assets/csstema/font-awesome.min.css" rel="stylesheet">
		<!--SEO-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<style type="text/css">
		.pointer{
			cursor:pointer;
		}
		.produto-cor{
			color:#3376b8;
			font-family: 'Open Sans',sans-serif;
		}
		.price-success{
			color: #2FD565;
		}
		.price-default{
			font-size: 70%;
			color: black;
		}
		/*posiciona modal add carrinho meio tela*/
		.modal {
		  text-align: center;
		}

		@media screen and (min-width: 768px) { 
		  .modal:before {
		    display: inline-block;
		    vertical-align: middle;
		    content: " ";
		    height: 100%;
		  }
		}

		.modal-dialog {
		  display: inline-block;
		  text-align: left;
		  vertical-align: middle;
		}
		</style>
		<script>
			var site_url = '<?=base_url()?>';
		</script>
	</head>
	<body>
		<?php $this->load->view('/inc/header');?>

		<!-- BREADCRUMB -->
		<div id="breadcrumb">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="<?=base_url()?>">Home</a></li>
					<li class="active"><?=$produtoCompleto['TITLE_SEO'];?></li>
				</ul>
			</div>
		</div>

		<?php

		//echo json_encode($produtoCompleto);
		?>
		<!-- /BREADCRUMB -->
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!--  Product Details -->
					<div class="product product-details clearfix">
						<div class="col-md-6">
							<div id="product-main-view">
								<?php
									foreach ($fotosProduto as $foto) {
								?>
								<div class="product-view">
									<img src="<?=base_url().$foto['FOTO_PRODUTO']?>" alt="">
								</div>
								<?php
									}
								?>
							</div>
							<div id="product-view">
								<?php
									foreach ($fotosProduto as $foto) {
								?>
								<div class="product-view">
									<img src="<?=base_url().$foto['FOTO_PRODUTO']?>" alt="">
								</div>
								<?php
									}
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="product-body">

								<?php 

								$promocaoExistente = date("d-m-Y", strtotime($produtoCompleto['DTA_FINAL_PROMO'])) >= date("d/m/Y") ? true : false;

								?>

								<!--div class="product-label">
									<span>New</span>
									<span class="sale">-20%</span>
								</div-->
								<h2 class="product-name produto-cor"><?=$produtoCompleto['NOME_PRODUTO']?></h2>

								<?php 
									if($promocaoExistente){
								?>

								<h3 class="product-price price-success">R$ <?=number_format((float)$produtoCompleto['PRECO_PROMO_PRODUTO'], 2, ',', '');?>&nbsp;<del class="price-default">R$ <?=number_format((float)$produtoCompleto['PRECO_PRODUTO'], 2, ',', '');?></del></h3>

								<?php
									}
								?>
								
								<div>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<a href="#">3 Avaliações(s) / Avaliar</a>
								</div>
								<p><strong>Código:</strong> <?=$produtoCompleto['EAN_PRODUTO']?></p>
								<p><strong>Disponibilidade:</strong> Em estoque</p>
								<p><strong>Marca:</strong> E-SHOP</p>
								<p><strong>Quantidade:</strong> 2</p>
								
								<!--div class="product-options">
									<ul class="size-option">
										<li><span class="text-uppercase">Size:</span></li>
										<li class="active"><a href="#">S</a></li>
										<li><a href="#">XL</a></li>
										<li><a href="#">SL</a></li>
									</ul>
									<ul class="color-option">
										<li><span class="text-uppercase">Color:</span></li>
										<li class="active"><a href="#" style="background-color:#475984;"></a></li>
										<li><a href="#" style="background-color:#8A2454;"></a></li>
										<li><a href="#" style="background-color:#BF6989;"></a></li>
										<li><a href="#" style="background-color:#9A54D8;"></a></li>
									</ul>
								</div-->

								<div class="product-btns">
									<div class="qty-input hidden">
										<span class="text-uppercase">QTY: </span>
										<input class="input" type="number">
									</div>
									<button
										data-sku="<?=$produtoCompleto['EAN_PRODUTO']?>"
										data-nome-produto="<?=$produtoCompleto['NOME_PRODUTO']?>"
										data-img="<?=$produtoCompleto['FOTO_CAPA']?>"
										 class="primary-btn add-cart btn-adicionar"><i class="fa fa-shopping-cart"></i> COMPRAR</button>



									<!--div class="pull-right">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
									</div-->
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="product-tab">
								<ul class="tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
									<li><a data-toggle="tab" href="#avaliacoes">Avaliações (3)</a></li>
								</ul>
								<div class="tab-content">
									<div id="tab1" class="tab-pane fade in active">
										<div id="descricao-produto"> 
										</div>
										
									</div>
									<div id="avaliacoes" class="tab-pane fade in">

										<div class="row">
											<div class="col-md-6">
												<div class="product-reviews">
													<div class="single-review">
														<div class="review-heading">
															<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
															<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
															<div class="review-rating pull-right">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
																irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
														</div>
													</div>

													<div class="single-review">
														<div class="review-heading">
															<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
															<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
															<div class="review-rating pull-right">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
																irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
														</div>
													</div>

													<div class="single-review">
														<div class="review-heading">
															<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
															<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
															<div class="review-rating pull-right">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
																irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
														</div>
													</div>

													<ul class="reviews-pages">
														<li class="active">1</li>
														<li><a href="#">2</a></li>
														<li><a href="#">3</a></li>
														<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
													</ul>
												</div>
											</div>
											<div class="col-md-6">
												<h4 class="text-uppercase">Write Your Review</h4>
												<p>Your email address will not be published.</p>
												<form class="review-form">
													<div class="form-group">
														<input class="input" type="text" placeholder="Your Name" />
													</div>
													<div class="form-group">
														<input class="input" type="email" placeholder="Email Address" />
													</div>
													<div class="form-group">
														<textarea class="input" placeholder="Your review"></textarea>
													</div>
													<div class="form-group">
														<div class="input-rating">
															<strong class="text-uppercase">Your Rating: </strong>
															<div class="stars">
																<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
																<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
																<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
																<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
																<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
															</div>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
											</div>
										</div>



									</div>
								</div>
							</div>
						</div>

					</div>
					<!-- /Product Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
	<!-- /section -->

		<div id="adicionarCarrrinhoModal" class="modal fadeIn animated" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header" style="border-bottom: none;">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>
		      <div class="modal-body">
		        <div style="text-align:center;">
		        	<i style="color:#3376b8;" class="fa fa-4x fa-check-circle" aria-hidden="true"></i>
		        	<p style="font-size:20px;color:#3376b8;
				font-family: 'Open Sans',sans-serif;">SUCESSO</p>
			        <p style="font-size:20px;color:#3376b8;
				font-family: 'Open Sans',sans-serif;">Produto adicionado ao carrinho com sucesso!</p>

					<div style="padding-top:10px;">
						<button style="background:#3376b8;color:#fff;" class="btn btn-default" data-dismiss="modal">CONTINUAR COMPRANDO</button>
						<button onclick="window.location.href='<?=base_url()?>index.php/carrinho'" class="btn add-cart" data-dismiss="modal">IR PARA O CARRINHO</button>
					</div>
		        </div>
		      </div>
		      <div class="modal-footer" style="border-top: none;">
		      </div>
		    </div>

		  </div>
		</div>

   
        <?php $this->load->view('/inc/footer');?>
        <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <!-- JS PRODUTO -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
       
        <script src="<?=base_url()?>assets/js/produtocatalogo/jquery.zoom.js"></script>
        <script src="<?=base_url()?>assets/js/produtocatalogo/produto.js"></script>
       	
        <script>
        //funções manipulaão produto
        $(function(){

        	var editorTexto = new Quill('#descricao-produto');
        	editorTexto.setContents(<?=$produtoCompleto["DES_PRODUTO"]?>);
        	
        	$("div.category-nav").addClass("show-on-click");
        	
        });
        </script>
	</body>
</html>