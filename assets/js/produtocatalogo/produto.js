
const produto = new Produto();

$(document).ready(function(){
	
	produto.AplicarMask();

	$('#foto-principal').zoom();

	$(".btn-solicitar-orcamento").on("click", function(){
		produto.SolicitarOrcamentos();
	});

});

$(document).on("click",".btn-adicionar", function(){

	$(this).html('<i class="fas fa-spin fa-spinner"></i>');
	let sku = $(this).data('sku');
	let nome = $(this).data('nome-produto');
	let img = $(this).data('img');
	produto.AdicionarCarrinho(sku, nome,img, $(this));
});

function Produto(){

	var self = this;

	self.ValidarOrcamento = function(){

		let email = $("#email-leed");
		let nome = $("#nome-leed");
		let contato = $("#contato-leed");
		let regiao = $("#regiao-leed");

		if(nome.val() == ""){
			alertas.AlertaErro("Atenção", "Informe seu nome!");
			nome.focus();
			return false;
		}
		else if(email.val() == ""){
			alertas.AlertaErro("Atenção", "Informe seu e-mail!");
			email.focus();
			return false;
		}
		else if(contato.val() == ""){
			alertas.AlertaErro("Atenção", "Informe seu contato!");
			contato.focus();
			return false;
		}
		else if(regiao.val() == ""){
			alertas.AlertaErro("Atenção", "Informe sua região!");
			regiao.focus();
			return false;
		}else{
			return true;
		}
	}

	self.SolicitarOrcamentos = function(){

		if(self.ValidarOrcamento()){

			$.ajax({
				method: "POST",
				url: site_url + "index.php/produtos/solicitarOrcamento",
				data: {
					codigoProduto: $("#cod-produto").val(),
					desCliente: $("#nome-leed").val(),
					desEmail: $("#email-leed").val(),
					desTelefone: $("#contato-leed").val(),
					desUf: $("#regiao-leed").val()
				},
				beforeSend: function(){
					$("#formulario-orcamento").hide();
					let elemento = $("#loading-orcamento").html();
					$(".loading").html(elemento);
				},
				success: function(data){
					if(data.sucesso){
						setTimeout(function(){

							$(".loading").empty();
							$("#formulario-orcamento").show();

							Swal.fire({
							    title: 'Dados enviados com sucesso, nossa equipe irá entrar em contato :)',
							    type: 'success',
							    animation: false,
							    showCancelButton: false,
								showConfirmButton: false,
							    customClass: 'animated fadeIn'
							});

						},1400);
					}
				},
				error: function(data){
					console.log(data);
				},
				complete: function(){
					self.LimparCamposOrcamento();
				}
			});

		}
	}

	self.LimparCamposOrcamento = function(){
		$("#email-leed").val("");
		$("#nome-leed").val("");
		$("#contato-leed").val("");
		$("#regiao-leed").val("");
	}

	self.AdicionarCarrinho = function(sku, nome, img, contexto){
		$.ajax({
			url: site_url+"index.php/Carrinho/adicionarCarrinho",
			method: "POST",
			data: {codigoProduto: sku, nomeProduto: nome, qtd:1,img:img },
			beforeSend: function(){

			},
			success: function(data){
				if(data.sucesso){
					Swal.fire(
					  'Sucesso!',
					  data.mensagem,
					  'success'
					)

					//atualiza o total carrinho
					self.AtualizaTotalCarrinho();
				}
			},
			error: function(data){
				console.log(data);
			},
			complete: function(){
				$(contexto).html('<i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho');
			}
		});
	}
	self.AtualizaTotalCarrinho = function(){
		$.post(site_url +"index.php/carrinho/totalItens", {}, function(response){
			if(response.sucesso){
				$("#total-carrinho").text(response.total);
			}
		});

	}

	self.RemoverCarrinho = function(){

	}

	self.CalcularFrete = function(){

	}

	self.SalvarComentario = function(){

	}

	self.AplicarMask = function(){
		 $("#contato-leed").mask("(99) 99999-9999");
	}
}