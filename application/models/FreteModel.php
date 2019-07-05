<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FreteModel extends CI_Model {

	public function index()
	{
		$this->load->view('welcome_message');
	}


	public function buscarConfiguracoesFreteCorreios(){
		$this->db->limit(1);
		$query = $this->db->get('configuracoes_correios')->result_array();
		return $query;
	}

	public function salvarConfiguracoesCorreios($entidade){
		if(!empty($entidade['COD_CONFIG'])){

			$this->db->where("COD_CONFIG", $entidade['COD_CONFIG']);
    		$atualizar = $this->db->update('configuracoes_correios', $entidade);
    		return $atualizar;
		}else{
			$inserir = $this->db->insert('configuracoes_correios', $entidade);
			return $inserir;
		}
	}

    /*
		método responsável por converter cm para volume em cm3 do produto
		multiplicando L x A x C
    */

    public function calcularVolumeCubico($largura, $altura, $comprimento){
    	return ($largura * $altura) * $comprimento;
    }

    /*
		metodo repsonsável por calcular e retornar a raiz cubica
		de um volume do produto cúbico.
		Params: {$valumeProdutoCubivo} resultado após utilizar metodo acima
    */

    public function calcularRaizCubica($volumeCubico){
    	$grauraiz = 3;
    	return round(pow($volumeCubico,(1/$grauraiz)));
    }

    //metodos para calcular o frete
    public function calcularFrete($cepDestino, $peso, $largura, $altura, $comprimento){
    	
    	$this->db->limit(1);
    	$this->db->select('CEP_ORIGEM');
		$dadosCorreios = $this->db->get('configuracoes_correios')->result_array()[0];
		$cepOrigem = $dadosCorreios['CEP_ORIGEM'];
		
		//aqui eu busco os dados do banco caso ocorra
		//TODO: rever a forma de pegar os contratos e realizar outro calculo

		$servicosCorreios = 
			array(
				'PAC' => '41106',
				'SEDEX' => '40010',
				'SEDEX10' => '40215'
			);

    	$ws_correios_pac = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cepOrigem."&sCepDestino=".$cepDestino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&sCdAvisoRecebimento=n&nCdServico=".$servicosCorreios['PAC']."&nVlDiametro=0&StrRetorno=xml";

		$ws_correios_sedex = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cepOrigem."&sCepDestino=".$cepDestino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&sCdAvisoRecebimento=n&nCdServico=".$servicosCorreios['SEDEX']."&nVlDiametro=0&StrRetorno=xml";

		$ws_correios_sedex10 = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCepOrigem=".$cepOrigem."&sCepDestino=".$cepDestino."&nVlPeso=".$peso."&nCdFormato=1&nVlComprimento=".$comprimento."&nVlAltura=".$altura."&nVlLargura=".$largura."&sCdMaoPropria=n&sCdAvisoRecebimento=n&nCdServico=".$servicosCorreios['SEDEX10']."&nVlDiametro=0&StrRetorno=xml";

        $xmlpac = simplexml_load_file($ws_correios_pac)->cServico;

        $xmlsedex = simplexml_load_file($ws_correios_sedex)->cServico;

        $xmlsedex10 = simplexml_load_file($ws_correios_sedex10)->cServico;

        //aqui armazena um array de objetos de fretes EX: PAC - SEDEX entre outros.
        $fretesCalculados = array();

        //SEDEX 10
        array_push($fretesCalculados, $xmlpac);
        array_push($fretesCalculados, $xmlsedex);
        array_push($fretesCalculados, $xmlsedex10);

        //aqui eu tenho a lista com os dados limpos de cada frete
        //com prazo de entrega e etc.

        $fretesCompleto = array();

        foreach ($fretesCalculados as $frete) {
        	$servicoTipoFrete = "";

        	switch ($frete->Codigo) {
        		case 41106:
        			$servicoTipoFrete="PAC";
        			break;
        		case 40010:
        			$servicoTipoFrete="SEDEX";
        			break;
        		default:
        			$servicoTipoFrete="SEDEX10";
        			break;
        	}

        	$prazoEntrega = (string)$frete[0]->PrazoEntrega;

        	$valorFrete = (string)$frete[0]->Valor;

        	$f = array(
        		'VALOR' => $valorFrete,
        		'SERVICO' => $servicoTipoFrete,
        		'PRAZOENTREGA' =>$prazoEntrega);

        	array_push($fretesCompleto, $f);
        }

        return $fretesCompleto;
    }
    
}

class ModeloFreteCorreios{
	public $valorFrete;
	public $servicoCorreios; //PAC - SEDEX - E-SEDEX
	public $prazoEntrega;
}
