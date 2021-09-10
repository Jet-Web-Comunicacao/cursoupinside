<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle & Cadastrar Imóvel</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
<?php include_once("sistema/carregando.php");?>
<span style="font:16px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#069;">1: Informações | 2: Endereços | <strong>3: Imagens</strong></span>
   
<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Próximo Passo'){
$imovelId         = $_POST['imovelId'];
$imovelRua        = strip_tags(trim($_POST['rua']));
$imovelNumero     = strip_tags(trim($_POST['numero']));
$imovelBairro     = strip_tags(trim($_POST['bairro']));
$imovelProximo    = strip_tags(trim($_POST['proximo']));

$sql_enderecoImovel = 'UPDATE up_imoveis SET imovelRua = :imovelRua, imovelNumero = :imovelNumero, 
                       imovelBairro = :imovelBairro, imovelProximo = :imovelProximo WHERE imovelId = :imovelId';
					   
	try{
		$query_enderecoImovel = $conecta->prepare($sql_enderecoImovel);
		$query_enderecoImovel->bindValue(':imovelRua',$imovelRua,PDO::PARAM_STR);
		$query_enderecoImovel->bindValue(':imovelNumero',$imovelNumero,PDO::PARAM_STR);
		$query_enderecoImovel->bindValue(':imovelBairro',$imovelBairro,PDO::PARAM_STR);
		$query_enderecoImovel->bindValue(':imovelProximo',$imovelProximo,PDO::PARAM_STR);
		$query_enderecoImovel->bindValue(':imovelId',$imovelId,PDO::PARAM_STR);
		$query_enderecoImovel->execute();
		
		}catch(PDOexception $error_updateImovel){
		 echo 'Erro ao atualizar imovel'.$error_updateImovel->getMessage();	
		}


}?> 


<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Enviar Imagem'){

$imovelId = $_POST['imovelId'];
$sql_limitaUpload = 'SELECT * FROM up_midias WHERE imovelId = :imovelId';
try{
	$query_limitaUpload = $conecta->prepare($sql_limitaUpload);
	$query_limitaUpload->bindValue(':imovelId',$imovelId,PDO::PARAM_STR);
	$query_limitaUpload->execute();
	
	$count_limitaUpload = $query_limitaUpload->rowCount(PDO::FETCH_ASSOC);
	
	}catch(PDOexception $error_limitaUpload){
	  echo 'Erro ao limitar upload'.$error_limitaUpload->getMessage();
	}
	
	if($count_limitaUpload >= '10'){
	  echo '<h1>Você já enviou 10 Imagens de 10 Imagens!';	
	}else{


$imovelThumb = $_FILES['img'];
$imovelPasta = '../midias/';
$imgPermitido = array('image/jpg','image/jpeg','image/pjpg');
$contarImg = count($imovelThumb['name']);
require("sistema/upload.php");

for($i=0;$i<$contarImg;$i++){
	$imagemNome = $imovelThumb['name'][$i];
	$imagemCaminho = $imovelThumb['tmp_name'][$i];
	$imagemTipo = $imovelThumb['type'][$i];
	
	if(!empty($imagemNome) && in_array($imagemTipo, $imgPermitido)){
	   $nome = 'cliente='.$clienteId.'-'.md5(uniqid(rand(), true)).'.jpg';
	   Redimensionar($imagemCaminho, $nome, 500, $imovelPasta);
	   
	   $sql_cadastraImagem  = 'INSERT INTO up_midias (imovelId, imovelImg) ';
	   $sql_cadastraImagem .= 'VALUES (:imovelId, :nome)';
	   
	   try{
		   $query_cadastraImagem = $conecta->prepare($sql_cadastraImagem);
		   $query_cadastraImagem->bindValue(':imovelId',$imovelId,PDO::PARAM_STR);
		   $query_cadastraImagem->bindValue(':nome',$nome,PDO::PARAM_STR);
		   $query_cadastraImagem->execute();
		   
		   echo '<div class="ok">Imagem cadastrada, envie outra!</div>';
		   
		   }catch(PDOexception $erroImagem){
			 echo 'Erro ao cadastrar imagem';   
		   }
	   
	   
	}else{
		echo '<div class="no">Imagem inválida</div>';
	}
}
	}
}?> 


<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Finalizar'){
sleep(1);
$meta = '<meta http-equiv="refresh" content="0, URL=painel.php?exe=imoveis-cliente/cadastro-fim" />';
echo $meta;	
}?>
  
      <form name="cadastraImovelCliente" action="" method="post" enctype="multipart/form-data">

   
      <h2>Você pode enviar até 10 imagens!</h2>
      <span>*clique em selecioar arquivo!<br />
      *selecione a imagem<br />
      *clique em enviar imagem<br /></span>
         <h2>Ao enviar Todas as imagens clique em finalizar!</h2>

        <label>
          <span>Imagems:</span>
          <input type="file" name="img[]" size="60" />
        </label>
        <input type="hidden" name="imovelId" value="<?php echo $imovelId;?>" />
        
        
        <input type="submit" name="executar" id="executar" value="Enviar Imagem" />
        <input type="submit" name="executar" id="executar" value="Finalizar" />
      
      
      </form>  
<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Excluir'){
$fotoId = $_POST['fotoId'];
$imovelImg = $_POST['imovelImg'];

$sql_deletaImg = 'DELETE FROM  up_midias WHERE fotoId = :fotoId';
try{
	$query_deletaImg = $conecta->prepare($sql_deletaImg);
	$query_deletaImg->bindValue(':fotoId',$fotoId,PDO::PARAM_STR);
	$query_deletaImg->execute();
	
	$pastaDel = '../midias';
	unlink($pastaDel.'/'.$imovelImg);
	echo '<div class="ok">Excluida</div>';
	
	}catch(PDOexception $error_delImg){
	  echo 'Erro ao excluir';
	}
}

?>            
<div class="galeria_all">
<?php
$sql_pegaImagem = 'SELECT * FROM up_midias WHERE imovelId = :imovelId';
try{
	$query_pegaImagem = $conecta->prepare($sql_pegaImagem);
	$query_pegaImagem->bindValue(':imovelId',$imovelId,PDO::PARAM_STR);
	$query_pegaImagem->execute();
	
	$resultado_pegaImagem = $query_pegaImagem->fetchAll(PDO::FETCH_ASSOC);
	
	}catch(PDOexception $error_pegaImagem){
	   echo 'Erro ao selecionar imagens';
	}
	
	foreach($resultado_pegaImagem as $resImagem){
		$fotoId = $resImagem['fotoId'];
		$imovelImg = $resImagem['imovelImg'];



?>
      <div class="galeria_cadastro">
      
      <span class="imagem"><img src="../midias/<?php echo $imovelImg;?>" width="100" alt="Exibição" /></span>
      <form name="execluirImagem" action="" enctype="multipart/form-data" method="post">
        <input type="hidden" name="imovelId" value="<?php echo $imovelId;?>" />
        <input type="hidden" name="fotoId" value="<?php echo $fotoId;?>" />
        <input type="hidden" name="imovelImg" value="<?php echo $imovelImg;?>" />
        <input type="submit" name="executar" id="executar" value="Excluir" />
      </form>
      
      
      </div><!--galeria cadastro-->
      
<?php
	}
?>
</div><!--fecha galeria all-->
      
   </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>