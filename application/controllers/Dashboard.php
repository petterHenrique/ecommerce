<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class Dashboard extends MasterLogado {

	public function index()
	{
		if($this->logado()){
			$this->load->view('/upadmin/home');
		}else{
			session_destroy();
			header("Location: ".base_url()."index.php/login");
		}
	}
}
