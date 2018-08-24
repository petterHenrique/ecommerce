<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function teste(){
		$jsonArray = file_get_contents('php://input');
		$this->output
		        	->set_status_header(200)
					->set_content_type('application/json')
        			->set_output($jsonArray);
	}

	public function logar(){
		try{

			$modelLogin = $this->load->model("LoginModel");

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
			echo var_dump($e->getMessage());
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
		redirect('login/index');
	}
}
