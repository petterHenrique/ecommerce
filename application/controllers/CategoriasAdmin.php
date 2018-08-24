<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class CategoriasAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("CategoriasAdminModel");
		$dados['categorias'] = $this->CategoriasAdminModel->buscarCategorias();
		$this->load->view('/upadmin/categorias/index', $dados);
	}

	public function criar()
	{
		$this->load->model("CategoriasAdminModel");
		$dados['categorias'] = $this->CategoriasAdminModel->buscarTodasCategorias();
		$this->load->view('/upadmin/categorias/criar', $dados);
	}

	public function editar(){
		$id = $this->input->get("id");
		if(!empty($id)){
			$this->load->model("CategoriasAdminModel");
			$dados["categorias"] = $this->CategoriasAdminModel->buscarCategoriaId($id);
			$dados["todasCategorias"] = $this->CategoriasAdminModel->buscarTodasCategorias();
			$this->load->view('/upadmin/categorias/editar', $dados);
		}else{
			redirect("/upadmin/categorias/index");
		}
	}

	public function excluirCategoria(){
		$dados = $this->input->post("id");
		if(!empty($dados)){
			$this->load->model("CategoriasAdminModel");
			if($this->CategoriasAdminModel->excluir($dados)){
				$this->output
					->set_status_header(200)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'success' => 'Categoria removida com sucesso!')
        			));
			}else{
				$this->output
					->set_status_header(401)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'error' => 'Não foi possível excluir!')
        			));
			}
		}
	}

	public function pesquisarCategoria(){
		$dados = $this->input->post("dados");
		$this->load->model("CategoriasAdminModel");
		if(!empty($dados)){
			$resultado = $this->CategoriasAdminModel->pesquisarCategoria($dados);
			if(count($resultado)>0){
				$result["categorias"] = $resultado;
				$this->load->view("/upadmin/categorias/pesquisaCategoria", $result);
			}else{
				$result["categorias"] = $this->CategoriasAdminModel->buscarCategorias();
				$this->load->view("/upadmin/categorias/pesquisaCategoria", $result);
			}
		}else{
			$result["categorias"] = $this->CategoriasAdminModel->buscarCategorias();
			$this->load->view("/upadmin/categorias/pesquisaCategoria", $result);
		}
	}

	public function salvarCategoria(){
		try{
			
			$dados = $this->input->post("categoria", true);
			$this->load->model("CategoriasAdminModel");

			//valida o model
			$this->CategoriasAdminModel->validarCategoria($dados);
			
			//montar model
			$categoria = array(
				'NOME_CATEGORIA' => $dados['nomeCategoria'], 
				'DES_CATEGORIA' => $dados['descricaoCategoria'], 
				'URL_AMIGAVEL_CATEGORIA' => $dados['urlAmigavel'], 
				'COD_PAI_CATEGORIA' => $dados['categoriaPai'], 
				'KEYWORD_SEO' => $dados['keywordsSeo'], 
				'DESCRIPTION_SEO' => $dados['descriptionSeo'], 
				'TITLE_SEO' => $dados['titleSeo'], 
				'TIP_ATIVO' => $dados['ativo'], 
				'FOTO_CATEGORIA' => $dados['foto'], 
			);

			//verifica se é edição ou cadastro
			$salvar = array();

			if($dados['codigoCategoria'] != "0"){
$salvar = $this->CategoriasAdminModel->editar($categoria, $dados['codigoCategoria']);

			}else{
				$salvar = $this->CategoriasAdminModel->salvar($categoria);
			}			
			if($salvar){
				$this->output
					->set_status_header(200)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'success' => 'Dados enviados com sucesso!')
        			  ));
			}else{
				$this->output
					->set_status_header(401)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'error' => 'Ocorreu um erro tente novamente!')
        			  ));
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
