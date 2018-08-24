<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarcasAdminModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function buscarMarcas()
    {
    	$this->db->limit(20);
    	$dados = $this->db->get('marca')->result_array();
        return $dados;
    }

    public function buscarTodasMarcas()
    {
    	$this->db->where("TIP_ATIVO", true);
    	$dados = $this->db->get('marca')->result_array();
        return $dados;
    }

    public function buscarMarcaPorId($id){
		$this->db->where("COD_MARCA", $id);
    	$dados = $this->db->get('marca')->result_array();
        if($dados){
        	return $dados;
        }else{
        	return array();
        }
    }

    public function salvar($dados){
    	$inserir = $this->db->insert('marca', $dados);
    	if($inserir){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function editar($dados, $id){
    	$this->db->where("COD_MARCA", $id);
    	$atualizar = $this->db->update('marca', $dados);
    	if($atualizar){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function excluir($id){
    	$this->db->where('COD_MARCA', $id);
    	$remover = $this->db->delete('marca');
    	if($remover){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function pesquisarMarca($dadosPesquisa){
    	if(empty($dadosPesquisa)){
    		return array();
    	}else{
    		$resultado = $this->db->like('NOME_MARCA', $dadosPesquisa)
             ->or_like('DES_MARCA', $dadosPesquisa)
             ->get('marca');
    		return $resultado->result_array();
    	}
    }
}
