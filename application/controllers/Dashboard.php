<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class Dashboard extends MasterLogado {

	public function index()
	{
		if($this->logado()){

			$this->load->model('OrcamentoAdminModel');

			$this->load->model('PagamentosModel');

			$dados['pedidos'] = $this->PagamentosModel->listarPedidos();

			$dados['orcamentos'] = $this->OrcamentoAdminModel->buscarOrcamentos(15);

			$dados['contadores'] = $this->PagamentosModel->contadoresGeral();


			$this->load->view('/upadmin/home', $dados);
		}else{
			session_destroy();
			header("Location: ".base_url()."index.php/login");
		}
	}


	public function enviarOrcamento(){
		try{

			$nomeCliente = $this->input->post("nome");
			$emailCliente = $this->input->post("email");
			$mensagem = $this->input->post("msg");
			$codOrcamento = $this->input->post("codigo");

	        //Inicia o processo de configuração para o envio do email
	        $config['protocol'] = 'mail'; // define o protocolo utilizado
	        $config['wordwrap'] = TRUE; // define se haverá quebra de palavra no texto
	        $config['validate'] = TRUE; // define se haverá validação dos endereços de email

	        $config['protocol'] = 'smtp';
	        $config['smtp_host'] ='smtp.kinghost.net';
	        $config['smtp_port'] = 587;
	        $config['smtp_user'] = 'contato@cacserra.com.br';
	        $config['smtp_pass'] = 'exercito2017';
	        $config['charset'] = 'UTF-8';


	        //aqui ele seta o email corpo de HTML
	        $this->email->set_mailtype("html");

	        // Inicializa a library Email, passando os parâmetros de configuração
	        $this->email->initialize($config);
	        
	        // Define remetente e destinatário
	        $this->email->from('contato@cacserra.com.br', 'Cac Serra - Armas e Acessórios'); // Remetente
	        $this->email->to($emailCliente, $nomeCliente); // Destinatário
	 
	        // Define o assunto do email
	        $this->email->subject('Re: Solicitação de Orçamento - Cac Serra');
	 
	        /*
	         	envia o template customizado para o cliente
	        */
	        $arrayTemplate = array(
	        	'email' => 'contato@cacserra.com.br', 
	        	'nomeCliente' => $nomeCliente,
	        	'mensagem' => $mensagem
	        );
	        
	        $dados['dados'] =  $arrayTemplate;

	        $this->email->message($this->load->view('/templatesmail/orcamento-mail',$dados, TRUE));


	        if($this->email->send())
	        {

	        	//atualiza o orcamento para enviado
	        	$this->load->model('OrcamentoAdminModel');
	        	//atualiza para enviado
	        	$this->OrcamentoAdminModel->AtualizarStatusOrcamento($codOrcamento,2);

	            $this->output
					->set_status_header(200)
					->set_content_type('application/json')
	        		->set_output(json_encode(array(
	        			'successo' => true)
	        		));
	        }
	        else
	        {
	            throw new Exception("Não foi possível enviar o orçamento", 1);
	        }
		}catch(Exception $e){
			$this->output
				->set_status_header(404)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}
	}
}
