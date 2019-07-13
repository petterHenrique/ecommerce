<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include "MasterLogado.php";
include "Util.php";

class ProdutosAdmin extends MasterLogado {

	public function index()
	{
		$this->load->model("ProdutosAdminModel");
		$dados['produtos'] = $this->ProdutosAdminModel->buscarProdutos();
		$this->load->view('/upadmin/produtos/index', $dados);
	}

	public function criar()
	{
		$this->load->model("MarcasAdminModel");
		$this->load->model("CategoriasAdminModel");
		$dados['marcas'] = $this->MarcasAdminModel->buscarTodasMarcas();
		$dados['categorias'] = $this->CategoriasAdminModel->buscarCategoriasAtivasMenu();
		$this->load->view('/upadmin/produtos/criar', $dados);
	}

	public function teste(){
		$this->load->model("ProdutosAdminModel");
		$dado = $this->ProdutosAdminModel->buscarProdutoPorId(53);
		echo json_encode($dado);
	}

	public function editar(){

		$id = $this->input->get("id");

		if(!empty($id)){

			$this->load->model("ProdutosAdminModel");
			$this->load->model("MarcasAdminModel");
			$this->load->model("CategoriasAdminModel");
			
			$dados["dadosProduto"] = $this->ProdutosAdminModel->buscarProdutoPorId($id);
			$dados['marcas'] = $this->MarcasAdminModel->buscarTodasMarcas();
			$dados['categorias'] = $this->CategoriasAdminModel->buscarCategoriasAtivasMenu();

			$fotosProduto = $this->ProdutosAdminModel->buscarFotosProduto($id);

			$fotosFisicas = array();

			//aqui eu atribuo um array de arquivos das fotos do produto

			foreach ($fotosProduto as $foto) {
				
				$fotoFisica = file_get_contents(base_url().$foto['FOTO_PRODUTO']);

				$objFoto = new StdClass();
				$objFoto->bytes = filesize("./".$foto['FOTO_PRODUTO']);
				$objFoto->type = pathinfo(base_url().$foto['FOTO_PRODUTO'], PATHINFO_EXTENSION);
				$objFoto->name = basename(base_url().$foto['FOTO_PRODUTO']);

				array_push($fotosFisicas, $objFoto);
			}

			//aqui eu transformo em um objeto json para utilizar no javascript

			$dados["fotosProduto"] = json_encode($fotosFisicas);

			$this->load->view('/upadmin/produtos/editar', $dados);

		}else{

			redirect("/upadmin/produtos/index");

		}
	}


