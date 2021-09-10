<div id="pagina">
   
   <h1>Fale Conosco</h1>
   
     <div class="anuncie">
     <h2>Telefones:</h2>

    <p>
    (xx48) - 3237 3934<br />
    (xx48) - 9413 2491
    </p>
    
    <h2>Endereço:</h2>

    <p>
    Rua: manoel j pires n°35<br />
    Florianópolis - campeche<br />
    Cep: 88063-258 
    </p>
    
    <h2>E-mail's:</h2>

    <p>
    contato@upinside.com.br<br />
    loja@upinside.com.br<br />
    hospedagem@upinside.com.br
    </p>


     </div><!--fecha anuncies-->
   
  
   
     <form name="site_fale_conosco" id="site_fale_conosco" method="post" action="" enctype="multipart/form-data">
       

<?php if(isset($_POST['contato_site'])){
	
	$contatoNome   = strip_tags(trim($_POST['nome']));
	$contatoEmail  = strip_tags(trim($_POST['email']));
	$contatoMsg    = strip_tags(trim($_POST['msg']));
	$contatoData   = date('Y-m-d H:i:s');
	$contatoStatus = 'pendente';
	$codData   = date('d-H-i');
	$contatoCod    = $codData.'-'.$contatoEmail;
	
	$sql_verificaContato = 'SELECT emailCod FROM up_mailAdmin WHERE emailCod = :contatoCod';
	
	try{
		$query_verificaContato = $conecta->prepare($sql_verificaContato);
		$query_verificaContato->bindValue(':contatoCod',$contatoCod,PDO::PARAM_STR);
		$query_verificaContato->execute();
		
		$cont_verificaContato = $query_verificaContato->rowCount(PDO::FETCH_ASSOC);		
		
		}catch (PDOexcpetion $error_verificaCod){
		  echo 'Erro ao selecionar o codigo do email';	
		}
		
		
if($cont_verificaContato >= '1'){
     echo '<div class="enviado">Por favor aguarde algúns minutos para enviar uma nova mensagem! Obrigado!</div><!--envaido-->';
}else{
	
	$sql_contatoSite  = 'INSERT INTO up_mailAdmin (emailNome, emailEmail, emailMensagem, emailData, emailStatus, emailCod) ';
	$sql_contatoSite .= 'VALUES (:contatoNome, :contatoEmail, :contatoMsg, :contatoData, :contatoStatus, :contatoCod)';
	
	try{
		$query_cadastraContato = $conecta->prepare($sql_contatoSite);
		$query_cadastraContato->bindValue(':contatoNome',$contatoNome,PDO::PARAM_STR);
		$query_cadastraContato->bindValue(':contatoEmail',$contatoEmail,PDO::PARAM_STR);
		$query_cadastraContato->bindValue(':contatoMsg',$contatoMsg,PDO::PARAM_STR);
		$query_cadastraContato->bindValue(':contatoData',$contatoData,PDO::PARAM_STR);
		$query_cadastraContato->bindValue(':contatoStatus',$contatoStatus,PDO::PARAM_STR);
		$query_cadastraContato->bindValue(':contatoCod',$contatoCod,PDO::PARAM_STR);
		$query_cadastraContato->execute();
		
		echo '<div class="enviado">Seu e-mail foi envado com sucesso! Responderemos em breve!</div><!--envaido-->';
		
		}catch(PDOexception $error_cadastraMail){
		  'Erro ao enviar seu e-mail, favor tente mais tarde ou nos informe pelo contato@upimoveis.com.br';
		}
	
  }
}?>

       <fieldset><legend>Entre em contato!</legend> 
        
        <label>
          <span>Nome:</span>
          <input type="text" name="nome" />
        </label>
        
        <label>
          <span>E-mail:</span>
          <input type="text" name="email" />
        </label>
        
       
        <label>
          <span>Mensagem:</span>
          <textarea name="msg" rows="5"></textarea>
        </label>
        
           
          <input type="submit" name="contato_site" value="Fale conosco" class="btn" />
        
        
       </fieldset>
            
     </form>

</div><!--fecha pagina-->    
     
