<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Imóveis Ativos</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
<?php include_once("sistema/carregando.php");?>

<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Renovar'){
	
$imovelId = $_POST['imovelId'];
$imovelStatus = 'pendente';
$dataInicio = date('Y-m-d H:m:s');	
$dataFinal = date('Y-m-d H:m:s',strtotime('+ 1 month'));
	
	$sql_renovar = 'UPDATE up_imoveis SET imovelStatus = :imovelStatus, imovelCadastro = :imovelCadastro,
	                imovelTermino = :imovelTermino WHERE imovelId = :imovelId';
	try{
		$query_renovar = $conecta->prepare($sql_renovar);
		$query_renovar->bindValue(':imovelStatus',$imovelStatus,PDO::PARAM_STR);
		$query_renovar->bindValue(':imovelId',$imovelId,PDO::PARAM_STR);
		$query_renovar->bindValue(':imovelCadastro',$dataInicio,PDO::PARAM_STR);
		$query_renovar->bindValue(':imovelTermino',$dataFinal,PDO::PARAM_STR);
		$query_renovar->execute();
		
		echo '<div class="ok">Seu imóvel foi enviado para avaliação e pode ser visualizado em imóveis pendentes! assim que liberado você devera confirmar o pagamento!</div>';
		
		}catch(PDOexception $error_renovar){
		  echo 'Erro ao renovar anúncio';
		}
	
	
}?>


   
     <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr style="background:#666; color:#FFF">
    <td align="center">Anúncio ID:</td>
    <td align="center">Titulo:</td>
    <td align="center">Data Início:</td>
    <td align="center">Data final:</td>
    <td align="center">Visitas:</td>
    <td align="center">Renovar anúncio:</td>
  </tr>
  
 <?php
 
 $data = date('Y-m-d H:m:s');
 $sql_pegaAtivos = 'SELECT * FROM up_imoveis WHERE clienteId = :clienteId 
                    AND imovelTermino <= :data ORDER BY imovelTermino ASC';
					
 try{
	 $query_pegaAtivos = $conecta->prepare($sql_pegaAtivos);
	 $query_pegaAtivos->bindValue(':clienteId',$clienteId,PDO::PARAM_STR);
	 $query_pegaAtivos->bindValue(':data',$data,PDO::PARAM_STR);
	 $query_pegaAtivos->execute();
	 
	 $resultado_pegaAtivos = $query_pegaAtivos->fetchAll(PDO::FETCH_ASSOC);
	 
	 }catch(PDOexception $error_pegaAtivos){
        echo 'Erro ao pegar ativos';
	 }
	 
	 foreach($resultado_pegaAtivos as $resAtivos){
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
    <td align="center"><?php echo $anuncioId ;?></td>
    <td align="center"><?php echo $anuncioTitulo;?></td>
    <td align="center"><?php echo date('d/m/y',strtotime($anuncioInicio));?></td>
    <td align="center"><?php echo date('d/m/y',strtotime($anuncioFinal));?></td>
    <td align="center"><?php echo $anuncioVisitas;?></td>
    <td align="center">
    <form name="renovar" action="" enctype="multipart/form-data" method="post">
       <input type="hidden" name="imovelId" value="<?php echo $anuncioId;?>" />
       <input type="submit" name="executar"  id="executar" value="Renovar" />
    </form>
    
    </td>
  </tr>
  
  <?php
	 }
  ?>
  
</table>
 
  </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>