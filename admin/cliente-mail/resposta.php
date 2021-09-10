<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Responder E-mails</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
   
<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Responder'){

$sendId = $_POST['sendId'];
$sendTo = $_POST['sendTo'];
$sendMsg = strip_tags(trim($_POST['sendMsg']));

$sendAssunto = 'Respostas UpImóveis';
$sendStatus = 'completo';
$headers = "From: $clienteEmail\n";
$header .= "content-type: text/html; charset=\"utf-8\"\n\n";

mail($sendTo,$sendAssunto,$sendMsg,$headers);

$sql_sendMails = 'UPDATE up_mailcliente SET emailResTxt = :emailResTxt, emailStatus = :emailStatus WHERE emailId = :emailId';

try{
	$query_sendMail = $conecta->prepare($sql_sendMails);
	$query_sendMail->bindValue(':emailResTxt',$sendMsg,PDO::PARAM_STR);
	$query_sendMail->bindValue(':emailStatus',$sendStatus,PDO::PARAM_STR);
	$query_sendMail->bindValue(':emailId',$sendId,PDO::PARAM_STR);
	$query_sendMail->execute();
	
	echo '<div class="ok">E-mail respondido com sucesso!</div>';
	echo '<div class="ok"><strong>AGUARDE:</strong> Estamos redirecionando para caixa de entrada!</div>';
	echo '<meta http-equiv="refresh" content="3, URL=painel.php?exe=cliente-mail/entrada" />';
	
	}catch(PDOexception $erro_sendMail){
	   echo 'Erro ao responder por favor nos informe via ticket!';	
	}
	
}?>   
   

<?php include_once("sistema/carregando.php");?>
   
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr style="color:#FFF; background:#666;">
    <td align="center">DATA:</td>
    <td align="center">NOME:</td>
    <td align="center">E-MAIL:</td>
    <td align="center">TELEFONE:</td>
    <td align="center">VISUALIZAR/RESPONDER:</td>
  </tr>
  <?php
  $emailStatus = 'pendente';
  $emailId = $_GET['mail'];
  $sql_mailCliente = 'SELECT * FROM up_mailcliente WHERE clienteId = :clienteId AND emailId =                      :emailId ORDER BY emailData ASC';
  
  try{
	  $query_mailCliente = $conecta->prepare($sql_mailCliente);
	  $query_mailCliente->bindValue(':clienteId',$clienteId,PDO::PARAM_STR);
	  $query_mailCliente->bindValue(':emailId',$emailId,PDO::PARAM_STR);
	  $query_mailCliente->execute();
	  
	  $resultado_mailCliente = $query_mailCliente->fetchAll(PDO::FETCH_ASSOC);
	  $count_mailCliente = $query_mailCliente->rowCount(PDO::FETCH_ASSOC);
	  
	  }catch(PDOexception $error_mailCliente){
		echo 'Erro ao selecionar e-mails dos clientes!';  
	  }
	  
	  foreach($resultado_mailCliente as $resMail){
		  $emailId      = $resMail['emailId'];
		  $emailCliente = $resMail['clienteId'];
		  $emailNome    = $resMail['emailNome'];
		  $emailMail    = $resMail['emailMail'];
		  $emailFone    = $resMail['emailFone'];
		  $emailMsg     = $resMail['emailMsg'];
		  $emailData    = $resMail['emailData'];
		  $emailResTxt  = $resMail['emailResTxt'];
		  $emailRes     = $resMail['emailRes'];
		  $emailStatus  = $resMail['emailStatus'];
          $cor = 'style="background:#f4f4f4;"';
  
  ?>
  
  <tr <?php echo $cor;?>>
    <td align="center"><?php echo date('d/m/Y H:m',strtotime($emailData));?>h</td>
    <td align="center"><?php echo $emailNome;?></td>
    <td align="center"><?php echo $emailMail;?></td>
    <td align="center"><?php echo $emailFone;?></td>
    <td align="center"><a href="painel.php?exe=cliente-mail/entrada">Voltar</a></td>
  </tr>
  
  <tr <?php echo $cor;?>>
    <td align="center" style="color:#FFF; background:#666;">MENSAGEM:</td>
    <td colspan="4"><?php echo $emailMsg;?></td>
  </tr>
  <?php
	  }
  ?>
  
</table>
<form name="responder" action="" enctype="multipart/form-data" method="post">
<input type="hidden" name="sendTo" value="<?php echo $emailMail;?>" />
<input type="hidden" name="sendId" value="<?php echo $emailId;?>" />
<textarea name="sendMsg" cols="100" rows="8"></textarea>
<input type="submit" name="executar" id="executar" value="Responder" />

</form>

  </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>