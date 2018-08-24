<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class PaginasAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("PaginasAdminModel");
		$dados['paginas'] = $this->PaginasAdminModel->buscarPaginas();
		$this->load->view('/upadmin/paginas/index', $dados);
	}

	public function criar()
	{
		//$this->load->model("PaginasAdminModel");
		$this->load->view('/upadmin/paginas/criar');
	}

	public function editar(){
		$id = $this->input->get("id");
		if(!empty($id)){
			$this->load->model("PaginasAdminModel");
			$dados["dadosPagina"] = $this->PaginasAdminModel->buscarPaginaPorId($id);
			$this->load->view('/upadmin/paginas/editar', $dados);
		}else{
			redirect("/upadmin/paginas/index");
		}
	}

	public function excluirPagina(){
		$dados = $this->input->post("id");
		if(!empty($dados)){
			$this->load->model("PaginasAdminModel");
			if($this->PaginasAdminModel->excluir($dados)){
				$this->output
					->set_status_header(200)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'success' => 'Página removida com sucesso!')
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

	public function pesquisarPagina(){
		$dados = $this->input->post("dados");
		$this->load->model("PaginasAdminModel");
		if(!empty($dados)){
			$resultado = $this->PaginasAdminModel->pesquisarPagina($dados);
			if(count($resultado)>0){
				$result["paginas"] = $resultado;
				$this->load->view("/upadmin/paginas/pesquisaPagina", $result);
			}else{
				$result["paginas"] = $this->PaginasAdminModel->buscarCategorias();
				$this->load->view("/upadmin/paginas/pesquisaPagina", $result);
			}
		}else{
			$result["paginas"] = $this->PaginasAdminModel->buscarPaginas();
			$this->load->view("/upadmin/paginas/pesquisaPagina", $result);
		}
	}

	public function salvarPagina(){
		try{
			
			$dados = $this->input->post("pagina", true);
			$this->load->model("PaginasAdminModel");
			//montar model
			$pagina = array(
				'TITULO_PAGINA' => $dados['nomePagina'], 
				'DES_PAGINA' => $dados['descricaoPagina'], 
				'TIP_ATIVO' => $dados['ativo']
			);
			//verifica se é edição ou cadastro
			$salvar = array();

			if($dados['codigoPagina'] != "0"){
				$salvar = $this->PaginasAdminModel->editar($pagina, $dados['codigoPagina']);

			}else{
				$salvar = $this->PaginasAdminModel->salvar($pagina);
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

	/*UPLOAD DE ARQUIVOS DO EDITOR DE TEXTO*/

	public function uploadImagens()
	{       
	    $files = $_FILES;
	    $arrayArquivos = array();
		$total = count($_FILES['arquivos']['name']);

		for($i=0; $i<$total;$i++){

		   $fileName = $_FILES['arquivos']['name'][$i];

		   array_push($arrayArquivos, $fileName);

		   move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], './uploads/media/'.$fileName);

		}	   

    	$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode(array(
			'success' => 'Upload Realizado com sucesso!',
			'imagens' => $arrayArquivos)
		  ));
	}
}
