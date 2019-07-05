<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "Util.php";

class Produtos extends CI_Controller {

	public function index()
	{
		
	}

	public function detalhe(){

		$urlAmigavel = $this->uri->segment(3);//$this->input->get('url');

		if(!empty($urlAmigavel)){

			$this->load->model('PaginasAdminModel');
			$this->load->model('ProdutosAdminModel');
			$this->load->model('DadosEmpresaAdminModel');

			$dados['dadosEmpresa'] = $this->DadosEmpresaAdminModel->buscarDadosEmpresa()[0];

			$dados['paginas'] = $this->PaginasAdminModel->buscarTodasPaginasAtivas();

			$dados['carrinhoCabecalho'] = Util::TotalCarrinhoCompras();

			$dados['categorias'] = $this->categoriasSite();

			$dados['avaliacoes'] = $this->ProdutosAdminModel->buscarAvaliacoesProduto($urlAmigavel);

			$produto = $this->ProdutosAdminModel->buscarProdutoUrlAmigavel($urlAmigavel);

			//verifica se o produto existe
			if(empty($produto)){
				redirect('/produto/Redirect404');
			}else{
				$dados['produto'] = $produto;
				$this->load->view('/produto', $dados);
			}
		}else{

		}
		
	}

	public function Redirect404(){

		$this->load->view('/Redirect404');
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


	//solicita orçamento

	public function solicitarOrcamento(){
		try{

			$codigoProduto = $this->input->post('codigoProduto');
			$desCliente = $this->input->post('desCliente');
			$desEmail = $this->input->post('desEmail');
			$desTelefone = $this->input->post('desTelefone');
			$desUf = $this->input->post('desUf');

			$model = array(
				'COD_PRODUTO' => $codigoProduto, 
				'DES_CLIENTE' => $desCliente, 
				'DES_TELEFONE' => $desTelefone, 
				'DES_EMAIL' => $desEmail, 
				'DES_UF' => $desUf, 
				'COD_STATUS' => 1,
				'DTA_SOLICITACAO' => date("Y-m-d H:i:s")
			);

			$this->load->model('ProdutosAdminModel');

			$salvarOrcamento = $this->ProdutosAdminModel->salvarOrcamento($model);

			if($salvarOrcamento){
				$this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true)
        		));
			}else{
				throw new Exception("Ocorreu um erro ao enviar, tente mais tarde :(", 1);
			}
		}catch(Exception $e){
			$this->output
				->set_status_header(401)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}
	}
}
