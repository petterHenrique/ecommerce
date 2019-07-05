<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "Util.php";

class Home extends CI_Controller {

	public function index()
	{	
		$dados = array();

		$this->load->model('PaginasAdminModel');
		$this->load->model('ProdutosAdminModel');
		$this->load->model('DadosEmpresaAdminModel');

		$dados['categorias'] = $this->categoriasSite();

		$dados['paginas'] = $this->PaginasAdminModel->buscarTodasPaginasAtivas();

		$dados['destaques'] = $this->ProdutosAdminModel->buscarProdutosDestaques();

		$dados['carrinhoCabecalho'] = Util::TotalCarrinhoCompras();

		$dados['ultimosProdutos'] = $this->ProdutosAdminModel->buscarProdutosLimit();

		$dados['dadosEmpresa'] = $this->DadosEmpresaAdminModel->buscarDadosEmpresa()[0];

		
		$this->load->view('home_inicial', $dados);
	}


	public function teste(){
		$this->load->model('ProdutosAdminModel');

		$dados = $this->ProdutosAdminModel->buscarProdutosPorCategoria('Armas de Fogo');

		echo json_encode($dados);
	}

	private function categoriasSite(){

		$this->load->model('CategoriasAdminModel');

		$menusPai = $this->CategoriasAdminModel->buscarCategoriasAtivasMenuPai();

		$arrMenu = array();

		foreach ($menusPai as $categoria) {
			$filhas = $this->CategoriasAdminModel->buscarCategoriasAtivasMenuFilhas((int)$categoria['COD_CATEGORIA']);
			$menu = array(
				'COD_CATEGORIA' => $categoria['COD_CATEGORIA'], 
				'NOME_CATEGORIA' => $categoria['NOME_CATEGORIA'],
				'URL_AMIGAVEL_CATEGORIA' => $categoria['URL_AMIGAVEL_CATEGORIA'],
				'FILHAS' => $filhas
			);
			array_push($arrMenu, $menu);
		}

		return $arrMenu;
	}
}
