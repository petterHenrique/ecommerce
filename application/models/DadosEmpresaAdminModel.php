<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DadosEmpresaAdminModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function buscarDadosEmpresa()
    {
    	$this->db->limit(1);
    	$dados = $this->db->get('dados_empresa')->result_array();
        return $dados;
    }

    public function salvar($dados){

    	if($dados['COD_DADO'] != 0){
    		$this->db->where("COD_DADO", $dados['COD_DADO']);
    		$this->db->update('dados_empresa', $dados);
    	}else{
    		$this->db->insert('dados_empresa', $dados);
    	}

    	return true;
    }

    public function editar($dados, $id){
    	$this->db->where("COD_CATEGORIA", $id);
    	$atualizar = $this->db->update('categorias', $dados);
    	if($atualizar){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function excluir($id){
    	$this->db->where('COD_CATEGORIA', $id);
    	$remover = $this->db->delete('categorias');
    	if($remover){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function pesquisarCategoria($dadosPesquisa){
    	if(empty($dadosPesquisa)){
    		return array();
    	}else{
    		$resultado = $this->db->like('NOME_CATEGORIA', $dadosPesquisa)
             ->or_like('DES_CATEGORIA', $dadosPesquisa)
             ->or_like('URL_AMIGAVEL_CATEGORIA', $dadosPesquisa)
             ->or_like('TITLE_SEO', $dadosPesquisa)
             ->get('categorias');
    		return $resultado->result_array();
    	}
    }
}
