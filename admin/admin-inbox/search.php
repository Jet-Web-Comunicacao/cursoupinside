<?php include_once("sistema/restrito_admin.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Admin Inbox</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">

<?php include_once("sistema/carregando.php");?>

<form name="s_emailAdmin" action="" enctype="multipart/form-data" method="post">
    <label>
    <input type="text" name="s" size="50" />
    <input type="submit" name="executar" id="executar" value="Pesquisar pelo nome" />
    
    </label>
</form>
   
      <div class="inbox">

<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr style="background:#666; color:#FFF; font:12px Arial, Helvetica, sans-serif; font-weight:bold;">
    <td align="center">DATA:</td>
    <td align="center">NOME:</td>
    <td align="center">EMAIL:</td>
    <td align="center">EXECUTAR:</td>
  </tr>
<?php
$emailStatus = $_POST['s'];

$sql_inboxAdmin = 'SELECT * FROM up_mailadmin WHERE emailNome LIKE :emailStatus ORDER BY emailData ASC';

try{
	$query_inboxAdmin = $conecta->prepare($sql_inboxAdmin);
	$query_inboxAdmin->bindValue(':emailStatus','%'.$emailStatus.'%',PDO::PARAM_STR);
	$query_inboxAdmin->execute();
	
	$resultado_inboxAdmin = $query_inboxAdmin->fetchAll(PDO::FETCH_ASSOC);
	
	}catch(PDOexception $error_inboxAdmin){
	   echo 'Erro ao selecionar pendentes';
	}
	
	foreach($resultado_inboxAdmin as $res_inboxAdmin){
		$emailId        = $res_inboxAdmin['emailId'];
		$emailNome      = $res_inboxAdmin['emailNome'];
		$emailEmail     = $res_inboxAdmin['emailEmail'];
		$emailMensagem  = $res_inboxAdmin['emailMensagem'];
		$emailData      = $res_inboxAdmin['emailData'];
		$emailStatus    = $res_inboxAdmin['emailStatus'];
		$emailResposta  = $res_inboxAdmin['emailResposta'];
		$emailTxt       = $res_inboxAdmin['emailTxt'];
		$i++;
		if($i % 2 == 0){
			$cor = 'style="background:#E6FFF2"';
		}else{
			$cor = 'style="background:#f4f4f4;"';
		}

?>  
  
  <tr <?php echo $cor;?>>
    <td align="center"><?php echo date('d/m/Y H:i',strtotime($emailData));?>h</td>
    <td align="center"><?php echo $emailNome;?></td>
    <td align="center"><?php echo $emailEmail;?></td>
    <td align="center"><a href="painel.php?exe=admin-inbox/resposta&emailId=<?php echo $emailId;?>">Visualizar / Responder</a></td>
  </tr>
  
<?php
}
?> 
  
</table>


     </div><!--inbox-->

  </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>