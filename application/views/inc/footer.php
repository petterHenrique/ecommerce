<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
					            <img src="https://logosbynick.com/wp-content/uploads/2018/03/final-logo-example.png" alt="">
					        </a>
						</div>
						<!-- /footer logo -->
						<p>Confira a linha de produtos, panelas faqueiros, acessórios para cozinha totalmente produzidos com aço inox.</p>
						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<!--li><a href="#"><i class="fa fa-twitter"></i></a></li>
							
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li-->
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Minha Conta</h3>
						<ul class="list-links">
							<li><a href="#">Meus Pedidos</a></li>
							<li><a href="#">Favoritos</a></li>
							<li><a href="#">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Institucional</h3>
						<ul class="list-links">
							<?php 
								foreach ($paginas as $pagina) {
							?>
							<li><a href="#"><?=$pagina['TITULO_PAGINA']?></a></li>

							<?php
							}
							?>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Newsletter</h3>
						<p>Fique por dentro de todas as novidades da loja, receba dicas e promoções gratuitamente.</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Informe seu melhor e-mail">
							</div>
							<button class="primary-btn primary-btn2">Cadastrar</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						&copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://www.upsy.com.br" target="_blank">Upsy e-Commerce</a>
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->
	<script src="<?=base_url()?>assets/jstema/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/jstema/bootstrap-tema.min.js"></script>
    <script src="<?=base_url()?>assets/jstema/nouislider.min.js"></script>
    <script src="<?=base_url()?>assets/jstema/slick.min.js"></script>
    <script src="<?=base_url()?>assets/jstema/jquery.zoom.min.js"></script>
    <script src="<?=base_url()?>assets/jstema/main.js"></script>
    <script src="<?=base_url()?>assets/js/pnotify.custom.min.js"></script>
    <script src="<?=base_url()?>assets/js/notificacao.js"></script>