	public function salvarProduto(){

		try{

			$fotosProduto = empty($_FILES['fotos']) ? null : $_FILES['fotos'];
			$modeloProduto = json_decode($this->input->post('modelo'));

			$produto = array(
				'EAN_PRODUTO' => $modeloProduto->eanProduto, 
				'NOME_PRODUTO' => $modeloProduto->nomeProduto, 
				'NCM_PRODUTO' => $modeloProduto->ncmProduto, 
				'DES_PRODUTO' => $modeloProduto->descricaoProduto,
				'PRECO_PRODUTO' => $modeloProduto->precoProduto,
				'PRECO_PROMO_PRODUTO' => $modeloProduto->promoProduto,
				'DTA_INICIAL_PROMO' => Util::ConverterDataFormatoAmericano($modeloProduto->dtaInicialPromo),
				'DTA_FINAL_PROMO' => Util::ConverterDataFormatoAmericano($modeloProduto->dtaFinalProdmo),
				'MODELO_PRODUTO' => $modeloProduto->modelProduto,
				'PESO_PRODUTO' => $modeloProduto->pesoProduto,
				'COMPRIMENTO_PRODUTO' => $modeloProduto->comprimentoProduto,
				'LARGURA_PRODUTO' => $modeloProduto->larguraProduto,
				'ALTURA_PRODUTO' => $modeloProduto->alturaProduto,
				'ESTOQUE_PRODUTO' => $modeloProduto->estoqueProduto,
				'KEYWORD_SEO' => $modeloProduto->keyWordsSeo,
				'DESCRIPTION_SEO' => $modeloProduto->descriptionSeo,
				'TITLE_SEO' => $modeloProduto->tituloSeo,
				'URL_AMIGAVEL_PRODUTO' => $modeloProduto->urlAmigavelProduto,
				'TIP_ATIVO' => $modeloProduto->tipAtivo,
				'TIP_ARMA' => $modeloProduto->tipArma,
				'TIP_DESTAQUE' => $modeloProduto->tipDestaque,
				'COD_MARCA' => $modeloProduto->marcaProduto,
			);

			//aqui eu salvo o produto banco de dados

			$this->load->model("ProdutosAdminModel");

			$salvarProdutoRetornarCodigoInserido = $this->ProdutosAdminModel->salvar($produto);

			//agora eu atribuo as categoria
			$this->load->model("CategoriasAdminModel");			

			foreach ($modeloProduto->categorias as $categoria) {

				$categoriaProduto = array(
					'COD_PRODUTO' =>  $salvarProdutoRetornarCodigoInserido,
					'COD_CATEGORIA' => $categoria
				);

				$this->CategoriasAdminModel->salvarCategoriaProduto($categoriaProduto);
			}

			//verifico se existe fotos se sim inclui senao n faz nada

			if($fotosProduto){

				$totalFotos = count($_FILES['fotos']['name']);

				for($i=0; $i<$totalFotos;$i++){

					$fileName = $_FILES['fotos']['name'][$i];
					$diretorio = './uploads/catalogo/';

					//verifica se existe senão cria
					if (!is_dir($diretorio)) {
					    mkdir($diretorio);         
					}

					move_uploaded_file($_FILES['fotos']['tmp_name'][$i], './uploads/catalogo/'.$fileName);
		
				    $urlFoto = '/uploads/catalogo/'.$fileName;	

					$fotoProduto = array(
						'COD_PRODUTO' => $salvarProdutoRetornarCodigoInserido,
						'TITULO_FOTO_PRODUTO' => $_FILES['fotos']['name'][$i],
						'FOTO_PRODUTO' => $urlFoto
					);

					$this->ProdutosAdminModel->salvarFotoProduto($fotoProduto);
				}	   
			}

			//retorno sucesso






			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true)
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

	public function editarProduto(){
		try{

			$fotosProduto = empty($_FILES['fotos']) ? null : $_FILES['fotos'];
			$modeloProduto = json_decode($this->input->post('modelo'));

			$produto = array(
				'EAN_PRODUTO' => $modeloProduto->eanProduto, 
				'NOME_PRODUTO' => $modeloProduto->nomeProduto, 
				'NCM_PRODUTO' => $modeloProduto->ncmProduto, 
				'DES_PRODUTO' => $modeloProduto->descricaoProduto,
				'PRECO_PRODUTO' => $modeloProduto->precoProduto,
				'PRECO_PROMO_PRODUTO' => $modeloProduto->promoProduto,
				'DTA_INICIAL_PROMO' => Util::ConverterDataFormatoAmericano($modeloProduto->dtaInicialPromo),
				'DTA_FINAL_PROMO' => Util::ConverterDataFormatoAmericano($modeloProduto->dtaFinalProdmo),
				'MODELO_PRODUTO' => $modeloProduto->modelProduto,
				'PESO_PRODUTO' => $modeloProduto->pesoProduto,
				'COMPRIMENTO_PRODUTO' => $modeloProduto->comprimentoProduto,
				'LARGURA_PRODUTO' => $modeloProduto->larguraProduto,
				'ALTURA_PRODUTO' => $modeloProduto->alturaProduto,
				'ESTOQUE_PRODUTO' => $modeloProduto->estoqueProduto,
				'KEYWORD_SEO' => $modeloProduto->keyWordsSeo,
				'DESCRIPTION_SEO' => $modeloProduto->descriptionSeo,
				'TITLE_SEO' => $modeloProduto->tituloSeo,
				'URL_AMIGAVEL_PRODUTO' => $modeloProduto->urlAmigavelProduto,
				'TIP_ATIVO' => $modeloProduto->tipAtivo,
				'TIP_ARMA' => $modeloProduto->tipArma,
				'TIP_DESTAQUE' => $modeloProduto->tipDestaque,
				'COD_MARCA' => $modeloProduto->marcaProduto,
			);

			//aqui eu salvo o produto banco de dados

			$this->load->model("ProdutosAdminModel");

			$atualizarProduto = $this->ProdutosAdminModel->editar($produto, $modeloProduto->codigoProduto);

			//agora eu atribuo as categoria
			$this->load->model("CategoriasAdminModel");			

			foreach ($modeloProduto->categorias as $categoria) {

				$categoriaProduto = array(
					'COD_PRODUTO' =>  $modeloProduto->codigoProduto,
					'COD_CATEGORIA' => $categoria
				);

				$this->CategoriasAdminModel->salvarCategoriaProduto($categoriaProduto);
			}

			
			//nesse momento ele exclui as imagens de exclusao
			foreach ($modeloProduto->fotosExclusao as $fotoEx) {

				$imagemExcluida = $this->ProdutosAdminModel->retornarImagemCodigo($fotoEx)[0];

				$arquivoExclusao = base_url().$imagemExcluida['FOTO_PRODUTO'];

				if (is_readable($arquivoExclusao)) {
				    unlink($arquivoExclusao);
				}

				
				$this->ProdutosAdminModel->removerFoto($imagemExcluida['COD_FOTO_PRODUTO']);
			}

			//agora eu atribuo as categoria
			/*$this->load->model("CategoriasAdminModel");			

			foreach ($modeloProduto->categorias as $categoria) {

				$categoriaProduto = array(
					'COD_PRODUTO' =>  $salvarProdutoRetornarCodigoInserido,
					'COD_CATEGORIA' => $categoria
				);

				$this->CategoriasAdminModel->salvarCategoriaProduto($categoriaProduto);
			}*/

			//verifico se existe fotos se sim inclui senao n faz nada

			if($fotosProduto){

				$totalFotos = count($_FILES['fotos']['name']);

				for($i=0; $i<$totalFotos;$i++){

					$fileName = $_FILES['fotos']['name'][$i];
					$diretorio = './uploads/catalogo/';

					//verifica se existe senão cria
					if (!is_dir($diretorio)) {
					    mkdir($diretorio);         
					}

					move_uploaded_file($_FILES['fotos']['tmp_name'][$i], './uploads/catalogo/'.$fileName);
		
				    $urlFoto = '/uploads/catalogo/'.$fileName;	

					$fotoProduto = array(
						'COD_PRODUTO' => $modeloProduto->codigoProduto,
						'TITULO_FOTO_PRODUTO' => $_FILES['fotos']['name'][$i],
						'FOTO_PRODUTO' => $urlFoto
					);

					$this->ProdutosAdminModel->salvarFotoProduto($fotoProduto);
				}	   
			}

			//retorno sucesso

			$this->output
				->set_status_header(200)
				->set_content_type('application/json')
        		->set_output(json_encode(array(
        			'sucesso' => true,
        			'dados' => $modeloProduto)
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

	public function excluirProduto(){
		$dados = $this->input->post("id");
		if(!empty($dados)){
			$this->load->model("ProdutosAdminModel");
			if($this->ProdutosAdminModel->excluir($dados)){
				$this->output
					->set_status_header(200)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'success' => 'Produto removido com sucesso!')
        			));
			}else{
				$this->output
					->set_status_header(401)
        			->set_content_type('application/json')
        			->set_output(json_encode(array(
        				'error' => 'Não foi possível excluir o Produto!')
        			));
			}
		}
	}

	public function pesquisarPagina(){
		$dados = $this->input->post("dados");
		$this->load->model("PaginasAdminModel");
		if(!empty($dados)){
			$resultado = $this->PaginasAdminModel->pesquisarPagina($dados);
			if(count($resultado)>0){
				$result["paginas"] = $resultado;
				$this->load->view("/upadmin/paginas/pesquisaPagina", $result);
			}else{
				$result["paginas"] = $this->PaginasAdminModel->buscarCategorias();
				$this->load->view("/upadmin/paginas/pesquisaPagina", $result);
			}
		}else{
			$result["paginas"] = $this->PaginasAdminModel->buscarPaginas();
			$this->load->view("/upadmin/paginas/pesquisaPagina", $result);
		}
	}

	public function salvarPagina(){
		try{
			
			$dados = $this->input->post("pagina", true);
			$this->load->model("PaginasAdminModel");
			//montar model
			$pagina = array(
				'TITULO_PAGINA' => $dados['nomePagina'], 
				'DES_PAGINA' => $dados['descricaoPagina'], 
				'TIP_ATIVO' => $dados['ativo']
			);
			//verifica se é edição ou cadastro
			$salvar = array();

			if($dados['codigoPagina'] != "0"){
				$salvar = $this->PaginasAdminModel->editar($pagina, $dados['codigoPagina']);

			}else{
				$salvar = $this->PaginasAdminModel->salvar($pagina);
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

	/* Funções úteis */

	private function salvarFotoProdutoPasta($foto)
	{   

		echo "pasta metodo";
		echo var_dump($foto);

		$fileName = $foto['name'];
		$diretorio = './uploads/catalogo/';

		//verifica se existe senão cria
		if (!is_dir($diretorio)) {
		    mkdir($diretorio);         
		}

		move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], './uploads/catalogo/'.$fileName);
		
		return './uploads/catalogo/'.$fileName;	
	}
}
