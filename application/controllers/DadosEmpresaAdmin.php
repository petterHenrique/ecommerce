<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class DadosEmpresaAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("DadosEmpresaAdminModel");
		$dados['dados'] = $this->DadosEmpresaAdminModel->buscarDadosEmpresa()[0];
		$this->load->view('/upadmin/dadosEmpresa/index', $dados);
	}

	public function salvar()
	{	

		$this->load->model('DadosEmpresaAdminModel');

		$codigo = $this->input->post('codigo');
		$email = $this->input->post('email');
		$telefone = $this->input->post('telefone');
		$whats = $this->input->post('whats');
		$horario = $this->input->post('horario');
		$facebook = $this->input->post('facebook');
		$instagram = $this->input->post('instagram');
		$descricaoRodape = $this->input->post('descricaoRodape');
		$title = $this->input->post('title');
		$keywords = $this->input->post('keywords');
		$description = $this->input->post('description');


		$entidade = array(
			'COD_DADO' => $codigo, 
			'DES_TELEFONE' => $telefone, 
			'DES_WHATSAPP' => $whats, 
			'DES_HORARIO' => $horario, 
			'DES_FACEBOOK' => $facebook, 
			'DES_INSTAGRAM' => $instagram, 
			'DES_RODAPE' => $descricaoRodape,
			'DES_TITLE' => $title, 
			'DES_KEYWORDS' => $keywords, 
			'DES_DESCRIPTION' => $description,
			'DES_EMAIL' => $email
		);

		
		$this->DadosEmpresaAdminModel->Salvar($entidade);
		
		$this->output
					->set_status_header(200)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'success' => 'Dados enviados com sucesso!')
        			  ));
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
				'TIP_ATIVO' => (bool)$dados['ativo'], 
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
