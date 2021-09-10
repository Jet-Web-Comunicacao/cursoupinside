<?php include_once("sistema/restrito_admin.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Ativos</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Terminar'){
$terId = $_POST['imovelId'];
$terData = date('Y-m-d H:i:s',strtotime('-1 day'));

$sql_termina = 'UPDATE up_imoveis SET imovelTermino = :imovelTermino WHERE imovelId = :imovelId';

try{
	$queryTermina = $conecta->prepare($sql_termina);
	$queryTermina->bindValue(':imovelTermino',$terData,PDO::PARAM_STR);
	$queryTermina->bindValue(':imovelId',$terId,PDO::PARAM_STR);
	$queryTermina->execute();
	
	echo 'Imovel foi terminado com sucesso!';
	
	}catch(PDOexception $error_termina){
		 echo 'Erro ao terminar anúncio'.$error_termina->getMessage();
		}	
	
}?>
   
   
   
<?php include_once("sistema/carregando.php");?>
   
    <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr style="background:#666; color:#FFF">
    <td align="center">Cliente ID:</td>
    <td align="center">Anúncio ID:</td>
    <td align="center">Data Início:</td>
    <td align="center">Data final:</td>
    <td align="center">Executar:</td>
    <td align="center">Executar:</td>
  </tr>
  
 <?php
 
 $imovelStatus = 'completo';
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
    <td align="center"><?php echo date('d/m/y',strtotime($anuncioInicio));?></td>
    <td align="center"><?php echo date('d/m/y',strtotime($anuncioFinal));?></td>
    <td align="center">
    <form name="terminar" action="" enctype="multipart/form-data" method="post">
    <input type="hidden" name="imovelId" value="<?php echo $anuncioId;?>" />
    <input type="submit" name="executar" id="executar" value="Terminar" />
    </form>    
    </td>
    <td align="center"><a href="painel.php?exe=admin-imoveis/edit&id=<?php echo $anuncioId;?>">Editar</a></td>
  </tr>
  
  <?php
	 }
  ?>
  
</table>
   </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>