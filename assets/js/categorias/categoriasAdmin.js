function Categorias(){
		var self= this;
		self.Validar = function(){
			if($("#nome-categoria").val() == ""){
				alertas.AlertaErro("Atenção","Preencha nome categoria!");
				$("#nome-categoria").focus();
				return false;
			}else if($("#url-amigavel").val() == ""){
				alertas.AlertaErro("Atenção","Preencha o campo Url Amigável!");
				$("#url-amigavel").focus();
				return false;
			}else if($("#title-seo").val() == ""){
				alertas.AlertaErro("Atenção","Preencha título SEO!");
				$("#title-seo").focus();
				return false;
			}else if($("#keyword-seo").val() == ""){
				alertas.AlertaErro("Atenção","Preencha as palavras chave!");
				$("#keyword-seo").focus();
				return false;
			}else if($("#description-seo").val() == ""){
				alertas.AlertaErro("Atenção","Preencha as description!");
				$("#description-seo").focus();
				return false;
			}
			else{
				return true;
			}
		}
		self.MontarViewModel = function(){
			let objeto = {
				codigoCategoria: $("#codigo-categoria").val(),
				nomeCategoria: $("#nome-categoria").val(),
				categoriaPai: $("#categoria-pai").val(),
				descricaoCategoria: $("#descricao-categoria").val(),
				urlAmigavel: $("#url-amigavel").val(),
				titleSeo: $("#title-seo").val(),
				keywordsSeo: $("#keyword-seo").val(),
				descriptionSeo: $("#description-seo").val(),
				ativo: $("#ativo").is(":checked") ? true : false,
				foto: $("#foto-categoria").val(),
			}
			return objeto;
		}
		self.Salvar = function(){
			$.ajax({
				method: "POST",
				url: site_url+"/index.php/categoriasAdmin/salvarCategoria",
				data:{ categoria: self.MontarViewModel()},
				dataType: "json",
				beforeSend: function(){
					loading();
				},
				success: function(data){
					alertas.AlertaSucesso("Sucesso!",data.success);
					setTimeout(function(){
						window.location.href = site_url+"index.php/categoriasAdmin/index";
					},1800);
				},
				error: function(data){
					console.log(data);
					alertas.AlertaErro("Atenção", data.responseJSON.error);
				},
				complete: function(data){
					loaded();
				}
			});
		}
	}