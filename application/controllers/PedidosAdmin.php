<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "MasterLogado.php";

class PedidosAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("PedidosAdminModel");
		$dados['pedidos'] = $this->PedidosAdminModel->listarPedidos();
		$this->load->view('/upadmin/pedidos/index', $dados);
	}

	private function calcularItem($qtd, $vlr){
		$res = ((int)$qtd * number_format((float)$vlr, 2, '.', ''));
		return number_format((float)$res, 2, '.', '') ;
	}

	public function detalhe(){

		$id = $this->input->get("id");

		if(!empty($id)){

			$this->load->model("PedidosAdminModel");

			$pedido = $this->PedidosAdminModel->buscaPedidoId($id);


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
						'VLR_TOTAL' => $valorTotalItem
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
					'VLR_FRETE' => '200',
					'PRAZO' => '12 dias'
				);

			$dadosPagamento = $this->PedidosAdminModel->buscarDadosPagamentoPedido($id);

			if(!empty($dadosPagamento)){
				$dados['pagamento'] = 
				array(
					'CODIGO_TRANSACAO' => $dadosPagamento[0]['CODE_TRANSACTION'],
					'NOME_PAGAMENTO' => $dadosPagamento[0]['NOME_PAGAMENTO']
				);
			}
			$this->load->view('/upadmin/pedidos/detalhe', $dados);
		}else{
			redirect("/upadmin/pedidos/index");
		}
	}

	
	public function pesquisarCategoria(){
		$dados = $this->input->post("dados");
		$this->load->model("CategoriasAdminModel");
		if(!empty($dados)){
			$resultado = $this->CategoriasAdminModel->pesquisarCategoria($dados);
			if(count($resultado)>0){
				$result["categorias"] = $resultado;
				$this->load->view("/upadmin/categorias/pesquisaCategoria", $result);
			}else{
				$result["categorias"] = $this->CategoriasAdminModel->buscarCategorias();
				$this->load->view("/upadmin/categorias/pesquisaCategoria", $result);
			}
		}else{
			$result["categorias"] = $this->CategoriasAdminModel->buscarCategorias();
			$this->load->view("/upadmin/categorias/pesquisaCategoria", $result);
		}
	}

	public function salvarCategoria(){
		try{
			
			$dados = $this->input->post("categoria", true);
			$this->load->model("CategoriasAdminModel");

			//valida o model
			$this->CategoriasAdminModel->validarCategoria($dados);
			
			//montar model
			$categoria = array(
				'NOME_CATEGORIA' => $dados['nomeCategoria'], 
				'DES_CATEGORIA' => $dados['descricaoCategoria'], 
				'URL_AMIGAVEL_CATEGORIA' => $dados['urlAmigavel'], 
				'COD_PAI_CATEGORIA' => $dados['categoriaPai'], 
				'KEYWORD_SEO' => $dados['keywordsSeo'], 
				'DESCRIPTION_SEO' => $dados['descriptionSeo'], 
				'TITLE_SEO' => $dados['titleSeo'], 
				'TIP_ATIVO' => (bool)$dados['ativo'], 
				'FOTO_CATEGORIA' => $dados['foto'], 
			);

			//verifica se é edição ou cadastro
			$salvar = array();

			if($dados['codigoCategoria'] != "0"){
				$salvar = $this->CategoriasAdminModel->editar($categoria, $dados['codigoCategoria']);

			}else{
				$salvar = $this->CategoriasAdminModel->salvar($categoria);
			}			
			if($salvar){
				$this->output
					->set_status_header(200)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'success' => 'Dados enviados com sucesso!')
        			  ));
			}else{
				$this->output
					->set_status_header(401)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'error' => 'Ocorreu um erro tente novamente!')
        			  ));
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
}
