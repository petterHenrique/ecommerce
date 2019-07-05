<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paginas extends CI_Controller {

	function __construct(){

		parent::__construct();

		$dados = array();

		$this->load->model('PaginasAdminModel');
		$this->load->model('ProdutosAdminModel');
		$this->load->model('DadosEmpresaAdminModel');
	}

	public function detalhe()
	{
		
		$urlAmigavel = $this->uri->segment(3);

		if(!empty($urlAmigavel)){
			
			$dados['pagina'] = $this->PaginasAdminModel->buscarPaginaPorUrlAmigavel($urlAmigavel);

			$dados['paginas'] = $this->PaginasAdminModel->buscarTodasPaginasAtivas();

			$dados['dadosEmpresa'] = $this->DadosEmpresaAdminModel->buscarDadosEmpresa()[0];

			$dados['armasfogo'] = $this->ProdutosAdminModel->buscarProdutosPorCategoria('Armas de Fogo');

			$this->load->view("/paginas", $dados);
		}
	}
}
