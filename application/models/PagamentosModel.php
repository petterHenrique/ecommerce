<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "Pagseguro.php";


class PagamentosModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function listarPedidos(){
		$this->db->order_by('DTA_CRIACAO_PEDIDO', 'desc');
		$this->db->limit(5);
		$dados = $this->db->get('pedido_detalhado2')->result_array();
		return $dados;
	}


	public function totalFaturamento(){
		$dados = $this->db->query("SELECT SUM(*) as 'AVALIACOES' FROM avaliacoes")->result_array();
	}

	public function contadoresGeral(){

		$totalComentarios = $this->db->query("SELECT COUNT(*) as 'AVALIACOES' FROM avaliacoes")->result_array()[0];
		$totalPedidos = $this->db->query("SELECT COUNT(*) as 'TOTAL_PEDIDOS' FROM pedido WHERE date(DTA_CRIACAO_PEDIDO) = date(Now())")->result()[0];
		$totalProdutos = $this->db->query("SELECT COUNT(*) as 'PRODUTOS' FROM produto")->result_array()[0];
		$totalTicket = $this->db->query("SELECT (SUM(PI.VLR_PRODUTO * PI.QTD_PRODUTO) / COUNT(P.COD_PEDIDO)) as 'TICKET_MEDIO' FROM pedido P INNER JOIN pedido_itens PI ON P.COD_PEDIDO = PI.COD_PEDIDO")->result_array()[0];

		$totalClientes = $this->db->query("SELECT COUNT(*) as 'CLIENTES' FROM cliente")->result_array()[0];
		
		$totalFaturado = $this->db->query("SELECT SUM(pi.QTD_PRODUTO * pi.VLR_PRODUTO) as 'TOTAL_FATURADO' from pedido p inner JOIN pedido_itens pi on p.COD_PEDIDO = pi.COD_PEDIDO")->result_array()[0];
		

		$dados= array(
			'COMENTARIOS' => $totalComentarios['AVALIACOES'], 
			'PEDIDOS_HOJE' => $totalPedidos->TOTAL_PEDIDOS, 
			'TICKET' => number_format($totalTicket['TICKET_MEDIO'], 2, ',', ' '),
			'PRODUTOS' => $totalProdutos['PRODUTOS'],
			'CLIENTES' => $totalClientes['CLIENTES'],
			'FATURAMENTO' => number_format($totalFaturado['TOTAL_FATURADO'], 2, ',', ' ')
		);
		

		//echo "<hr>comentarios";
		//echo var_dump($totalComentarios);


    	return $dados;

	}


	public function sessaoIdPagseguro(){
		$pagseguro = new PagSeguro();
		return $pagseguro->getSessionId();
	}

	private function salvarPedidoCabecalho($dados){

		$inserir = $this->db->insert('pedido', $dados);

    	if($inserir){
    		return $this->db->insert_id();
    	}else{
    		return false;
    	}

	}

	private function salvarPedidoItens($dados){

		$inserir = $this->db->insert('pedido_itens', $dados);

    	if($inserir){
    		return true; //$this->db->insert_id();
    	}else{
    		return false;
    	}

	}


	public function gerarPedido($tipoFrete, $vlrFrete,$formaPagamento, $produtos, $enderecoEntregaCliente, $dadosCartaoCliente, $cliente){

		//cabeçalho do pedido
		$pedido = array(
			'DTA_CRIACAO_PEDIDO' => date("Y-m-d H:i:s"), 
			'TIP_FRETE_PEDIDO' => $tipoFrete,
			'VLR_FRETE_PEDIDO' =>$vlrFrete,
			'FORMA_PAGTO_PEDIDO' => $formaPagamento,
			'STATUS_PEDIDO' => 1,
			'CLIENTE_COD_CLIENTE' => $cliente['codigo']);
		

		//grava o pedido e retorno o id
		$codigoPedido = $this->salvarPedidoCabecalho($pedido);

		//grava os pedidos itens
		foreach ($produtos as $produto) {

			$entidadeItem = 
				array(
					'VLR_PRODUTO' => $produto['valorProduto'],
					'QTD_PRODUTO' => $produto['qtdProduto'],
					'COD_PRODUTO' => (int)$produto['sku'],
					'COD_PEDIDO' => $codigoPedido
				);

			$this->salvarPedidoItens($entidadeItem);
		}


		//se gerou o pedido entao eu pego e realizo a trasacao no pagseguro
		//e realiza as transacoes
		if(!empty($dadosCartaoCliente)){
			$transacao = $this->gerarPagamentoCartaoPagseguro($vlrFrete,$produtos, $enderecoEntregaCliente, $dadosCartaoCliente, $cliente, $codigoPedido);

			//caso ocorra um erro ele gera a transação

			//echo "</br>";

			//echo "Erro ocorrido na transação";

			//echo var_dump($transacao->error);

			//echo "</br>";

			//echo var_dump($transacao->error);


			if(!empty($transacao->error)){
				throw new Exception("Ocorreu um erro ao processar o pagamento!", 1);
			}else{

				//aqui eu gravo na tabela pagamento para registrar os dados
				$entidadePagamento = 
					array('DTA_CRIACAO' => date("Y-m-d H:i:s"),
						  'DTA_MODIFICACAO' => date("Y-m-d H:i:s"),
						  'VLR_PAGTO' => $transacao->grossAmount,
						  'CODE_TRANSACTION' => $transacao->code,
						  'COD_TIPOPAGTO' => 1,
						  'COD_PEDIDO' => $codigoPedido,
						  'NOME_PAGAMENTO' => "PAGSEGUROCARTAO",
						  'URL_BOLETO' => "");

				//salva no banco de dados
				$salvarPagamento = $this->db->insert('pagamento', $entidadePagamento);
				if($salvarPagamento == false){
					throw new Exception("Erro ao gravar dados do pagamento!", 1);
				}
			}
		}else if(empty($dadosCartaoCliente) && empty($enderecoEntregaCliente)){

			//então gera o pedido por boleto
			$transacao = $this->gerarPagamentoBoletoPagseguro($vlrFrete,$produtos, $cliente);

			if(!empty($transacao->error)){
				throw new Exception("Ocorreu um erro ao processar o boleto", 1);
			}else{

				$entidadePagamento = 
					array('DTA_CRIACAO' => date("Y-m-d H:i:s"),
						  'DTA_MODIFICACAO' => date("Y-m-d H:i:s"),
						  'VLR_PAGTO' => $transacao->grossAmount,
						  'CODE_TRANSACTION' => $transacao->code,
						  'COD_TIPOPAGTO' => 1,
						  'COD_PEDIDO' => $codigoPedido,
						  'NOME_PAGAMENTO' => "PAGSEGUROBOLETO",
						  'URL_BOLETO' => $transacao->paymentLink);

				//salva no banco de dados
				$salvarPagamento = $this->db->insert('pagamento', $entidadePagamento);
				if($salvarPagamento == false){
					throw new Exception("Erro ao gravar dados do pagamento!", 1);
				}
			}
		}

		return $codigoPedido;
	}

	private function gerarPagamentoCartaoPagseguro($vlrFrete,$produtos, $enderecoEntregaCliente, $dadosCartaoCliente, $cliente, $codigoPedido){

			$pagseguro = new PagSeguro();

			//TODO: buscar dinamicamente do banco de dados
			$enderecoLoja = array(
				'logradouro' => 'Rua João Zandomeneghi', 
				'numero' => '1828', 
				'complemento' => 'Casa Azul', 
				'bairro' => 'Universitário', 
				'cep' => '95040410', 
				'cidade' => 'Caxias do Sul',
				'estado' => 'RS'
			);

			$result = $pagseguro->pagamentoCartaoCredito($vlrFrete,$produtos, $enderecoEntregaCliente, $enderecoLoja, $cliente, $dadosCartaoCliente);


			return json_decode($result);
	}

	private function gerarPagamentoBoletoPagseguro($vlrFrete,$produtos, $cliente){

		$pagseguro = new PagSeguro();

		//TODO: buscar dinamicamente do banco de dados
		$enderecoLoja = array(
			'logradouro' => 'Rua João Zandomeneghi', 
			'numero' => '1828', 
			'complemento' => 'Casa Azul', 
			'bairro' => 'Universitário', 
			'cep' => '95040410', 
			'cidade' => 'Caxias do Sul',
			'estado' => 'RS'
		);

		$result = $pagseguro->pagamentoBoleto($vlrFrete,$produtos, $enderecoLoja,$cliente);

		return json_decode($result);
	}

}
