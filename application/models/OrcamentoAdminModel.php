<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrcamentoAdminModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function buscarOrcamentos($limit)
    {
    	return $this->db->select("orcamento.*, produto.NOME_PRODUTO, produto.COD_PRODUTO")
               	->join("produto", "orcamento.COD_PRODUTO=produto.COD_PRODUTO")
               	->limit($limit)
               	->order_by("DTA_SOLICITACAO", "DESC")
               	->get("orcamento")->result_array();
    }

    public function AtualizarStatusOrcamento($codOrcamento, $codigoStatus){
		$orcamento = array('COD_STATUS' => $codigoStatus);    
		$this->db->where('COD_ORCAMENTO', $codOrcamento);
		$this->db->update('orcamento', $orcamento); 
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
