<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Visualizar E-mails</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
   
   

<?php include_once("sistema/carregando.php");?>
   
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr style="color:#FFF; background:#666;">
    <td align="center">DATA:</td>
    <td align="center">NOME:</td>
    <td align="center">E-MAIL:</td>
    <td align="center">TELEFONE:</td>
    <td align="center">RESPOSTA EM:</td>
    <td align="center">VOLTAR:</td>
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
    <td align="center"><?php echo date('d/m/Y',strtotime($emailRes));?></td>
    <td align="center"><a href="painel.php?exe=cliente-mail/completos">Voltar</a></td>

  </tr>
  
  <tr <?php echo $cor;?>>
    <td align="center" style="color:#FFF; background:#666;">MENSAGEM:</td>
    <td colspan="4"><?php echo $emailMsg;?></td>
  </tr>
  
  <tr <?php echo $cor;?>>
    <td align="center" style="color:#FFF; background:#666;">RESPOSTA:</td>
    <td colspan="4"><?php echo $emailResTxt;?></td>
  </tr>
  <?php
	  }
  ?>
  
</table>

  </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>