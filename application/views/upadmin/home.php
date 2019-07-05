<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
     <?php include "inc/header.php"; ?>

</head>
<body>
<div class="page">
    <div class="page-main">
        <?php include "layout/navbar.php"; ?>
        <div class="my-3 my-md-5">
            <div class="container">
                <div class="page-header">
                    <h1 class="page-title">
                        Dashboard
                    </h1>
                </div>
                <div class="row row-cards">
                    <div class="col-6 col-sm-4 col-lg-2">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="h1 m-0"><?=$contadores['COMENTARIOS']?></div>
                                <div class="text-muted mb-4">Comentários</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="h1 m-0"><?=$contadores['PEDIDOS_HOJE']?></div>
                                <div class="text-muted mb-4">Pedidos Hoje</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="h1 m-0"><?=$contadores['TICKET']?></div>
                                <div class="text-muted mb-4">Ticket Médio</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="h1 m-0"><?=$contadores['CLIENTES']?></div>
                                <div class="text-muted mb-4">Clientes</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="h1 m-0"><?=$contadores['FATURAMENTO']?></div>
                                <div class="text-muted mb-4">Faturamento</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-lg-2">
                        <div class="card">
                            <div class="card-body p-3 text-center">
                                <div class="h1 m-0"><?=$contadores['PRODUTOS']?></div>
                                <div class="text-muted mb-4">Produtos</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cards row-deck">
                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                    <thead>
                                    <tr>
                                        <th class="text-center w-1">N° Pedido</th>
                                        <th>Cliente</th>
                                        <th>Total</th>
                                        <th class="text-center">Pagamento</th>
                                        <th>Atividade</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center"><i class="icon-settings"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    	foreach ($pedidos as $pedido) { 
                                    ?>
                        			
                                    <tr>
                                        <td class="text-center">
                                            <?=$pedido['CODIGO_PEDIDO']?>
                                        </td>
                                        <td>
                                            <a href="<?=base_url()?>index.php/pedidosAdmin/detalhe?id=<?=$pedido['COD_PEDIDO']?>"><?=$pedido['NOME_CLIENTE']?></a>
                                        </td>
                                        <td>
        									R$ 
        									<?php 

        									$qtd = (int)$pedido['QTD_PRODUTO'];
        									$vlrProduto = number_format($pedido['VLR_PRODUTO'], 2, '.', ' ');

       										$resultado = $qtd * $vlrProduto;
        									echo number_format($resultado, 2, ',', ' ');
        									?>
        					
                                        </td>
                                        <td class="text-center">

                                        <?php 
                                     
                                        	if($pedido['FORMA_PAGAMENTO'] == "PAGSEGUROCARTAO"){
                                        		echo '<i class="payment payment-visa"></i>';
                                        	}else {
                                        		echo '<i class="payment payment-boleto2"></i>';
                                        	}
                                        ?>

                                            
                                        </td>
                                        <td>
                                            <div class="small text-muted">Registrado</div>
                                            <div><?=date("d/m/Y", strtotime($pedido['DTA_CRIACAO_PEDIDO']));?></div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success"><?=$pedido['DES_STATUS']?></span>
                                        </td>
                                        <td class="text-center">
                                            <div class="item-action dropdown">
                                                <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?=base_url()?>index.php/pedidosAdmin/detalhe?id=<?=$pedido['COD_PEDIDO']?>" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Detalhes </a>
                                                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Alterar Status </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php 
                                		}
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- orçamentos -->
                     <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Orçamentos</h4>
                            </div>
                           	<table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                                <thead>
                                    <tr>
  
                                        <th>Cliente</th>
                                        <th>E-mail</th>
                                        <th class="text-center">Telefone</th>
                                        <th>Região</th>
                                        <th class="text-center">Produto</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Data Solitação</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($orcamentos as $orcamento) { ?>
                                	<tr>

                                        <td>
                                            <?=$orcamento['DES_CLIENTE']?>
                                        </td>
                                        <td>
        									<?=$orcamento['DES_EMAIL']?>
                                        </td>
                                        <td class="text-center">
                                            <?=$orcamento['DES_TELEFONE']?>
                                        </td>
                                        <td class="text-center">
                                            <span style="text-transform:uppercase;"><?=$orcamento['DES_UF']?></span>
                                        </td>
                                         <td class="text-center">
                                            <?=$orcamento['NOME_PRODUTO']?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
	                                            $class = "";
	                                            $text = "";
	                                            switch ($orcamento['COD_STATUS']) {
	                                            	case 1:
	                                            		$class = "badge badge-warning";
	                                            		$text = "Pendente";
	                                            		break;
	                                            	case 2:
	                                            		$class = "badge badge-success";
	                                            		$text = "Enviado";
	                                            		break;
	                                            }
                                            ?>
                                            <span class="<?=$class?>"><?=$text?></span>
                                        </td>
                                        <td class="text-center">
                                            <?=date('d/m/Y - H:i:s', strtotime($orcamento['DTA_SOLICITACAO']))?>
                                        </td>
                                        <td class="text-center">
                                            <div class="item-action dropdown">
                                                <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <span style="cursor:pointer;" onclick="ResponderOrcamento('<?=$orcamento['COD_ORCAMENTO']?>', '<?=$orcamento['DES_CLIENTE']?>', '<?=$orcamento['NOME_PRODUTO']?>', '<?=$orcamento['DES_EMAIL']?>')" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Responder</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php 
                                	} 
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-6" style="display:none;">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Estatística de Acesso</h4>
                            </div>
                            <table class="table card-table">
                                <tr>
                                    <td width="1"><i class="fa fa-chrome text-muted"></i></td>
                                    <td>Google Chrome</td>
                                    <td class="text-right"><span class="text-muted">23%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-firefox text-muted"></i></td>
                                    <td>Mozila Firefox</td>
                                    <td class="text-right"><span class="text-muted">15%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-safari text-muted"></i></td>
                                    <td>Apple Safari</td>
                                    <td class="text-right"><span class="text-muted">7%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-internet-explorer text-muted"></i></td>
                                    <td>Internet Explorer</td>
                                    <td class="text-right"><span class="text-muted">9%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-opera text-muted"></i></td>
                                    <td>Opera mini</td>
                                    <td class="text-right"><span class="text-muted">23%</span></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-edge text-muted"></i></td>
                                    <td>Microsoft edge</td>
                                    <td class="text-right"><span class="text-muted">9%</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6" style="display:none;">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Usuários</h3>
                            </div>
                            <div class="card-body o-auto" style="height: 15rem">
                                <ul class="list-unstyled list-separated">
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/12.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Amanda Hunt</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">amanda_hunt@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/21.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Laura Weaver</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">lauraweaver@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/29.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Margaret Berry</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">margaret88@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/2.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Nancy Herrera</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">nancy_83@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/male/34.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Edward Larson</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">edward90@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-separated-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="avatar avatar-md d-block" style="background-image: url(demo/faces/female/11.jpg)"></span>
                                            </div>
                                            <div class="col">
                                                <div>
                                                    <a href="javascript:void(0)" class="text-inherit">Joan Hanson</a>
                                                </div>
                                                <small class="d-block item-except text-sm text-muted h-1x">joan.hanson@example.com</small>
                                            </div>
                                            <div class="col-auto">
                                                <div class="item-action dropdown">
                                                    <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-tag"></i> Action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Another action </a>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-message-square"></i> Something else here</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-link"></i> Separated link</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <!-- modal responder orcaçemto -->
    <div id="modal-orcamento" class="modal fade" role="dialog">
	    <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Solicitação de Orçamento</h4>
		      </div>
		      <div class="modal-body">
		        <form action="/action_page.php">
				  <div class="form-group">
				    <label for="nomecli">Cliente:</label>
				    <input type="text" readonly class="form-control" id="nome-cliente-orcamento">
				  </div>
				   <div class="form-group">
				    <label for="nomecli">Produto:</label>
				    <input type="text" readonly class="form-control" id="produto-orcamento">
				  </div>

				  <input type="hidden"  class="form-control" id="email-envio">
				  <input type="hidden"  class="form-control" id="cod-orcamento">
				  
				  <div class="form-group">
					  <label for="comment">Mensagem:</label>
					  <textarea class="form-control" rows="5" id="mensagem-orcamento"></textarea>
				  </div>
				  <button type="button" class="btn btn-success btn-enviar-orcamento"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> &nbsp; Enviar</button>
				</form>
		      </div>
		      <div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
		      </div>
		    </div>
	    </div>
	</div>


    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © <?=date("Y"); ?> <a href="https://www.upsy.com.br" target="_blank">Upsy Tecnologia - E-commerce</a> Todos os Direitos Reservados.
                </div>
            </div>
        </div>
    </footer>
