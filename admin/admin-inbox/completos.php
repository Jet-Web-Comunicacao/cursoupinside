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

<form name="s_emailAdmin" action="painel.php?exe=admin-inbox/search" enctype="multipart/form-data" method="post">
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
$emailStatus = 'completo';

$pag = "$_GET[pag]";
if($pag >= '1'){
 $pag = $pag;
}else{
 $pag = '1';
}

$maximo = '15'; //RESULTADOS POR PÁGINA
$inicio = ($pag * $maximo) - $maximo;

$sql_inboxAdmin = 'SELECT * FROM up_mailadmin WHERE emailStatus = :emailStatus ORDER BY emailData ASC LIMIT '.$inicio.','.$maximo;

try{
	$query_inboxAdmin = $conecta->prepare($sql_inboxAdmin);
	$query_inboxAdmin->bindValue(':emailStatus',$emailStatus,PDO::PARAM_STR);
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
    <td align="center"><a href="painel.php?exe=admin-inbox/ver&emailId=<?php echo $emailId;?>">Visualizar</a></td>
  </tr>
  
<?php
}
?> 
  
</table>

<?php
include"../Connections/painel_config.php";
//USE A MESMA SQL QUE QUE USOU PARA RECUPERAR OS RESULTADOS
//SE TIVER A PROPRIEDADE WHERE USE A MESMA TAMBÉM
$sql_res = mysql_query("SELECT * FROM up_mailadmin WHERE emailStatus = 'completo' ORDER BY emailData ASC");
$total = mysql_num_rows($sql_res);

$paginas = ceil($total/$maximo);
$links = '4'; //QUANTIDADE DE LINKS NO PAGINATOR

echo "<a href=\"painel.php?exe=admin-inbox/completos&amp;pag=1\">Primeira Página</a>&nbsp;&nbsp;&nbsp;";

for ($i = $pag-$links; $i <= $pag-1; $i++){
if ($i <= 0){
}else{
echo"<a href=\"painel.php?exe=admin-inbox/completos&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
}
}echo "$pag &nbsp;&nbsp;&nbsp;";

for($i = $pag +1; $i <= $pag+$links; $i++){
if($i > $paginas){
}else{
echo "<a href=\"painel.php?exe=admin-inbox/completos&amp;pag=$i\">$i</a>&nbsp;&nbsp;&nbsp;";
}
}
echo "<a href=\"painel.php?exe=admin-inbox/completos&amp;pag=$paginas\">Última página</a>&nbsp;&nbsp;&nbsp;";
?>



     </div><!--inbox-->

  </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>