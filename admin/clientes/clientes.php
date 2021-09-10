<?php include_once("sistema/restrito_admin.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Clientes</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
<?php include_once("sistema/carregando.php");?>


<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr style="background:#333; color:#FFF; font:12px Arial, Helvetica, sans-serif; font-weight:bold;">
    <td align="center">Cliente Id</td>
    <td align="center">Cliente Nome:</td>
    <td align="center">Cliente E-mail</td>
    <td align="center">Editar Cliente</td>
  </tr>
<?php
    $nivelCliente = 'cliente';
    $sql_pegaCliente = 'SELECT * FROM up_clientes WHERE usuarioNivel = :usuarioNivel';
	
	try{
		$query_pegaClientes = $conecta->prepare($sql_pegaCliente);
		$query_pegaClientes->bindValue(':usuarioNivel',$nivelCliente,PDO::PARAM_STR);
		$query_pegaClientes->execute();
		
		$res_queryPegaCliente = $query_pegaClientes->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexcetpion $error_clientes){
		  echo 'Erro ao seleciona os clientes!';	
		}
		
		foreach($res_queryPegaCliente as $resCliente){
			$clienteId    = $resCliente['clienteId'];
			$clienteNome  = $resCliente['nome'];
			$clienteemail = $resCliente['email'];
            $i++;
		if($i % 2 == 0){
			$cor = 'style="background:#E6FFF2"';
		}else{
			$cor = 'style="background:#f4f4f4;"';
		}

?>  
  
  
  <tr <?php echo $cor;?>>
    <td align="center"><?php echo $clienteId;?></td>
    <td align="center"><?php echo $clienteNome;?></td>
    <td align="center"><?php echo $clienteemail;?></td>
    <td align="center"><a href="painel.php?exe=clientes/editar&clienteid=<?php echo $clienteId;?>">Editar cliente</a></td>
  </tr>
  

<?php
		}
?>
  
</table>

   
  </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>