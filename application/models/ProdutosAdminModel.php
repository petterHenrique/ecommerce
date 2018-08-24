<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdutosAdminModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function buscarProdutos()
    {
    	$this->db->limit(20);
    	$dados = $this->db->get('produto')->result_array();
        return $dados;
    }

    public function buscarTodasCategorias()
    {
    	$this->db->where("TIP_ATIVO", true);
    	$dados = $this->db->get('categorias')->result_array();
        return $dados;
    }

    public function buscarPaginaPorId($id){
		$this->db->where("COD_PAGINA", $id);
    	$dados = $this->db->get('paginas')->result_array();
        if($dados){
        	return $dados;
        }else{
        	return array();
        }
    }

    public function salvar($dados){
    	$inserir = $this->db->insert('paginas', $dados);
    	if($inserir){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function editar($dados, $id){
    	$this->db->where("COD_PAGINA", $id);
    	$atualizar = $this->db->update('paginas', $dados);
    	if($atualizar){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function excluir($id){
    	$this->db->where('COD_PAGINA', $id);
    	$remover = $this->db->delete('paginas');
    	if($remover){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function pesquisarPagina($dadosPesquisa){
    	if(empty($dadosPesquisa)){
    		return array();
    	}else{
    		$resultado = $this->db->like('TITULO_PAGINA', $dadosPesquisa)
             ->or_like('DES_PAGINA', $dadosPesquisa)
             ->get('paginas');
    		return $resultado->result_array();
    	}
    }
}
