$(function(){
  $("select[name=tipo]").change(function(){
	  beforeSend:$("select[name=categoria]").html('<option value="0">Aguarde Carregando...</option>');
	  
	  var categoria = $("select[name=tipo]").val();
	  $.post("filtro/categoria.php",{categoria: categoria},function(pega_cat){
		  complete:$("select[name=categoria]").html(pega_cat);
	  
	      $("select[name=categoria]").change(function(){
	      beforeSend:$("select[name=sub-cateria]").html('<option value="0">Aguarde Carregando...</option>');
	  
	      var imovel = $("select[name=categoria]").val();
	      $.post("filtro/imovel.php",{imovel: imovel},function(pega_imovel){
		     complete:$("select[name=sub-cat]").html(pega_imovel);
			 
				$("select[name=sub-cat]").change(function(){
	            beforeSend:$("select[name=bairro]").html('<option value="0">Aguarde Carregando...</option>');
	   
	            var bairro = $("select[name=sub-cat]").val();
	            $.post("filtro/bairro.php",{bairro: bairro},function(pega_bairro){
		        complete:$("select[name=bairro]").html(pega_bairro);
				
				
	            });
	          });
	        });
        });
	 });
  });	
})