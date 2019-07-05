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

    public function buscarProdutosDestaques(){
    	$this->db->where("TIP_DESTAQUE", true);
    	$dados = $this->db->get('produto')->result_array();
        return $dados;
    }

    /*
	
    */
    public function buscarProdutosLimit($limit = null){

    	$this->db->limit(is_null($limit) ? 30 : $limit);
    	$dados = $this->db->get('produto')->result_array();
        return $dados;
    }

    public function buscarAvaliacoesProduto($url){

    	$this->db->select('COD_PRODUTO');
   		$this->db->from('produto');
    	$this->db->where('URL_AMIGAVEL_PRODUTO',$url);
    	$codigoProduto = $this->db->get()->row('COD_PRODUTO');


    	//resgato do banco de dados as avaliações
    	$avaliacoes = $this->db->select("avaliacoes.*, cliente.*")
               ->join("cliente", "cliente.COD_CLIENTE=avaliacoes.COD_CLIENTE")
               ->where("avaliacoes.TIP_ATIVO = 1")
               ->where("avaliacoes.COD_PRODUTO", $codigoProduto)
               ->get("avaliacoes")->result_array();

        return $avaliacoes;
    }

    public function buscarPrecoProduto($codigo){

    	$this->db->where('EAN_PRODUTO',$codigo);
    	$dados = $this->db->get('produto')->row()->PRECO_PRODUTO;
        return $dados;
    }

    public function buscarTodasCategorias()
    {
    	$this->db->where("TIP_ATIVO", true);
    	$dados = $this->db->get('categorias')->result_array();
        return $dados;
    }


    public function buscarProdutosPorCategoriaUrlAmigavel($url){
    	$produtos = $this->db->select("produto.*, produtos_categorias.COD_PRODUTO, categorias.COD_CATEGORIA, categorias.NOME_CATEGORIA, categorias.URL_AMIGAVEL_CATEGORIA")
               ->join("produtos_categorias", "produtos_categorias.COD_PRODUTO=produto.COD_PRODUTO")
               ->join("categorias", "categorias.COD_CATEGORIA=produtos_categorias.COD_CATEGORIA")
               ->where("categorias.URL_AMIGAVEL_CATEGORIA = '".$url."'")
               ->get("produto")->result_array();

        return $produtos;
    }

    public function buscarProdutosPorCategoria($string){

    	$produtos = $this->db->select("produto.*, produtos_categorias.COD_PRODUTO, categorias.COD_CATEGORIA, categorias.NOME_CATEGORIA")
               ->join("produtos_categorias", "produtos_categorias.COD_PRODUTO=produto.COD_PRODUTO")
               ->join("categorias", "produtos_categorias.COD_CATEGORIA=produtos_categorias.COD_CATEGORIA")
               ->where("categorias.NOME_CATEGORIA = '".$string."'")
               ->get("produto")->result_array();


        $produtosCompletos = array();

        foreach ($produtos as $prod) {

    		$fotos = $this->buscarFotosProduto($prod['COD_PRODUTO']);

        	$arr = array(
        		'COD_PRODUTO' => $prod['COD_PRODUTO'],
        		'NOME_PRODUTO' => $prod['NOME_PRODUTO'],
        		'URL_AMIGAVEL_PRODUTO' => $prod['URL_AMIGAVEL_PRODUTO'],
        		'PRECO_PRODUTO' => number_format($prod['PRECO_PRODUTO'],2,",","."),
        		'PRECO_PROMO_PRODUTO' => number_format($prod['PRECO_PROMO_PRODUTO'],2,",","."),
        		'DTA_INICIAL_PROMO' => $prod['DTA_INICIAL_PROMO'],
        		'DTA_FINAL_PROMO' => $prod['DTA_FINAL_PROMO'],
        		'FOTOS' => $fotos);

        	array_push($produtosCompletos, $arr);
        }


        return $produtosCompletos;
    }

    public function buscarProdutoUrlAmigavel($url){

    	$entidades = array();
    	
    	$this->db->where("URL_AMIGAVEL_PRODUTO", $url);
    	$produto = $this->db->get("produto")->result_array();
    	
    	if(!empty($produto)){
    		$produto = $produto[0];
    	}else{
    		$produto = null;
    	}

    	$entidades['produto'] = $produto;

    	$this->db->where("COD_PRODUTO", $produto['COD_PRODUTO']);
    	$fotosProduto = $this->db->get("fotos_produtos")->result_array();
    	
    	$entidades['fotos'] = $fotosProduto;

        if($entidades){
        	return $entidades;
        }else{
        	return array();
        }
    }

    public function buscarProdutoPorId($id){
		
    	$this->db->select('*');
		$this->db->from('produto');
		$this->db->where("COD_PRODUTO", $id);
		$dadosProduto = $this->db->get()->result_array();


		$this->db->select('COD_CATEGORIA');
		$this->db->from('produtos_categorias');
		$this->db->where("COD_PRODUTO", $id);
		$dadosCategoriaProduto = $this->db->get()->result_array();

		$this->db->select('*');
		$this->db->from('fotos_produtos');
		$this->db->where("COD_PRODUTO", $id);
		$fotosProduto = $this->db->get()->result_array();


		//atribui no array as categorias
		$dadosProduto[0]['CATEGORIAS'] = $dadosCategoriaProduto;

		//atribui as fotos do produto

		$dadosProduto[0]['FOTOS'] = $fotosProduto;


        if($dadosProduto){
        	return $dadosProduto;
        }else{
        	return array();
        }
    }

    public function buscarFotosProduto($id){
    	$this->db->where("COD_PRODUTO", $id);
    	$dados = $this->db->get('fotos_produtos')->result_array();
        if($dados){
        	return $dados;
        }else{
        	return array();
        }
    }

    public function salvar($dados){
    	$inserir = $this->db->insert('produto', $dados);
    	return $inserir = $this->db->insert_id();
    }

    public function editar($dados, $codigo){
    	$this->db->where("COD_PRODUTO", $codigo);
    	$atualizar = $this->db->update('produto', $dados);
    }

    public function salvarFotoProduto($dados){

    	$inserir = $this->db->insert('fotos_produtos', $dados);

    	if($inserir){
    		return true;
    	}else{
    		return false;
    	}
    	
    }

    public function salvarOrcamento($dados){

    	$inserir = $this->db->insert('orcamento', $dados);

    	if($inserir){
    		return true;
    	}else{
    		return false;
    	}
    	
    }

    public function retornarImagemCodigo($id){
    	$this->db->where("COD_FOTO_PRODUTO", $id);
    	$dados = $this->db->get('fotos_produtos')->result_array();
    	return $dados;
    }

    public function removerFoto($id){
    	$this->db->where('COD_FOTO_PRODUTO', $id);
    	$remover = $this->db->delete('fotos_produtos');
    }

    public function excluir($id){
    	$this->db->where('COD_PRODUTO', $id);
    	$remover = $this->db->delete('produto');
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

    public function BuscarQtdProdutoEstoque($codigoProduto){
    	$this->db->where('EAN_PRODUTO', $codigoProduto);
    	$this->db->select('ESTOQUE_PRODUTO');
		$dados = $this->db->get('produto');
		return $dados->row();
    }

    public function retornarDimensoesProdutoCodigo($codigoProduto){

    	//retorna a dimensao do produto somado.
		$this->db->where('EAN_PRODUTO', $codigoProduto);
		//$this->db->select(
			//'SUM(PESO_PRODUTO) + SUM(COMPRIMENTO_PRODUTO) + 
			//SUM(LARGURA_PRODUTO) + SUM(ALTURA_PRODUTO) 
			//as dimensaoProduto', FALSE);

    	$this->db->select('PESO_PRODUTO, COMPRIMENTO_PRODUTO, LARGURA_PRODUTO, ALTURA_PRODUTO');
		$dados = $this->db->get('produto');
		if($dados)
			return $dados->result_array();
    }
}
