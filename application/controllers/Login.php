<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $this->load->helper('url');
		$this->load->view('login');
	}

	public function teste(){
		
		$modelLogin = $this->load->model("LoginModel");

		

		echo $dado->tipAtivo;
	}


	public function logar(){
		try{

			$modelLogin = $this->load->model("LoginModel");


			//verifico se o cliente ta ativo

			//$clienteUpsy = $this->LoginModel->verificarClienteAtivo();
			$clienteUpsyAtivo = true;//(boolean)$clienteUpsy->tipAtivo;

			if($clienteUpsyAtivo == false){
				throw new Exception("Usuário inativo, parcelas e valores pendentes, entrar em contato com pedro@upsy.com.br", 1);
			}


			$email = $this->input->post("email", true);
			$senha = $this->input->post("senha", true);

			$resultado = $this->LoginModel->buscarUsuarioAdmin($email, $senha);

			if($resultado){

				$dadosSessaoUsuario = array(
					'codigoUsuario'=> $resultado[0]['COD_USUARIO'],
		            'nomeUsuario'  => $resultado[0]['NOME_USUARIO'],
		            'emailUsuario' => $resultado[0]['EMAIL_USUARIO'],
		            'logado' => TRUE
		        );
		        $this->session->set_userdata($dadosSessaoUsuario);


		        //aqui eu gravo o cliente e a sessao
		        $sessionId = session_id();

		        
		        $this->LoginModel->salvarSessaoUpsy(1, $sessionId);

		        $this->output
		        	->set_status_header(200)
					->set_content_type('application/json')
        			->set_output(json_encode("Logado com sucesso! Aguarde ..."));
			}else{
				$this->output
					->set_status_header(400)
					->set_content_type('application/json')
        			->set_output(json_encode("Usuário ou senha inválidos!"));
			}
		}catch(Exception $e){
			$this->output
					->set_status_header(400)
					->set_content_type('application/json')
        			->set_output(json_encode($e->getMessage()));
		}
	}

	public function deslogar(){

		$this->session->unset_userdata(
			array("emailUsuario"=>"",
				  "codigoUsuario"=>"",
				  "nomeUsuario"=>"",
				  "logado"=>FALSE)
			);

		$this->session->sess_destroy();
		header("Location: /upsycommerce/index.php/login");
		//redirect('/login/index');
	}
}
