<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class MarcasAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("MarcasAdminModel");
		$dados['marcas'] = $this->MarcasAdminModel->buscarMarcas();
		$this->load->view('/upadmin/marcas/index', $dados);
	}

	public function criar()
	{
		$this->load->view('/upadmin/marcas/criar');
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

	public function salvarMarca(){
		try{
			
			$fileName = "";
			$pastaUplod = "";

			if(isset($_FILES['foto'])){
				//realiza o upload
				$fileName = $_FILES['foto']['name'];
				$pastaUplod = "uploads/media/";
				$upload = move_uploaded_file($_FILES['foto']['tmp_name'], './uploads/media/'.$fileName);

				if(!$upload){
					throw new Exception($_FILES['foto']['tmp_name'], 1);
				}
			}


			$this->load->model("MarcasAdminModel");

			//valida o model
			//$this->MarcasAdminModel->validarMarca($dados);
			
			//montar model
			$marca = array(
				'NOME_MARCA' => $_POST['nomeMarca'], 
				'DES_MARCA' => $_POST['nomeMarca'], 
				'URL_AMIGAVEL' => $_POST['nomeMarca'],  
				'KEYWORD_SEO' => $_POST['nomeMarca'], 
				'DESCRIPTION_SEO' => $_POST['nomeMarca'], 
				'TITLE_SEO' => $_POST['nomeMarca'], 
				'TIP_ATIVO' => $_POST['ativo'], 
				'FOTO_MARCA' => $pastaUplod.$fileName 
			);

			//verifica se é edição ou cadastro
			$salvar = array();

			if($_POST['codigoMarca'] != "0"){
				$salvar = $this->MarcasAdminModel->editar($marca, $_POST['codigoMarca']);

			}else{
				$salvar = $this->MarcasAdminModel->salvar($marca);
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
