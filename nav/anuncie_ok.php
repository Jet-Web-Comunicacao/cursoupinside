<div id="pagina">
   
   <div class="anuncie_ok">
   <h1>Veja abaixo os dados:</h1>
   
   <?php
    $criadoEm         = date('Y-m-d H:i:s');
	$modificadoEm     = date('Y-m-d H:i:s');
	$clienteNivel     = 'cliente';
	$clienteStatus    = 'pendente';
    $clienteNome      = strip_tags(trim($_POST['nome']));
	$clienteEmail     = strip_tags(trim($_POST['email']));
	
	
	$sql_verificaMail = 'SELECT email FROM up_clientes WHERE email = :clienteEmail';
	
	try{
		$query_verificaMail = $conecta->prepare($sql_verificaMail);
		$query_verificaMail->bindValue(':clienteEmail',$clienteEmail,PDO::PARAM_STR);
		$query_verificaMail->execute();
		
		$count_verificaMail = $query_verificaMail->rowCount(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $erro_verificaMail){
		  echo 'Erro ao selecionar verificador';
		}
		
		
  if($count_verificaMail >= '1'){
	  echo '<h2>Desculpe. o e-mail que você informou já foi cadastrado em nosso sitema!</h2><p>Não é possivel realizar seu cadastro com este e-mail!</p>';    
  }else{
	
	
	
	$clienteSenha     = strip_tags(trim(md5($_POST['senha'])));
	$clienteSenha_mail  = strip_tags(trim($_POST['senha']));
	$clienteTelefone  = strip_tags(trim($_POST['telefone']));
	
	$sql_cadastraCliente  = 'INSERT INTO up_clientes (criadoEm, modificadoEm, clienteStatus, usuarioNivel, nome, email, senha, telefone) ';
    $sql_cadastraCliente .= 'VALUES (:criadoEm, :modificadoEm, :clienteStatus, :usuarioNivel, :nome, :email, :senha, :telefone)';
	
	try{
		  $query_cadastraCliente = $conecta->prepare($sql_cadastraCliente);
		  $query_cadastraCliente->bindValue(':criadoEm',$criadoEm,PDO::PARAM_STR);
		  $query_cadastraCliente->bindValue(':modificadoEm',$modificadoEm,PDO::PARAM_STR);
		  $query_cadastraCliente->bindValue(':clienteStatus',$clienteStatus,PDO::PARAM_STR);
		  $query_cadastraCliente->bindValue(':usuarioNivel',$clienteNivel,PDO::PARAM_STR);
		  $query_cadastraCliente->bindValue(':nome',$clienteNome,PDO::PARAM_STR);
		  $query_cadastraCliente->bindValue(':email',$clienteEmail,PDO::PARAM_STR);
		  $query_cadastraCliente->bindValue(':senha',$clienteSenha,PDO::PARAM_STR);
		  $query_cadastraCliente->bindValue(':telefone',$clienteTelefone,PDO::PARAM_STR);
		  $query_cadastraCliente->execute();
		  
		  $mail_data = date('d/m/Y H:i:s');
		  $meuEmail = 'teste@upinside.com.br';
		  $assunto = 'Novo cliente cadastrado '.$clienteNome;
		  $headers = "From: $meuEmail\n";
		  $header .= "content-type: text/html; charset=\"utf-8\"\n\n";
		  $mensagemSistema = "
		  
		  Novo cliente cadastrado:<br />
		  <strong>Cliente Nome:</strong> $clienteNome<br />
		  <strong>Cliente E-mail:</strong> $clienteEmail<br />
		  <br />
          <br />
          Mensagem enviada em: $mail_data
		  ";
		  mail($meuEmail,$assunto,$mensagemSistema,$headers);
		  
		  $clienteAssunto = 'Cadastro com sucesso UPIMOVEIS';
		  $mensagemCliente = "
		  <strong>E-mail de segurança, guarde esse e-mail para consulta!</strong><br />
		  Seus dados são:<br /><br />
          Login: $clienteEmail<br />
          Senha: $clienteSenha_mail<br /><br />
          
		  Seu cadastro foi criado em $criadoEm!<br /><br />

          Está é uma mensagem automática de nosso sistema, você não precisa responder!
		  <br />
          <br />
          Mensagem enviada em: $mail_data
          ";
		  
		  mail($clienteEmail,$clienteAssunto,$mensagemCliente,$headers);
		  
		  
		  echo '<h2>Cadastro com sucesso!</h2>';
		  echo '<p>Seu cadastro foi realizado com sucesso! para acessar seu painel e começar a anunciar <a href="admin/index.php">CLIQUE AQUI.</a><br />
                   Ou efetue login na central do anúnciante!</p>';
		  echo '<p>Por segurnça nos enviamos uma cópia de seu cadastro para o e-mail <strong>'.$clienteEmail.'</strong></p>';
		
		
	}catch(PDOexception $error_cadastro){
	   echo '<h2>Erro ao cadastrar, por favor tenten novamente ou nos informe o erro no e-mail contato@upimoveis.com.br</h2>';
	}
  }
   
   ?>
   
   </div><!--fecha class anuncie_ok-->
   
</div><!--fecha pagina-->    
     
