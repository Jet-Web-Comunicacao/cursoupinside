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
    <td align="center">STATUS:</td>
    <td align="center">VER:</td>
  </tr>
  
<?php
$ticketId = $_GET['ticket'];
$pegaTicket = 'SELECT * FROM up_tickets WHERE clienteId = :clienteId AND ticketId = :ticketId';
try{
	$queryPegaTicket = $conecta->prepare($pegaTicket);
	$queryPegaTicket->bindValue(':clienteId',$clienteId,PDO::PARAM_STR);
	$queryPegaTicket->bindValue(':ticketId',$ticketId,PDO::PARAM_STR);
	$queryPegaTicket->execute();
	
	$res_pegaTicket = $queryPegaTicket->fetchAll(PDO::FETCH_ASSOC);
	
	}catch(PDOexception $error_pegaTicket){
	   echo 'Erro ao selecionar os tickets'.$error_ticket->getMessage();	
	}
	
	   foreach($res_pegaTicket as $resTicket){
		$ticketId = $resTicket['ticketId'];
		$ticketData = $resTicket['ticketData'];
		$ticketPergunta = $resTicket['ticketPergunta'];
		$ticketResposta = $resTicket['ticketResposta'];
		
		if($ticketResposta == ''){
		   $ticketStatus = 'Aguardando Resposta';	
		}else{
		  $ticketStatus = 'Completo';
			}
	


  $cor = 'style="background:#f4f4f4;"';

?>  
  
  <tr <?php echo $cor;?>>
    <td align="center"><?php echo date('d/m/Y H:m',strtotime($ticketData));?></td>
    <td align="center"><?php echo $ticketStatus;?></td>
    <td align="center"><a href="painel.php?exe=tickets/cliente_ver&ticket=<?php echo $ticketId;?>">Vizualizar</a></td>
  </tr>
  
  
    <tr <?php echo $cor;?>>
    <td align="center" style="background:#333; font:bold 12px Arial, Helvetica, sans-serif; color:#FFF;">Pergunta:</td>
    <td colspan="2"><?php echo $ticketPergunta;?></td>
  </tr>
  
  <tr <?php echo $cor;?>>
    <td align="center" style="background:#333; font:bold 12px Arial, Helvetica, sans-serif; color:#FFF;">Resposta:</td>
    <td colspan="2"><?php echo $ticketResposta;?></td>
  </tr>
  
<?php
	}
?>

</table>
<a href="painel.php?exe=tickets/cliente_cadastra">Voltar</a>

   
  </div><!--conteudo-->



</div><!--contet-->
     
<?php include_once("footer.php");?>