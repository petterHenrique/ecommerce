PNotify.prototype.options.styling = "bootstrap3";
PNotify.prototype.options.styling = "fontawesome";

const alertas = new UpsyAlertas();

function UpsyAlertas(){
	var self = this;

	//TODO: rever estes atributos
	self.tituloSucesso = "Sucesso!";
	self.msgSucesso = "Dados salvos com sucesso!";

	self.tituloErro = "Atenção!";
	self.msgErro = "Verifique os campos!";

	self.AlertaSucesso = function(titulo, msgSucesso){
		new PNotify({
		    title: titulo,
		    text:  msgSucesso,
		    addclass: 'custom',
		    type: 'success',
		    delay: 1500,
		    hide: true
		});
	}
	self.AlertaErro = function(titulo, msgErro){
		new PNotify({
		    title: titulo,
		    text:  msgErro,
		    addclass: 'custom',
		    type: 'notice',
		    delay: 1500,
		    hide: true
		});
	}

	self.Confirmar = function(titulo, msg, funcao){
		swal({
		  title: titulo,
		  text: msg,
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  buttons: ["Cancelar", "Ok"],
		})
		.then((willDelete) => {
		  if (willDelete) {
		  	funcao();
		  } else {
		    swal("Ação cancelada!");
		  }
		});
	}

	self.AlertaSucessoModal = function(mensagem){
		if(mensagem == null || mensagem == ""){
			mensagem = "Sucesso!";
		}
		swal(mensagem, {
	      icon: "success",
	    });
	}
	self.AlertaErroModal = function(mensagem){
		if(mensagem == null || mensagem == ""){
			mensagem = "Ocorreu um erro!";
		}
		swal(mensagem, {
	      icon: "error",
	    });
	}
}