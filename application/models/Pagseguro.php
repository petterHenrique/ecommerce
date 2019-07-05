<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagSeguro
{
    /***
     * Parâmetros de Autenticação
     */
    private $service;
    private $email;
    private $token;
    /***
     * Parâmetros do REST
     */
    private $action;
    private $callback;
    private $params;
    /***
     * Atributo de sessão da conexão
     */
    private $sessionId;
    /**
     * <b>Construtor</b>: Não é necessário fazer instância desse método.
     * Responsabilidade de setar os parâmetros de autenticação com o WebService
     */
    public function __construct()
    {
        $this->service = 'https://ws.sandbox.pagseguro.uol.com.br';
        $this->email = 'p_h_campos@hotmail.com'; // Seu e-mail de Login no PagSeguro
        $this->token = '218B2800593F49EAAAF3F463EFA3B6E7'; // Token da sua conta no PagSeguro
    }
    /**
     * <b>createPlan</b>: Método responsável por fazer a criação de um novo plano
     * no PagSeguro utilizando o WebService
     * @param INT $ref = ID do plano no banco de dados
     * @param STRING $name = Nome do plano
     * @param STRING $period = Periodicidade de cobrança [WEEKLY, MONTHLY, BIMONTHLY, TRIMONTHLY, SEMIANNUALLY ou YEARLY]
     * @param DECIMAL $amount = Valor do plano com duas casas decimais separadas por ponto (100.00)
     */
    public function createPlan($ref, $name, $period, $amount)
    {
        $this->action = '/pre-approvals/request';
        $this->params = [
            'reference' => $ref,
            'preApproval' => [
                'name' => $name,
                'charge' => 'AUTO',
                'period' => $period,
                'amountPerPayment' => $amount,
            ],
        ];
        $this->post();
    }
    /**
     * <b>createMemberShip</b>: Método responsável por fazer a adesão de um
     * cliente ao plano.
     * @param STRING $plan = Código do plano junto ao PagSeguro
     * @param STRING $ref = ID da assinatura no banco de dados
     * @param STRING $name = Nome do Cliente
     * @param STRING $email = E-mail do Cliente
     * @param STRING $document = CPF do Cliente
     * @param STRING $phone = Telefone de contato junto com o DDD (Sem pontuação)
     * @param STRING $street = Endereço do Cliente
     * @param STRING $number = Número do Endereço
     * @param STRING $complement = Complemento do Endereço
     * @param STRING $district = Bairro do Endereço
     * @param STRING $city = Cidade do Endereço
     * @param STRING $state = Estado do Endereço
     * @param STRING $country = Sigla do País com 3 letras (BRA)
     * @param STRING $postalCode = CEP do Endereço
     * @param STRING $token = Token do cartão de crédito
     * @param STRING $holderName = Nome do Titular do Cartão
     * @param DATE $holderBirth = Data de Nascimento do Titular do Cartão no formado DD/MM/AAAA
     * @param STRING $holderPhone = Telefone de contato junto com o DDD do Titular do Cartão (Sem pontuação)
     */
    public function createMemberShip($plan, $ref, $name, $email, $document, $phone, $street, $number, $complement, $district, $city, $state, $country, $postalCode, $token, $holderName, $holderBirth, $holderPhone)
    {
        $this->action = '/pre-approvals';
        $this->params = [
            'plan' => $plan,
            'reference' => $ref,
            'sender' => [
                'name' => $name,
                'email' => $email,
                'ip' => '1.1.1.1',
                'phone' => [
                    'areaCode' => substr($phone, 0, 2),
                    'number' => substr($phone, 2),
                ],
                'address' => [
                    'street' => $street,
                    'number' => $number,
                    'complement' => $complement,
                    'district' => $district,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'postalCode' => $postalCode,
                ],
                'documents' => [
                    ['type' => 'CPF', 'value' => $document],
                ],
            ],
            'paymentMethod' => [
                'type' => 'CREDITCARD',
                'creditCard' => [
                    'token' => $token,
                    'holder' => [
                        'name' => $holderName,
                        'birthDate' => $holderBirth,
                        'documents' => [
                            ['type' => 'CPF', 'value' => '23363265824'],
                        ],
                        'phone' => [
                            'areaCode' => substr($holderPhone, 0, 2),
                            'number' => substr($holderPhone, 2),
                        ],
                    ],
                ],
            ],
        ];
        $this->post();
    }
    /**
     * <b>getSessionId</b>: Método utilizado para resgatar o ID da sessão para que possa consumir as informações
     * do javascript nos métodos que manipulam o cartão de crédito.
     */
    public function getSessionId()
    {
        $action = '/v2/sessions';
        $params = [
            'email' => $this->email,
            'token' => $this->token,
        ];
        $ch = curl_init($this->service.$action);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //echo curl_exec($ch);
        $result = simplexml_load_string(curl_exec($ch));
        curl_close($ch);
        $this->sessionId = (string) $result[0]->id;
        return $this->sessionId;
    }


    /*
		RetornarModelo Cartao Crédito

    */

	public function pagamentoCartaoCredito($vlrFrete,$produtos, $enderecoEntregaCliente, $enderecoLoja, $cliente, $dadosCartao){


		$endereco = $this->service.'/v2/transactions';

		/**
		 * MONTA A ARRAY() COM OS DADOS 
		 * ESSES DADOS PODEM SER PASSADOS VIA POST OU PEGAR DO BANCO DE DADOS
		 * VAI DEPENDER DE COMO SEU SISTEMA TRABALHA		 
		 */
		//echo var_dump($enderecoEntregaCliente);


		$data['email'] = $this->email;
		$data['token'] = $this->token;
		$data['paymentMode'] = "default";
		$data['paymentMethod'] = "creditCard";
		$data['receiverEmail'] = $this->email;
		$data['currency'] = "BRL";
		$data['extraAmount'] = "";


		//itens do produto
		$indice = 1;
		foreach ($produtos as $produto) {
			$data['itemId'.$indice] = $produto['sku'];
			$data['itemDescription'.$indice] = $produto['nomeProduto'];
			$data['itemAmount'.$indice] = number_format((float)$produto['valorProduto'], 2, '.', '');
			$data['itemQuantity'.$indice] = $produto['qtdProduto'];
			$indice++;
		}

		$data['notificationURL'] = "";
		$data['reference'] = "0001";

		//remetente
		$data['senderName'] = "Pedro Henrique de Souza de Campos";
		$data['senderCPF'] = "03521225011";
		$data['senderAreaCode'] = $cliente['codigoAreaTelefone'];
		$data['senderPhone'] = "991867667";
		$data['senderEmail'] = "c63596705283633013093@sandbox.pagseguro.com.br";

		$data['creditCardToken'] = $dadosCartao['tokenCartao'];

		//endereço de envio // ENDEREÇO DA LOJA VIRTUAL
		$data['shippingAddressStreet'] = $enderecoLoja['logradouro'];
		$data['shippingAddressNumber'] = $enderecoLoja['numero'];
		$data['shippingAddressComplement'] = $enderecoLoja['complemento'];
		$data['shippingAddressDistrict'] = $enderecoLoja['bairro'];
		$data['shippingAddressPostalCode'] = $enderecoLoja['cep'];
		$data['shippingAddressCity'] = $enderecoLoja['cidade'];
		$data['shippingAddressState'] = $enderecoLoja['estado'];
		$data['shippingAddressCountry'] = "BRA";

		//Tipo de envio / valor do frete

		//Tipo 1 = Encomenda normal (PAC) / 2- SEDEX 3 - Nao informado

		$data['shippingType'] = "3";
		$data['shippingCost'] = number_format((float)$vlrFrete, 2, '.', '');

		//qunatidade do valor total e parcelamento
		$data['installmentQuantity'] = $dadosCartao['quantidadeParcelamento'];
		$data['installmentValue'] = number_format((float)$dadosCartao['valorParcelamento'], 2, '.', '');

		//dados do cartao credito
		$data['creditCardHolderName'] = $dadosCartao['nomeCartao'];
		$data['creditCardHolderCPF'] = $this->limparString($dadosCartao['cpfCartao'],".","");
		$data['creditCardHolderBirthDate'] = "";
		$data['creditCardHolderAreaCode'] =$this->limparString($cliente['codigoAreaTelefone']);
		$data['creditCardHolderPhone'] = "991867667";

		//endereço de entrega
		$data['billingAddressStreet'] = $enderecoEntregaCliente['LOGRADOURO_ENDERECO'];
		$data['billingAddressNumber'] = $enderecoEntregaCliente['NUMERO_ENDERECO'];
		$data['billingAddressComplement'] = $enderecoEntregaCliente['COMPLEMENTO_ENDERECO'];
		$data['billingAddressDistrict'] = $enderecoEntregaCliente['BAIRRO_ENDERECO'];
		$data['billingAddressPostalCode'] = $this->limparString($enderecoEntregaCliente['CEP_ENDERECO'], "-", "");
		$data['billingAddressCity'] = $enderecoEntregaCliente['CIDADE_ENDERECO'];
		$data['billingAddressState'] =$enderecoEntregaCliente['ESTADO_ENDERECO'];
		$data['billingAddressCountry'] = "BRA";
	    
	    //Aqui ele monta a url completa que o PAGSEGURO ESPERA
		$fields_string = '';
	    
	    foreach ($data as $key=>$value)
	    { 
	    	$fields_string .= $key.'='.$value.'&'; 
	    }

	    $fields_string = rtrim($fields_string,'&');

		$ch = curl_init();    
    	curl_setopt($ch,CURLOPT_URL, $endereco);
    	curl_setopt($ch,CURLOPT_POST, count($data));
    	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
    	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);    		
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
   		//curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	    //execute post
	    $result = curl_exec($ch);

	    //close connection
	    curl_close($ch);

	    //PEGA O RESULTADO E CONVERTE EM STRING
		$result = simplexml_load_string($result);

		return json_encode($result);
	}


	public function pagamentoBoleto($vlrFrete, $produtos, $enderecoLoja, $cliente){

		$endereco = $this->service.'/v2/transactions';

		$data['email'] = $this->email;
		$data['token'] = $this->token;
		$data['paymentMode'] = "default";
		$data['paymentMethod'] = "boleto";
		$data['receiverEmail'] = $this->email;
		$data['currency'] = "BRL";
		$data['extraAmount'] = "";


		//itens do produto
		$indice = 1;
		foreach ($produtos as $produto) {
			$data['itemId'.$indice] = $produto['sku'];
			$data['itemDescription'.$indice] = $produto['nomeProduto'];
			$data['itemAmount'.$indice] = number_format((float)$produto['valorProduto'], 2, '.', '');
			$data['itemQuantity'.$indice] = $produto['qtdProduto'];
			$indice++;
		}

		$data['shippingType'] = "3";
		$data['shippingCost'] = number_format((float)$vlrFrete, 2, '.', '');
		

		$data['notificationURL'] = "";
		$data['reference'] = "0001";

		//remetente
		$data['senderName'] = "Pedro Henrique de Souza de Campos";
		$data['senderCPF'] = "03521225011";
		$data['senderAreaCode'] = "54";//$cliente['codigoAreaTelefone'];
		$data['senderPhone'] = "991867667";
		$data['senderEmail'] = "c63596705283633013093@sandbox.pagseguro.com.br";
			

		//endereço de envio // ENDEREÇO DA LOJA VIRTUAL
		$data['shippingAddressStreet'] = $enderecoLoja['logradouro'];
		$data['shippingAddressNumber'] = $enderecoLoja['numero'];
		$data['shippingAddressComplement'] = $enderecoLoja['complemento'];
		$data['shippingAddressDistrict'] = $enderecoLoja['bairro'];
		$data['shippingAddressPostalCode'] = $enderecoLoja['cep'];
		$data['shippingAddressCity'] = $enderecoLoja['cidade'];
		$data['shippingAddressState'] = $enderecoLoja['estado'];
		$data['shippingAddressCountry'] = "BRA";

		$fields_string = '';
	    foreach ($data as $key=>$value)
	    { 
	    	$fields_string .= $key.'='.$value.'&'; 
	    }
	    $fields_string = rtrim($fields_string,'&');

	    //INICIA O CURL
		$ch = curl_init();    
    	curl_setopt($ch,CURLOPT_URL, $endereco);
    	curl_setopt($ch,CURLOPT_POST, count($data));
    	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
    	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);    		
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
   		//curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

	    //PEGA O RETORNO DO CURL
	    $result = curl_exec($ch);

	    //FINALIZA O CURL
	    curl_close($ch);

		$transacaoBoleto = simplexml_load_string($result);

		return json_encode($transacaoBoleto);
	}

	private function limparString($str) {
	    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
	    $str = preg_replace('/[éèêë]/ui', 'e', $str);
	    $str = preg_replace('/[íìîï]/ui', 'i', $str);
	    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
	    $str = preg_replace('/[úùûü]/ui', 'u', $str);
	    $str = preg_replace('/[ç]/ui', 'c', $str);
	    // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
	    $str = preg_replace('/[^a-z0-9]/i', '', $str);
	    $str = preg_replace('/_+/', '', $str); // ideia do Bacco :)
	    return $str;
	}

    /**
     * <b>getCallback</b>: Método responsável por retornar o objeto da comunicação REST
     */
    public function getCallback()
    {
        return $this->callback;
    }
    /**
     * <b>getMemberShip</b>: Método responsável por retornar o objeto de assinatura do PagSeguro
     * @param STRING $code = Código retornado pela API de notificação do PagSeguro
     */
    public function getMemberShip($code)
    {
        $this->action = "/pre-approvals/notifications/{$code}";
        $this->get();
    }
    /**
     * <b>getTransaction</b>: Método responsável por retornar o objeto de transação do PagSeguro
     * @param STRING $code = Código retornado pela API de notificação do PagSeguro
     */
    public function getTransaction($code)
    {
        $this->action = "/v2/transactions/notifications/{$code}";
        $this->get();
    }
    /**
     * <b>get</b>: Método responsável por resgatar informações da comunicação REST
     */
    private function get()
    {
        $url = $this->service.$this->action."?email={$this->email}&token={$this->token}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'));
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
        if (empty($this->callback)) {
            $url = $this->service.$this->action."?email={$this->email}&token={$this->token}";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Accept: application/xml;charset=ISO-8859-1'));
            $this->callback = simplexml_load_string(curl_exec($ch));
            curl_close($ch);
        }
    }
    /**
     * <b>post</b>: Método responsável por inputar informações na comunicação REST
     */
    private function post()
    {
        $url = $this->service.$this->action."?email={$this->email}&token={$this->token}";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Accept: application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'));
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }
}