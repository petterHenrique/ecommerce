<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once "MasterClienteLogado.php";

class Checkout extends CI_Controller {

	public function index()
	{
		//TODO: verifica se estará logado
		if(MasterClienteLogado::verificaClienteLogado()){

			//seta o session id do pagseguro
			$this->load->model('PagamentosModel');
			
			$token = $this->PagamentosModel->sessaoIdPagseguro();
			$dados['tokenPagseguro'] = $token;

			//sempre recalculo o frete
			//e altera os valores da sessao

			//$cepDestino = $_SESSION['clienteLogado']['enderecoEntrega']['cep'];
			//$this->RecalcularFrete($cepDestino);

			$this->load->view('/pagamento', $dados);
		}else{
			$this->load->view('/checkout');
		}
	}

	private function RecalcularFrete($cepDestino){

		$freteRecalculado = $this->calcularFrete($cepDestino);
		$_SESSION['fretePedido'] = $freteRecalculado;
	}

	private function _set_headers() {
	    header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' ); 
	    header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i(worry)' ) . ' GMT' ); 
	    header( 'Cache-Control: no-store, no-cache, must-revalidate' ); 
	    header( 'Cache-Control: post-check=0, pre-check=0', false ); 
	    header( 'Pragma: no-cache' );
	}

	public function VerificarUsuarioCheckout(){
		$this->_set_headers();

		$email = $this->input->post('email');
		

		//grava session email do suposto cliente
		$_SESSION['emailClienteCheckout'] = $email;


		$this->load->model('Clientes');

		$cliente = $this->Clientes->buscarClienteEmail($email);

		$modelo = new StdClass();

		if(!empty($cliente)){
			$modelo->clienteExistente = true;
			$modelo->nomeCliente = $cliente[0]['NOME_CLIENTE'];
		}else{
			$modelo->clienteExistente = false;
			$modelo->nomeCliente = "";
		}

		return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'success' => true,
                    'modelo' => $modelo
            )));
	}


	//metodo de autenticação no checkout

	public function editarCliente(){

		try{

			$cliente = array(
				'' => '',
				'' => '',
				'' => ''
			);

			$this->load->model("Clientes");




		}catch(Exception $e){
			$this->output
				->set_status_header(401)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}
	}

	public function auth(){
		$this->_set_headers();
		try{

			$email = $this->input->post('email');
			$senha = $this->input->post('senha');

			$this->load->model('LoginModel');

			$dadosCliente = $this->LoginModel->buscarUsuarioLoja($email, $senha);

			if(empty($dadosCliente)){

				throw new Exception("Senha incorreta!", 1);

			}else{

				//caso tenha dado sucesso então eu busco o endereço de entrega do cliente
				$enderecoCliente = $this->LoginModel->buscarEnderecoEntregaClienteLogado($dadosCliente[0]['COD_CLIENTE']);

				    //aqui eu monto e preencho os dados do cliente logado
				    $clienteLogado['clienteLogado']['codigo'] = $dadosCliente[0]['COD_CLIENTE'];
					$clienteLogado['clienteLogado']['nome'] = $dadosCliente[0]['NOME_CLIENTE'];
					$clienteLogado['clienteLogado']['email'] = $dadosCliente[0]['EMAIL_CLIENTE'];
					$clienteLogado['clienteLogado']['cpf'] = $dadosCliente[0]['CPF_CLIENTE'];
					$clienteLogado['clienteLogado']['telefone'] = $dadosCliente[0]['TELEFONE_CLIENTE'];
					$clienteLogado['clienteLogado']['codigoAreaTelefone'] = '54';//$dados['telefoneCliente'];
					$clienteLogado['clienteLogado']['logado'] = true;


					$this->session->set_userdata($clienteLogado);

					$_SESSION['enderecoCliente'] = $enderecoCliente[0];

					//$this->session->set_userdata($enderecoCliente);

					//aqui grava as formas de frete
					$fretePedido['fretePedido'] = $this->calcularFrete($enderecoCliente[0]["CEP_ENDERECO"]);

					//$_SESSION['fretePedido'] = $fretePedido;
					$this->session->set_userdata($fretePedido);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true)
        		));

		}catch(Exception $e){
			$this->output
				->set_status_header(401)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}

		
		
	}

	public function Pagamento()
	{
  		$this->_set_headers();

		//TODO: captura o email via post
		$email = $this->input->get('email');
		//verifica se possuí conta : se sim entao solita a senha senao abre cadastro

		$this->load->model('Clientes');

		//$cliente = $this->Clientes->buscarClienteEmail($email);

		$dados['email'] = $email;

		//dados do carrinho de compras
		$dados['produtosCarrinho'] = $this->cart->contents();


		//aqui gera-se o token do pagseguro
		$this->load->model('PagamentosModel');
		$token = $this->PagamentosModel->sessaoIdPagseguro();

		$dados['tokenPagseguro'] = $token;

		$this->load->view('/pagamento', $dados);
		
		//header("Location: pagamento");
		//redirect('index.php/checkout/pagamento');
		
		/*return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                    'text' => 'Sucesso',
                    'type' => 'email =>'.$email
            )));*/
	}
	private function calcularItem($qtd, $vlr){
		$res = ((int)$qtd * number_format((float)$vlr, 2, '.', ''));
		return number_format((float)$res, 2, '.', '') ;
	}
	
	public function sucesso(){

		//aqui é a página de sucesso após processar o pedido
		try{

			$idPedido = $this->input->get('codigoPedido');

			$this->load->model('PedidosAdminModel');

			$pedido = $this->PedidosAdminModel->buscaPedidoId($idPedido);

			$itensPedido = array();

			$valorTotalPedido = 0.00;

			//monto os itens do pedido
			foreach ($pedido as $item) {
				

				$valorTotalItem =  $this->calcularItem($item['QTD_PRODUTO'], $item['VLR_PRODUTO']);

				$objetoItem = 
					array(
						'SKU_PRODUTO' => $item['COD_PRODUTO'],
						'VLR_PRODUTO' => $item['VLR_PRODUTO'],
						'QTD_PRODUTO' => $item['QTD_PRODUTO'],
						'NOME_PRODUTO' => $item['NOME_PRODUTO'],
						'VLR_TOTAL' => number_format($valorTotalItem,2,",",".")
					);
				

				$valorTotalPedido+=$valorTotalItem;
				array_push($itensPedido, $objetoItem);
			}

			
			$dados['itens'] = $itensPedido;


			$dados['enderecoEntrega'] = 
				array(
					'CEP' => $pedido[0]['CEP_ENDERECO'],
					'RUA' => $pedido[0]['LOGRADOURO_ENDERECO'],
					'NUMERO' => $pedido[0]['NUMERO_ENDERECO'],
					'CIDADE' => $pedido[0]['CIDADE_ENDERECO'],
					'ESTADO' => $pedido[0]['ESTADO_ENDERECO'],
					'BAIRRO' => $pedido[0]['BAIRRO_ENDERECO'],
					'COMPLEMENTO' => $pedido[0]['COMPLEMENTO_ENDERECO']
				);

			$dados['cliente'] = 
				array(

					'COD_CLIENTE' => $pedido[0]['CLIENTE_COD_CLIENTE'], 
					'NOME' => $pedido[0]['NOME_CLIENTE'],
					'CPF' => $pedido[0]['CPF_CLIENTE'], 
					'TELEFONE' => $pedido[0]['TELEFONE_CLIENTE'],
					'CELULAR' => $pedido[0]['CELULAR_CLIENTE'],
					'EMAIL' => $pedido[0]['EMAIL_CLIENTE']

				);

			$dados['frete'] = 
				array(
					'TIP_FRETE' => 'correios PAC',
					'VLR_FRETE' => number_format("80",2,",","."),
					'PRAZO' => '12 dias'
				);

			$dados['pagamento'] = 
				array(
					'BOLETO' => empty($pedido[0]['BOLETO']) ? "" : $pedido[0]['BOLETO'],
					'OBSERVACOES' => '',
					'TIP_BOLETO' => empty($pedido[0]['BOLETO']) ? false : true
				);

			$dados['valorTotalPedido'] = $valorTotalPedido;

			$dados['codigoPedido'] = $idPedido;

			$this->load->view('/sucesso-pedido', $dados);

		}catch(Exception $e){
			$this->output
				->set_status_header(401)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}
	}


	//TODO: refatorar o nome || finaliza o pedido por cartao 
	public function finalizarPedido(){
		$this->_set_headers();
		try
		{
			//TODO: fazer uma validação pra ver se foi setado os valores

			$qtdParcelamento = $this->input->post('qtdParcelamento');
			$vlrParcelamento = $this->input->post('vlrParcelamento');
			$nomeCartao = $this->input->post('nomeCartao');
			$cpfCartao = $this->input->post('cpfCartao');
			$tokenCartao = $this->input->post('tokenCartao');


			//dados do frete
			$tipoFrete = $this->input->post('tipoFrete');
			$vlrFrete = $this->input->post('vlrFrete');
			//dados do frete


			$tipFormaPagamento = $this->input->post('tipFormaPagamento');

			$this->load->model('PagamentosModel');

			$enderecoEntregaCliente = $_SESSION['enderecoCliente'];

			$cliente =  $_SESSION['clienteLogado'];
			
			$dadosCartao = 
				array(
					'quantidadeParcelamento' => $qtdParcelamento,
					'valorParcelamento' => $vlrParcelamento,
					'nomeCartao' => $nomeCartao,
					'cpfCartao' => $cpfCartao,
					'tokenCartao' => $tokenCartao
			 	);

			//produtos do carrinho
			$produtos = array();

			$this->load->model('ProdutosAdminModel');

			foreach ($this->cart->contents() as $itemCarrinho) {
			
				$produtoCompleto = array(
					'sku' => $itemCarrinho['id'],
					'nomeProduto' => $itemCarrinho['name'],
					'valorProduto' => $itemCarrinho['price'],
					'qtdProduto' => $itemCarrinho['qty']
				);

				array_push($produtos, $produtoCompleto);

			}

			//apos gravar o pedido ele me retorna o id pra direcionar o cliente

		    $codigoPedidoGerado = $this->PagamentosModel->gerarPedido($tipoFrete, $vlrFrete,$tipFormaPagamento,$produtos, $enderecoEntregaCliente, $dadosCartao,
		    	$cliente);


		    if(!empty($dados->error)){
				throw new Exception("Ocorreu um erro ao processar o pagamento tente novamente!");
			}

		    $this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true,
        			'codigoPedido' => $codigoPedidoGerado,
        			'msg' => "sucesso")
        		));

		}catch(Exception $e){
			$this->output
				->set_status_header(400)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}

	}

	public function finalizarPedidoBoleto(){
		$this->_set_headers();
		try{

			//dados do frete
			$tipoFrete = $this->input->post('tipoFrete');
			$vlrFrete = $this->input->post('vlrFrete');
			//dados do frete

			//produtos do carrinho
			$produtos = array();

			$this->load->model('PagamentosModel');

			foreach ($this->cart->contents() as $itemCarrinho) {
			
				$produtoCompleto = array(
					'sku' => $itemCarrinho['id'],
					'nomeProduto' => $itemCarrinho['name'],
					'valorProduto' => $itemCarrinho['price'],
					'qtdProduto' => $itemCarrinho['qty']
				);

				array_push($produtos, $produtoCompleto);

			}

			$cliente =  $_SESSION['clienteLogado'];
			
			$codigoPedidoGerado = $this->PagamentosModel->gerarPedido(null,$vlrFrete,null,$produtos,null,null,$cliente);


		    if(!empty($dados->error)){
				throw new Exception("Ocorreu um erro ao processar o pagamento tente novamente!");
			}

		    $this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true,
        			'codigoPedido' => $codigoPedidoGerado,
        			'msg' => "sucesso")
        		));

		}catch(Exception $e){
			$this->output
				->set_status_header(400)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $e->getMessage())
        		));
		}
	}

	public function SalvarClienteCheckout(){
		$this->_set_headers();
		try{
		
			$dados = $this->input->post("dadosCliente");

			if(isset($dados)){


				$this->load->model("Clientes");

				$cliente = array(
					'NOME_CLIENTE' => $dados['nomeCliente'], 
					'CPF_CLIENTE' => $dados['cpfCliente'], 
					'DTA_CADASTRO_CLIENTE' => date("d-m-Y H:i:s"), 
					'TELEFONE_CLIENTE' => $dados['telefoneCliente'], 
					'EMAIL_CLIENTE' => $dados['emailCliente'], 
					'SENHA_CLIENTE' =>md5("admin") //md5(date("y")."142".date("m"))
				);

				//aqui salvou o cliente
				$clienteIDcadastrado = $this->Clientes->salvar($cliente);

				/*$enderecoCliente = array(
					'CEP_ENDERECO' => $dados["cep"],
					'LOGRADOURO_ENDERECO' => $dados["logradouro"],
					'NUMERO_ENDERECO' => $dados["numeroEnderecoCliente"],
					'CIDADE_ENDERECO' => $dados["cidadeCliente"],
					'ESTADO_ENDERECO' => $dados["estadoCliente"],
					'BAIRRO_ENDERECO' => $dados["bairroCliente"],
					'COMPLEMENTO_ENDERECO' => $dados["complementoEndereco"],
					'TIP_ENTREGA' => true,
					'COD_CLIENTE' => $clienteIDcadastrado
				);*/

				//$salvarEnderecoCliente = $this->Clientes->salvarEnderecoCliente($enderecoCliente);
				$clienteLogado['clienteLogado']['codigo'] = $clienteIDcadastrado;
				$clienteLogado['clienteLogado']['nome'] = $dados['nomeCliente'];
				$clienteLogado['clienteLogado']['email'] = $dados['emailCliente'];
				$clienteLogado['clienteLogado']['cpf'] = $dados['cpfCliente'];
				$clienteLogado['clienteLogado']['telefone'] = $dados['telefoneCliente'];
				$clienteLogado['clienteLogado']['codigoAreaTelefone'] = '54';//$dados['telefoneCliente'];
				$clienteLogado['clienteLogado']['logado'] = true;
				$this->session->set_userdata($clienteLogado);

				/*if($salvarEnderecoCliente){
					//grava o usuario na sessao
					$clienteLogado['clienteLogado']['codigo'] = $clienteIDcadastrado;
					$clienteLogado['clienteLogado']['nome'] = $dados['nomeCliente'];
					$clienteLogado['clienteLogado']['email'] = $dados['emailCliente'];
					$clienteLogado['clienteLogado']['cpf'] = $dados['cpfCliente'];
					$clienteLogado['clienteLogado']['telefone'] = $dados['telefoneCliente'];
					$clienteLogado['clienteLogado']['codigoAreaTelefone'] = '54';//$dados['telefoneCliente'];
					$clienteLogado['clienteLogado']['logado'] = true;
					$clienteLogado['clienteLogado']['enderecoEntrega'] = array(
						'cep' => $dados["cep"],
						'logradouro' => $dados["logradouro"],
						'numero' => $dados["numeroEnderecoCliente"],
						'cidade' => $dados["cidadeCliente"],
						'estado' => $dados["estadoCliente"],
						'bairro' => $dados["bairroCliente"],
						'complemento' => $dados["complementoEndereco"], 
					);

					$this->session->set_userdata($clienteLogado);

					//aqui grava as formas de frete
					//$fretePedido['fretePedido'] = $this->calcularFrete('95040410');

					//$_SESSION['fretePedido'] = $fretePedido;
					//$this->session->set_userdata($fretePedido);


				}else{
					//throw new Exception("Não foi possível realizar o Cadastro!", 1);
					
				}*/



				return $this->output
	            	->set_content_type('application/json')
	            	->set_status_header(200)
	            	->set_output(json_encode(array(
	                    	'sucesso' => true,
	                    	'type' => "deu certo"
	            	)));
			}else{
				throw new Exception("Nenhum dado Enviado", 1);
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


	public function SalvarEnderecoCheckout(){

		$this->_set_headers();
		try{

			$enderecoCliente = array(
				'CEP_ENDERECO' => $this->input->post("cep"),
				'LOGRADOURO_ENDERECO' => $this->input->post("logradouro"),
				'NUMERO_ENDERECO' => $this->input->post("numeroEnderecoCliente"),
				'CIDADE_ENDERECO' => $this->input->post("cidadeCliente"),
				'ESTADO_ENDERECO' => $this->input->post("estadoCliente"),
				'BAIRRO_ENDERECO' => $this->input->post("bairroCliente"),
				'COMPLEMENTO_ENDERECO' => $this->input->post("complementoEndereco"),
				'TIP_ENTREGA' => true,
				'COD_CLIENTE' => $_SESSION['clienteLogado']['codigo']
			);

			$this->load->model("Clientes");
			
			$salvarEnderecoCliente = $this->Clientes->salvarEnderecoCliente($enderecoCliente);


			//echo $salvarEnderecoCliente;

			if($salvarEnderecoCliente){

				//salva na sesao o endereco cliente
				$enderecoClienteCheckout['enderecoCliente']=$enderecoCliente;

				$this->session->set_userdata($enderecoClienteCheckout);

				$fretePedido['fretePedido'] = $this->calcularFrete('95040410');

				//salva na sessao o frete do pedido
				$this->session->set_userdata($fretePedido);

				return $this->output
	            	->set_content_type('application/json')
	            	->set_status_header(200)
	            	->set_output(json_encode(array(
	                    	'sucesso' => true,
	                    	'type' => "deu certo"
	            	)));

			}else{
				throw new Exception("Falha ao salvar endereço", 1);
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

	public function destroy(){
		session_destroy();
	}
	public function calculaFreteLoko(){

		$cep = $this->input->get('cep');

		$teste = $this->calcularFrete($cep);

		$this->output
				->set_status_header(401)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'error' => $teste)
        		));
    }

	//TODO: VER FORMA DE CRIAR UM ABSTRATO QUE CONTENHA ESTA FUNÇÃO
	//POIS ESTÁ REPETIDO NO CARRINHO DE COMPRAS

    public function teste(){

    	session_destroy();
    	echo json_encode($this->calcularFrete("04180112"));
    }

	private function calcularFrete($cepDestinoCheckout){
		$this->_set_headers();
		//modelos utilizados nas regras de negócio
		$this->load->model('FreteModel');
		$this->load->model('ProdutosAdminModel');

		//captura o cep de destino
		$cepDestino = $cepDestinoCheckout; //$this->input->post("cep");

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


		return $frete;
	} 
}