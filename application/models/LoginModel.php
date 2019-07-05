<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function buscarUsuarioLoja($email, $senha){
		$this->db->where('EMAIL_CLIENTE', $email);
    	$this->db->where('SENHA_CLIENTE', md5($senha));
    	$dados = $this->db->get('cliente')->result_array();
        return $dados;
	}

	public function buscarEnderecoEntregaClienteLogado($codigoCLiente){

		$this->db->where('COD_CLIENTE', $codigoCLiente);
		$this->db->where('TIP_ENTREGA', true);
		$dados = $this->db->get('enderecos')->result_array();
		return $dados;
	}

	public function buscarUsuarioAdmin($email, $senha)
    {
    	$this->db->where('EMAIL_USUARIO', $email);
    	$this->db->where('SENHA_USUARIO', md5($senha));
    	$this->db->where('TIP_ATIVO', true);
    	$dados = $this->db->get('usuarios')->result_array();
        return $dados;
    }

    public function verificarClienteAtivo(){

    	$url = "https://www.upsy.com.br/sgclientes/clientes/verificarCliente/1";

	    ob_start();

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	    curl_exec($ch);

	    // JSON de retorno  
	    $resposta = json_decode(ob_get_contents());
	    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	    ob_end_clean();
	    curl_close($ch);

	    return $resposta;

    }

    public function salvarSessaoUpsy($id, $session){

    	$dado['codCliente'] = $id;
		$dado['sessao'] = $session;

    	$url = "https://www.upsy.com.br/sgclientes/clientes/gravarSessaoUsuario";

	    ob_start();

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dado));
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Content-Type: application/json',
	        'Content-Length: ' . strlen(json_encode($dado)))
	    );
	    curl_exec($ch);

	    // JSON de retorno  
	    $resposta = json_decode(ob_get_contents());
	    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	    ob_end_clean();
	    curl_close($ch);

	    return $resposta;
    }

    public function retornarSessoesDeslogar(){
    	$url = "https://www.upsy.com.br/sgclientes/clientes/deslogarUsuariosDevedores/1";

	    ob_start();

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	    curl_exec($ch);

	    // JSON de retorno  
	    $resposta = json_decode(ob_get_contents());
	    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	    ob_end_clean();
	    curl_close($ch);

	    return $resposta;
    }

}