</div>
<?php include "inc/footer.php"; ?>
<script> 

$(function(){
	BuscarOrcamentos();
});

$(document).on("click", ".btn-enviar-orcamento", function(){
	if(ValidarOrcamento()){
		$.ajax({
			url: "<?=base_url()?>index.php/Dashboard/enviarOrcamento",
			method: "POST",
			data: { 
				nome: $("#nome-cliente-orcamento").val(),
				email: $("#email-envio").val(),
				msg: $("#mensagem-orcamento").val(),
				codigo: $("#cod-orcamento").val()
			},
			beforeSend: function(){

			},
			success: function(data){
				console.log(data);
			},
			error: function(data){
				console.log(data);
			},
			complete: function(){

			}
		});
	}	
});

function ResponderOrcamento(codOrcamento,nomeCliente, nomeProduto, emailCliente){

	$("#modal-orcamento").modal("show");
	$("#cod-orcamento").val(codOrcamento);
	$("#nome-cliente-orcamento").val(nomeCliente);
	$("#produto-orcamento").val(nomeProduto);
	$("#email-envio").val(emailCliente);

	setTimeout(function(){
		$("#mensagem-orcamento").focus();
	});

}

function BuscarOrcamentos(){

	$.ajax({
		method: "",
		url: "",
		data:{},
		success:function(){

		},
		error: function(){

		},
		complete: function(){
			setTimeout(function(){
				BuscarOrcamentos();
			},30000);
		}
	});

}

function ValidarOrcamento(){
	if($("#mensagem-orcamento").val() == ""){
		alertas.AlertaErro("Atenção","Informe os dados referente ao orçamento!");
		$("#mensagem-orcamento").focus();
		return false;
	}else{
		return true;
	}
}

</script>
</body>
</html>