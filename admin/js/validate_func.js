$(document).ready(function(){
	
	<!-- VALIDA CADASTRO DE CLIENTES NO SITE -->
	$("#cadastraImovelCliente-1").validate({
						   
				rules:{
				titulo:{required:true},
				negocio:{required:true},
				tipo:{required:true},
				valor:{required:true},
				descricao:{required:true},
				comodos:{required:true},
				banheiros:{required:true},
				salas:{required:true},
				facilidades:{required:true}
				},
				
	   messages:{
	            titulo:{required:"Informe o titulo!"},
				negocio:{required:"Selecione o negocio!"},
				tipo:{required:"Selecione o tipo!"},
				valor:{required:"Informe uo valor!"},
				descricao:{required:"Descreva o imóvel!"},
				comodos:{required:"Quantos quartos tem o imóvel?"},
				banheiros:{required:"Quantos banheiros tem o imóvel?"},
				salas:{required:"Quantas salas tem o imóvel?"},
				facilidades:{required:"Informe algumas facilidades!"}
		},						   
   });
   
   $("#cadastraImovelCliente-2").validate({
						   
				rules:{
				rua:{required: true},
				numero:{required: true},
				bairro:{required: true},
				proximo:{required: true}
				
				},
				
	   messages:{
	            rua:{required:"Informe o nome da Rua!"},
				numero:{required: "Número do imóvel no endereço!"},
				bairro:{required: "Informe o bairro!"},
				proximo:{required: "Alguma localização de referência!"}
		},						   
   });
   
   
				   
})