<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrinho extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('cart');
	}

	private function _set_headers() {
	    header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
	    header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i(worry)' ) . ' GMT' ); 
	    header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
	    header( 'Cache-Control: post-check=0, pre-check=0', false ); 
	    header( 'Pragma: no-cache' );
	}

	public function index()
	{
		$produtos['produtos'] = $this->cart->contents();
		$this->load->view('/carrinho', $produtos);
	}

	public function te(){
		echo json_encode($this->cart->contents());
	}

	//metodos gerenciamento do carrinho
	public function adicionarAlgunsProduto(){
		
		$data = array(
            'id' => 1, 
            'name' => "Nike Stefan Janoski", 
            'price' => 18.20, 
            'qty' => 2, 
        );
        $data2 = array(
            'id' => 2, 
            'name' => "Camiseta Nike Stefan Janoski", 
            'price' => 18.20, 
            'qty' => 2, 
        );

        $this->cart->insert($data);
        $this->cart->insert($data2);
        echo var_dump($this->cart->contents());
	}

	//metodos gerenciamento do carrinho

	public function atualizarCarrinho(){
		try{
			//monitora o cache
			$this->_set_headers();

			//VALIDAR ESTOQUE DO PRODUTO
			$codigoProduto = $this->input->post('codigoProduto');

			$linhaId = $this->input->post('rowId');
			$qtd = $this->input->post('qtd');


			$this->load->model('ProdutosAdminModel');

			$qtdProdutoBancoDados = $this->ProdutosAdminModel->BuscarQtdProdutoEstoque($codigoProduto);


			$qtdEstoqueProduto = empty($qtdProdutoBancoDados) ? 0 : intval($qtdProdutoBancoDados->ESTOQUE_PRODUTO);


			if($qtdEstoqueProduto < $qtd){
				throw new Exception("Reduza a quantidade do carrinho!", 1);
			}

			$itemProduto = array(
			    'rowid' => $linhaId,
			    'qty' => $qtd
			);

			$atualizado = $this->cart->update($itemProduto);
			
			if($atualizado){
				$this->output
					->set_status_header(200)
					->set_content_type('application/json')
	        		->set_output(
	        			json_encode(
	        				array(
	        					'sucesso' => true
	        				)
	        			)
	        		);
			}
		}catch(Exception $e){
			$this->output
				->set_status_header(400)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}
	}

	public function totalItens(){
		//monitora o cache
		$this->_set_headers();

		$total = count($this->cart->contents());
		$this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true,
        			'total' => $total)
        		));
	}

	public function adicionarCarrinho(){
		//monitora o cache
		$this->_set_headers();
		try{

			$codigo = $this->input->post("codigoProduto");
			$nome = $this->input->post("nomeProduto");
			$preco = $this->input->post("preco");
			$qtd = $this->input->post("qtd");
			$img = $this->input->post("img");

			$this->load->model('ProdutosAdminModel');

			$valorProduto = $this->ProdutosAdminModel->buscarPrecoProduto($codigo)[0];

			$itemProduto = array(
				'id' => $codigo,
				'name' => $nome, 
	            'price' => $valorProduto, 
	            'qty' => $qtd,
	            'options' => array('img' => $img)
			);

			$adicionado = $this->cart->insert($itemProduto);

			if($adicionado){
				$this->output
					->set_status_header(200)
					->set_content_type('application/json')
	        		->set_output(json_encode(array(
	        			'sucesso' => true,
	        			'mensagem' => 'Produto '.$nome.' adicionado ao carrinho!')
	        		));
			}else{
				throw new Exception("Ocorreu um erro ao adicionar Produto", 1);
			}
		}catch(Exception $e){
			$this->output
				->set_status_header(401)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}
	}

	public function removerItemCarrinho(){
		//monitora o cache
		$this->_set_headers();
		
		$rowId = $this->input->post('rowId');

		$data = array(
			'rowid'   => $rowId,
			'qty'     => 0
		);

		$this->cart->update($data); 

		$this->output
					->set_status_header(200)
					->set_content_type('application/json')
	        		->set_output(json_encode(array(
	        			'sucesso' => true,
	        			'mensagem' => 'Item Removido com sucesso!')
	        		));
	}

	public function calcularCarrinhoCompras(){
		//monitora o cache
		$this->_set_headers();
		//$this->input->post('cepfrete');
		//TODO: Rever cupom 
		//$this->input->post('cupom');

		$totalCarrinho = 0;

		$descontoCupom = 0;

		foreach ($this->cart->contents() as $item) {
			$totalCarrinho = $item['subtotal'];
		}

		$objetoTotalCarrinho = new StdClass();
		$objetoTotalCarrinho->totalProdutos = number_format($totalCarrinho, 2, ',', '.');
		$objetoTotalCarrinho->subTotal = ($totalCarrinho - $descontoCupom);


		$this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode($objetoTotalCarrinho));

	}


	public function limparCarrinhoCompras(){
		$this->cart->destroy();
	}

	public function calcularFrete(){
		//monitora o cache
		$this->_set_headers();
		//modelos utilizados nas regras de negócio
		$this->load->model('FreteModel');
		$this->load->model('ProdutosAdminModel');

		//captura o cep de destino
		$cepDestino = $this->input->post("cep");

		//aqui serao armazenados todos as dimensoes dos produtos do carrinho
		$volumeCubicoTotal = 0;

		//peso total dos produtos
		$pesoTotal = 0;

		//varre todos os produtos do carrinho
		foreach ($this->cart->contents() as $itemCarrinho) {
			
			//dados das dimensoes do produto
			$dimensoesProduto = $this->ProdutosAdminModel->retornarDimensoesProdutoCodigo($itemCarrinho['id'])[0];
			
			//volume cubico calculado
			$volumeCubicoProduto = $this->FreteModel->calcularVolumeCubico(
				floatval($dimensoesProduto['LARGURA_PRODUTO']),
				floatval($dimensoesProduto['ALTURA_PRODUTO']),
				floatval($dimensoesProduto['COMPRIMENTO_PRODUTO']));

			//atribui no total volume cubico
			$volumeCubicoTotal+=$volumeCubicoProduto;

			//atribui o peso dos produtos
			$pesoTotal += round($dimensoesProduto['PESO_PRODUTO']);
		}

		//aqui temos o valor da RAIZ CÚBICA cúbico calculado com a Raiz Corretamente
		$volumeCubicoCalculado = $this->FreteModel->calcularRaizCubica(round($volumeCubicoTotal));

		//objeto frete com o calculo corretamente
		$frete = $this->FreteModel->calcularFrete(
			$cepDestino,
			$pesoTotal,
			$volumeCubicoCalculado,
			$volumeCubicoCalculado,
			$volumeCubicoCalculado);

		$fretes['frete'] = $frete;
		
		return $fretes;
	} 

}