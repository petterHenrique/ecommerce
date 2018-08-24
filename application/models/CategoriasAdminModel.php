<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriasAdminModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function buscarCategorias()
    {
    	$this->db->limit(20);
    	$dados = $this->db->get('categorias')->result_array();
        return $dados;
    }

    public function buscarTodasCategorias()
    {
    	$this->db->where("TIP_ATIVO", true);
    	$dados = $this->db->get('categorias')->result_array();
        return $dados;
    }

    public function buscarCategoriaId($id){
		$this->db->where("COD_CATEGORIA", $id);
    	$dados = $this->db->get('categorias')->result_array();
        if($dados){
        	return $dados;
        }else{
        	return array();
        }
    }

    public function salvar($dados){
    	$inserir = $this->db->insert('categorias', $dados);
    	if($inserir){
    		return true;
    	}else{
    		return false;
    	}
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

    //metodos de validação

    public function validarCategoria($dados){
    	if(empty($dados['nomeCategoria'])){
    		throw new Exception("Preencha o campo Nome Categoria");
    	}
    	else if(empty($dados['descricaoCategoria'])){
    		throw new Exception("Preencha o campo Descrição Categoria");
    	}
    	else if(empty($dados['urlAmigavel'])){
    		throw new Exception("Preencha a URL amigável");
    	}
    	else if(empty($dados['keywordsSeo'])){
    		throw new Exception("Preencha o campo Keywords SEO");
    	}
    	else if(empty($dados['descriptionSeo'])){
    		throw new Exception("Preencha o campo Description SEO");
    	}
    	else if(empty($dados['titleSeo'])){
    		throw new Exception("Preencha o campo Title SEO");
    	}
    	//valida tamanho dos caracters

    	else if(strlen($dados['nomeCategoria']) > 45){
    		throw new Exception("Limite de caracters da categoria excedeu!");
    	}
    	else if(strlen($dados['descricaoCategoria']) > 200){
    	throw new Exception("Limite de caracters da descrição categoria excedeu!");
    	}
    	else if(strlen($dados['urlAmigavel']) > 200){
    		throw new Exception("Limite de caracters da url amigável excedeu!");
    	}
    	else if(strlen($dados['keywordsSeo']) > 200){
    		throw new Exception("Limite de caracters de keywords excedeu!");
    	}
    	else if(strlen($dados['descriptionSeo']) > 200){
    		throw new Exception("Limite de caracters da decription excedeu!");
    	}
    	else if(strlen($dados['titleSeo']) > 200){
    		throw new Exception("Limite de caracters de Title excedeu!");
    	}
    }
}
