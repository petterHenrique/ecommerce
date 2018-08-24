<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function buscarUsuarioAdmin($email, $senha)
    {
    	$this->db->where('EMAIL_USUARIO', $email);
    	$this->db->where('SENHA_USUARIO', md5($senha));
    	$this->db->where('TIP_ATIVO', true);
    	$dados = $this->db->get('usuarios')->result_array();
        return $dados;
    }
}
