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
    	$bool = $_SESSION["logado"];
    	if($bool == 1){
    		return true;
    	}else{
    		session_destroy();
			header("Location: ".base_url()."index.php/login");
    	}
    }
}
