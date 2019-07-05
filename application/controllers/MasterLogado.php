<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MasterLogado extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->verificaAcesso();
    }

    public function logado()
    {
    	$bool = $_SESSION["logado"];
    	if($bool == 1){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function verificaAcesso(){
    	//aqui eu busco da api se contem uma lista de usuarios a serem deslogados

    	$this->load->model("LoginModel");

    	$dados = $this->LoginModel->retornarSessoesDeslogar();

    	if(!empty($dados)){

    		foreach ($dados as $sessao) {
    			session_id($sessao->DES_SESSION);
				 
				if(!isset($_SESSION)){
					session_start();
				}
				 
				session_cache_expire(10);
				session_unset();
    		}
    	}

    	$bool = $_SESSION["logado"];

    	if($bool == 1){
    		return true;
    	}else{
    		session_destroy();
			header("Location: ".base_url()."index.php/login");
    	}
    }
}
