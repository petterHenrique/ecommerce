<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class FreteAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("FreteModel");
		$dados['dadosFrete'] = $this->FreteModel->buscarConfiguracoesFreteCorreios();
		$this->load->view('/upadmin/dadosfrete/index', $dados);
	}


	public function salvar(){

		try{

			$codigo = $this->input->post("codigo");
			$cep = $this->input->post("cep");
			$contrato = $this->input->post("contrato");
			$senhacontrato = $this->input->post("senhacontrato");
			$valoradicional = $this->input->post("valoradicional");
			$prazoentregadias = $this->input->post("prazoentregadias");
			$ativo = $this->input->post("ativo");
			$maopropria = $this->input->post("maopropria");
			$valordeclarado = $this->input->post("valordeclarado");


			$entidade = array(
				'COD_CONFIG' => $codigo,
				'CEP_ORIGEM' => $cep,
				'COD_CONTRATO' => $contrato,
				'SENHA_CONTRATO' => $senhacontrato,
				'ATIVO' => (bool)$ativo,
				'MAO_PROPRIA' => (bool)$maopropria,
				'VALOR_DECLARADO' => $valordeclarado,
				'VALOR_ADICIONAL' => $valoradicional,
				'PRAZO_ENTREGA_DIAS' => $prazoentregadias
			);

			$this->load->model('FreteModel');

			$salvar = $this->FreteModel->salvarConfiguracoesCorreios($entidade);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true)
        		));

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
