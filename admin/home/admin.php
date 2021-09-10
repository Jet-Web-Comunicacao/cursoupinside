<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
<?php
if($clienteNivel == 'cliente'){
    echo '<meta http-equiv="refresh" content="0, URL=deslogar.php" />';
}elseif($clienteNivel == 'admin'){
?>

   
<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Autenticar Anúncio'){
$autId       = $_POST['autId'];
$autoFim     = date('Y-m-d H:i:s',strtotime('+1 month'));
$autStatus   = 'completo';

$aut_imovel = 'UPDATE up_imoveis SET imovelStatus = :imovelStatus, imovelTermino = :imovelTermino
               WHERE imovelId = :imovelId';
			   
try{
	$queryAut = $conecta->prepare($aut_imovel);
	$queryAut->bindValue(':imovelStatus',$autStatus,PDO::PARAM_STR);
	$queryAut->bindValue(':imovelTermino',$autoFim,PDO::PARAM_STR);
	$queryAut->bindValue(':imovelId',$autId,PDO::PARAM_STR);
	$queryAut->execute();
	
	echo '<div class="ok">Autenticado com sucesso!</div>';
	
	}catch(PDOexception $error_aut){
	  echo 'Erro ao autenticar '.$error_aut->getMessage();	
	}
}

?>    
   
<h1>Imóveis com pagamento informado!</h1>



 <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr style="background:#666; color:#FFF">
    <td align="center">Cliente ID:</td>
    <td align="center">Anúncio ID:</td>
    <td align="center">Autenticação:</td>
    <td align="center">Executar:</td>
  </tr>
  
 <?php
 
 $imovelStatus = 'aguardando';
 $data = date('Y-m-d H:m:s');
 $sql_pegaAtivos = 'SELECT * FROM up_imoveis WHERE imovelStatus = :imovelStatus AND imovelTermino >= :data
					ORDER BY imovelTermino ASC';
					
 try{
	 $query_pegaAtivos = $conecta->prepare($sql_pegaAtivos);
	 $query_pegaAtivos->bindValue(':imovelStatus',$imovelStatus,PDO::PARAM_STR);
	 $query_pegaAtivos->bindValue(':data',$data,PDO::PARAM_STR);
	 $query_pegaAtivos->execute();
	 
	 $resultado_pegaAtivos = $query_pegaAtivos->fetchAll(PDO::FETCH_ASSOC);
	 $count_pegaAtivos = $query_pegaAtivos->rowCount(PDO::FETCH_ASSOC);
	 
	 }catch(PDOexception $error_pegaAtivos){
        echo 'Erro ao pegar ativos';
	 }
	 
	 foreach($resultado_pegaAtivos as $resAtivos){
		 $anuncioCliente = $resAtivos['clienteId'];
		 $anuncioId = $resAtivos['imovelId'];
		 $anuncioTitulo = $resAtivos['imovelTitulo'];
		 $anuncioInicio = $resAtivos['imovelCadastro'];
		 $anuncioFinal = $resAtivos['imovelTermino'];
		 $anuncioVisitas = $resAtivos['imovelVisitas'];
		 $anuncioConfirma = $resAtivos['imovelConfirma'];
		 $i++;
		if($i % 2 == 0){
			$cor = 'style="background:#E6FFF2"';
		}else{
			$cor = 'style="background:#f4f4f4;"';
		}
		
		$dataHoje = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$dataFim = mktime(0,0,0,date('m',strtotime($anuncioFinal)),date('d',strtotime($anuncioFinal)),                   date('Y',strtotime($anuncioFinal)));
		$executaData = $dataFim - $dataHoje;
		$faltamDias = floor($executaData/(60*60*24));
		 
		 
	 
 
 ?> 

  <tr <?php echo $cor;?>>
    <td align="center"><?php echo $anuncioId ;?></td>
    <td align="center"><?php echo $anuncioTitulo;?></td>
    <td align="center"><?php echo $anuncioConfirma;?></td>
    <td align="center">
    <form name="autenticar" action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="autId" value="<?php echo $anuncioId;?>" />
      <input type="submit" name="executar" id="executar" value="Autenticar Anúncio" />
    
    </form>
     
    </td>
  </tr>
  
  <?php
	 }
  ?>
  
</table>
<?php if($count_pegaAtivos == '0'){
	echo '<h2>Sem anúncios no momento</h2>';
}else{}?>


<h1>Anúncios aguardando Pagamento:</h1>
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr style="background:#666; color:#FFF">
    <td align="center">Cliente ID:</td>
    <td align="center">Anúncio ID:</td>
    <td align="center">Titulo:</td>
    <td align="center">Cadastro em:</td>
  </tr>
 <?php
 
 $imovelStatus = 'processando';
 $data = date('Y-m-d H:m:s');
 $sql_pegaAtivos = 'SELECT * FROM up_imoveis WHERE imovelStatus = :imovelStatus AND imovelTermino >= :data
					ORDER BY imovelTermino ASC';
					
 try{
	 $query_pegaAtivos = $conecta->prepare($sql_pegaAtivos);
	 $query_pegaAtivos->bindValue(':imovelStatus',$imovelStatus,PDO::PARAM_STR);
	 $query_pegaAtivos->bindValue(':data',$data,PDO::PARAM_STR);
	 $query_pegaAtivos->execute();
	 
	 $resultado_pegaAtivos = $query_pegaAtivos->fetchAll(PDO::FETCH_ASSOC);
	 
	 }catch(PDOexception $error_pegaAtivos){
        echo 'Erro ao pegar ativos';
	 }
	 
	 foreach($resultado_pegaAtivos as $resAtivos){
		 $anuncioCliente = $resAtivos['clienteId'];
		 $anuncioId = $resAtivos['imovelId'];
		 $anuncioTitulo = $resAtivos['imovelTitulo'];
		 $anuncioInicio = $resAtivos['imovelCadastro'];
		 $anuncioFinal = $resAtivos['imovelTermino'];
		 $anuncioVisitas = $resAtivos['imovelVisitas'];
		 $i++;
		if($i % 2 == 0){
			$cor = 'style="background:#E6FFF2"';
		}else{
			$cor = 'style="background:#f4f4f4;"';
		}
		
		$dataHoje = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$dataFim = mktime(0,0,0,date('m',strtotime($anuncioFinal)),date('d',strtotime($anuncioFinal)),                   date('Y',strtotime($anuncioFinal)));
		$executaData = $dataFim - $dataHoje;
		$faltamDias = floor($executaData/(60*60*24));
		 
		 
	 
 
 ?> 
  
  <tr <?php echo $cor;?>>
    <td align="center"><?php echo $anuncioCliente ;?></td>
    <td align="center"><?php echo $anuncioId ;?></td>
    <td align="center"><?php echo $anuncioTitulo;?></td>
    <td align="center"><?php echo date('d/m/y',strtotime($anuncioInicio));?></td>
  </tr>
  
  <?php
	 }
  ?>
  
</table>






<?php
}
?>
   </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>