function Paginas(){

		var self = this;

		self.ValidarPagina = function(){
			if($("#nome-pagina").val() == ""){
				alertas.AlertaErro("Atenção","Preencha o título da página");
				$("#nome-pagina").focus();
				return false;
			}
			else if($("#descricao-pagina").val() == ""){
				alertas.AlertaErro("Atenção","Preencha alguma descrição da página");
				$("#descricao-pagina").focus();
				return false;
			}
			else{
				self.Salvar();
			}
		}

		self.Salvar = function(){
			$.ajax({
				method: "POST",
				url: site_url+"index.php/paginasAdmin/salvarPagina",
				data: {pagina: self.MontarModelPagina()},
				beforeSend: function(){
					//loading();
				},
				success: function(data){
					alertas.AlertaSucesso("Ok", data.success);
					console.log(data);
					setTimeout(function(){
						window.location.href=site_url+"index.php/paginasAdmin/";
					},1000);
				},
				error: function(data){
					alertas.AlertaErro("Atenção", data);
				},
				complete: function(){
					//loaded();
				}
			});
		}

		self.MontarModelPagina = function(){
			let obj = {
				codigoPagina: $("#codigo-pagina").val(),
				nomePagina: $("#nome-pagina").val(),
				descricaoPagina: $("#descricao-pagina").val(),
				ativo: $("#ativo").is(":checked") ? true : false
			};
			return obj;
		}

		self.UploadImagem = function(file){

			let comprimentoImagens = file.length;

			var arquivos = new FormData();

			for (var x = 0; x < comprimentoImagens; x++) {
			    arquivos.append("arquivos[]", file[x]);
			}

			$.ajax({
				method: "POST",
				url: site_url+"/index.php/paginasAdmin/uploadImagens",
				data: arquivos,
                cache:false,
        		contentType: false,
        		processData: false,
                success: function(data){
                    //aplica imagens no documento
                    for(var i = 0; i < data.imagens.length; i++){
                    	let img = site_url+"uploads/media/"+data.imagens[i];
                    	$('#descricao-pagina').summernote("insertImage", img, 'filename');
                    	console.log(img);
                    }
                }, 
                error: function(data){
                	console.log(data);
                }
			});

		}
	}