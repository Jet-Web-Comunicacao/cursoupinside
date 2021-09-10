<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Suporte</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
<?php include_once("sistema/carregando.php");?>
 <table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr style="background:#333; font:bold 12px Arial, Helvetica, sans-serif; color:#FFF;">
    <td align="center">DATA:</td>
    <td align="center">CLIENTE:</td>
    <td align="center">STATUS:</td>
    <td align="center">RESPONDER:</td>
  </tr>
  
<?php
$pegaTicket = 'SELECT * FROM up_tickets ORDER BY ticketId DESC';
try{
	$queryPegaTicket = $conecta->prepare($pegaTicket);
	$queryPegaTicket->execute();
	
	$res_pegaTicket = $queryPegaTicket->fetchAll(PDO::FETCH_ASSOC);
	
	}catch(PDOexception $error_pegaTicket){
	   echo 'Erro ao selecionar os tickets'.$error_ticket->getMessage();	
	}
	
	   foreach($res_pegaTicket as $resTicket){
		$ticketId = $resTicket['ticketId'];
		$ticketCliente = $resTicket['clienteId'];
		$ticketData = $resTicket['ticketData'];
		$ticketPergunta = $resTicket['ticketPergunta'];
		$ticketResposta = $resTicket['ticketResposta'];
		
		if($ticketResposta == ''){
		   $ticketStatus = 'Aguardando Resposta';	
		}else{
		  $ticketStatus = 'Completo';
			}
	


$i++;
if($i % 2 == 0){
  $cor = 'style="background:#E6FFF2"';
}else{
  $cor = 'style="background:#f4f4f4;"';
}


?>  
  
  <tr <?php echo $cor;?>>
    <td align="center"><?php echo date('d/m/Y H:m',strtotime($ticketData));?></td>
    <td align="center"><?php echo $ticketCliente;?></td>
    <td align="center"><?php echo $ticketStatus;?></td>
    <td align="center"><a href="painel.php?exe=tickets/admin-resposta&ticket=<?php echo $ticketId;?>">Responder</a></td>
  </tr>
<?php
	}
?>

</table>

   
  </div><!--conteudo-->



</div><!--contet-->
     
<?php include_once("footer.php");?>