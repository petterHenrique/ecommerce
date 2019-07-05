<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class BannersAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("BannersAdminModel");
		$dados['banners'] = $this->BannersAdminModel->buscarBanners();
		$this->load->view('/upadmin/banners/index', $dados);
	}

	public function criar()
	{
		//$this->load->model("PaginasAdminModel");
		$this->load->view('/upadmin/banners/criar');
	}

	public function editar(){
		$id = $this->input->get("id");
		if(!empty($id)){
			$this->load->model("BannersAdminModel");
			$dados["banner"] = $this->BannersAdminModel->buscarBanerPorId($id);
			$this->load->view('/upadmin/banners/editar', $dados);
		}else{
			redirect("/upadmin/banners/index");
		}
	}

	public function excluirBaner(){
		$dados = $this->input->post("id");
		if(!empty($dados)){
			$this->load->model("BannersAdminModel");
			if($this->BannersAdminModel->excluir($dados)){
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

	public function pesquisarBaner(){
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

	public function salvarBanner(){
		try{
			//verifica se contem arquivo para upload
			if(isset($_FILES)){

				$fileName = $_FILES['foto']['name'];
				$pastaUplod = "uploads/media/";
				$upload = move_uploaded_file($_FILES['foto']['tmp_name'], './uploads/media/'.$fileName);

				if(!$upload){
					throw new Exception($_FILES['foto']['tmp_name'], 1);
				}

				$dados = $this->input->post("banner", true);
				$this->load->model("BannersAdminModel");
				//montar model
				$banner = array(
					'NOME_BANER' => $_POST['nomeBanner'], 
					'FOTO_BANER' => $pastaUplod.$fileName, 
					'LINK_BANER' => $_POST['urlBanner'],
					'POSICAO_BANER' => $_POST['posicaoBanner'],
					'TIP_ATIVO' => (bool)$_POST['ativo']
				);

				//verifica se é edição ou cadastro
				$salvar = array();

				//aqui ele verifica se editará ou atualizará
				if($_POST['codigoBanner'] != "0"){
					$salvar = $this->BannersAdminModel->editar($banner, $_POST['codigoBanner']);
				}else{
					$salvar = $this->BannersAdminModel->salvar($banner);
				}		

				//

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
			}else{
				throw new Exception("Nenhum arquivo selecionado!", 1);
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

	public function uploadImagem($dados)
	{       

		$arquivo = $dados;
		

		$config = array(
			'upload_path' => "./uploads/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000",
			'max_height' => "768",
			'max_width' => "1024"
		);

		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('foto'))
		{
			return $this->upload->data();
		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}
	}
}
