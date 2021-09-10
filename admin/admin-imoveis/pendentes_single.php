<?php include_once("sistema/restrito_admin.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
   
<?php include_once("sistema/carregando.php");?>

<?php if(isset($_POST['executar']) && $_POST['executar'] == 'Aprovar Anúncio'){
$editTitulo = $_POST['editTitulo'];


$editNegocio = $_POST['editNegocio'];
if($editNegocio == ''){
	$editNegocio = $_POST['editNegocioOk'];
}else{
	$editNegocio = $_POST['editNegocio'];
}
$editTipo = $_POST['editTipo'];
if($editTipo == ''){
	$editTipo = $_POST['editTipoOk'];
}else{
	$editTipo = $_POST['editTipo'];
}
$editValor = $_POST['editValor'];
$editDesc = $_POST['editDesc'];
$editComodos = $_POST['editComodos'];
$editSuites = $_POST['editSuites'];
$editBanheiros = $_POST['editBanheiros'];
$editSalas = $_POST['editSalas'];
$editChurrasqueira = $_POST['editChurrasqueira'];
$editGaragem = $_POST['editGaragem'];
$editServico = $_POST['editServico'];
$editPiscina = $_POST['editPiscina'];
$editFacilidades = $_POST['editFacilidades'];
$editRua = $_POST['editRua'];
$editNumero = $_POST['editNumero'];
$editBairro = $_POST['editBairro'];
$editProximo = $_POST['editProximo'];

$editImovelId = $_POST['editId'];

$editImovelStatus = 'processando';

$edit_imoveis = 'UPDATE up_imoveis SET imovelTitulo = :imovelTitulo, imovelNegocio = :imovelNegocio, imovelTipo = :imovelTipo, 
                 imovelValor = :imovelValor, imovelDescricao = :imovelDescricao, imovelComodos = :imovelComodos, imovelSuites = :imovelSuites,
				 imovelBanheiros = :imovelBanheiros, imovelSalas = :imovelSalas, imovelChurrasqueira = :imovelChurrasqueira,
				 imovelGaragem = :imovelGaragem, imovelServico = :imovelServico, imovelPiscina = :imovelPiscina, imovelFacilidades = :imovelFacilidades,
				 imovelRua = :imovelRua, imovelNumero = :imovelNumero, imovelBairro = :imovelBairro, imovelProximo = :imovelProximo,
				 imovelStatus = :imovelStatus WHERE imovelId = :imovelId';
				 
try{
	$query_imovel = $conecta->prepare($edit_imoveis);
	$query_imovel->bindValue(':imovelTitulo',$editTitulo,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelNegocio',$editNegocio,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelTipo',$editTipo,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelValor',$editValor,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelDescricao',$editDesc,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelComodos',$editComodos,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelSuites',$editSuites,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelBanheiros',$editBanheiros,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelSalas',$editSalas,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelChurrasqueira',$editChurrasqueira,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelGaragem',$editGaragem,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelServico',$editServico,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelPiscina',$editPiscina,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelFacilidades',$editFacilidades,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelRua',$editRua,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelNumero',$editNumero,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelBairro',$editBairro,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelProximo',$editProximo,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelStatus',$editImovelStatus,PDO::PARAM_STR);
	$query_imovel->bindValue(':imovelId',$editId,PDO::PARAM_STR);
	$query_imovel->execute();
	
	echo '<div class="ok">Imóvel Liberado</div>';
	
	
	}catch(PDOexception $error_editImovel){
		echo 'Erro ao aprovar o imóvel '.$error_editImovel->getMessage();
		}

}
?> 




<?php
 $data = date('Y-m-d H:m:s');
 $imovelStatus = 'pendente';
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
		 $editCliente     = $resAtivos['clienteId'];
		 $editId          = $resAtivos['imovelId'];
		 $editTitulo      = $resAtivos['imovelTitulo'];
		 $editInicio      = $resAtivos['imovelCadastro'];
		 $editFinal       = $resAtivos['imovelTermino'];
		 $editVisitas     = $resAtivos['imovelVisitas'];
		 $editNegocio     = $resAtivos['imovelNegocio'];
		 $editTipo        = $resAtivos['imovelTipo'];
		 $editThumb       = $resAtivos['imovelThumb'];
		 
		 $editValor        = $resAtivos['imovelValor'];
		 $editDesc        = $resAtivos['imovelDescricao'];
		 $editComodos        = $resAtivos['imovelComodos'];
		 
		 $editSuites           = $resAtivos['imovelSuites'];
		 $editBanheiros        = $resAtivos['imovelBanheiros'];
		 $editSalas            = $resAtivos['imovelSalas'];
		 
		 $editChurrasqueira      = $resAtivos['imovelChurrasqueira'];
		 $editGaragem            = $resAtivos['imovelGaragem'];
		 $editServico            = $resAtivos['imovelServico'];
		 $editPiscina            = $resAtivos['imovelPiscina'];
		 
		 
		 $editRua               = $resAtivos['imovelRua'];
		 $editNumero            = $resAtivos['imovelNumero'];
		 $editBairro            = $resAtivos['imovelBairro'];
		 $editProximo           = $resAtivos['imovelProximo'];
		 $editFacilidades       = $resAtivos['imovelFacilidades'];
		
		$dataHoje = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$dataFim = mktime(0,0,0,date('m',strtotime($anuncioFinal)),date('d',strtotime($anuncioFinal)),                   date('Y',strtotime($anuncioFinal)));
		$executaData = $dataFim - $dataHoje;
		$faltamDias = floor($executaData/(60*60*24));
		 
		 
	 }
 
 ?> 
 
<h3 class="titulo">Id do Imóvel: <strong><?php echo $editId;?></strong> | id do cliente: <strong><?php echo $editCliente;?></strong> | Cadastro em: <strong><?php echo date('d/m/Y H:m',strtotime($editInicio));?>h</strong></h3>
<span class="exibir"><img src="../midias/<?php echo $editThumb;?>" alt="" width="100"/></span> 

    <form name="anuncios_aprovar" action="" enctype="multipart/form-data" method="post">
      
      <label>
        <span>Titulo do anúncio:</span>
        <input type="text" name="editTitulo" value="<?php echo $editTitulo;?>" size="128" />
      </label>
      
      <label>
        <span>Negocio: <strong><?php echo $editNegocio;?></strong></span>
      </label>
          <input type="radio" name="editNegocio" value="alugar" /> Alugar
          <input type="radio" name="editNegocio" value="vender" /> Vender
          <input type="hidden" name="editNegocioOk" value="<?php echo $editNegocio;?>" />
      
      <label>
        <span>Tipo: <strong><?php echo $editTipo;?></strong></span>
      </label>
          <input type="radio" name="editTipo" value="Casa" /> Casa &nbsp;
          <input type="radio" name="editTipo" value="Apartamento" /> Apartamento &nbsp;
          <input type="radio" name="editTipo" value="Duplex" /> Duplex &nbsp;
          <input type="radio" name="editTipo" value="Condomínio" /> Condomínio &nbsp;
          <input type="radio" name="editTipo" value="sala" /> Sala Comercial &nbsp;
          <input type="radio" name="editTipo" value="pavilhão" /> Pavilhão &nbsp;
          <input type="hidden" name="editTipoOk" value="<?php echo $editTipo;?>" />
           
         
      <label>
        <span>Valor:</span>
        <input type="text" name="editValor" value="<?php echo $editValor;?>" />
      </label>
      
      <label>
        <span>Descrição:</span>
        <textarea name="editDesc" cols="125" rows="5"><?php echo $editDesc;?></textarea>
      </label>

<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>
    <label>
        <span>Comodos:</span>
        <input type="text" name="editComodos" value="<?php echo $editComodos;?>" />
      </label>
    </td>
    <td>
    <label>
        <span>Suites:</span>
        <input type="text" name="editSuites" value="<?php
		
         if($editSuites == ''){
			 $editSuites = 'Não Possui';
		 }else{
			 $editSuites = $editSuites;
		 } echo $editSuites;
		 
		  ;?>" />
      </label>
    </td>
    <td>
    <label>
        <span>Banheiros:</span>
        <input type="text" name="editBanheiros" value="<?php echo $editBanheiros ;?>" />
      </label>
    </td>
    
    <td>
    <label>
        <span>Salas:</span>
        <input type="text" name="editSalas" value="<?php
		
         if($editSalas == ''){
			 $editSalas = 'Não Possui';
		 }else{
			 $editSalas = $editSalas;
		 } echo $editSalas;
		 
		  ;?>" />
      </label>
    </td>
  </tr>
</table>

     
 <table width="100%" border="0" cellspacing="2" cellpadding="0">
   <tr>
    <td>
    <label>
        <span>Churrascaria:</span>
        <input type="text" name="editChurrasqueira" value="<?php
		
         if($editChurrasqueira == ''){
			 $editChurrasqueira = 'Não Possui';
		 }else{
			 $editChurrasqueira = $editChurrasqueira;
		 } echo $editChurrasqueira;
		 
		  ;?>" />
      </label>
    </td>
    <td>
    <label>
    
        <span>Garagem:</span>
        <input type="text" name="editGaragem" value="<?php
		
         if($editGaragem == ''){
			 $editGaragem = 'Não Possui';
		 }else{
			 $editGaragem = $editGaragem;
		 } echo $editGaragem;
		 
		  ;?>" />
      </label>
    </td>
    <td>
    <label>
        <span>Area de Serviço:</span>
        <input type="text" name="editServico" value="<?php
		
         if($editServico == ''){
			 $editServico = 'Não Possui';
		 }else{
			 $editServico = $editServico;
		 } echo $editServico;
		 
		  ;?>" />
      </label>
    </td>
    <td>
    <label>
        <span>Piscina:</span>
        <input type="text" name="editPiscina" value="<?php
		
         if($editPiscina == ''){
			 $editPiscina = 'Não Possui';
		 }else{
			 $editPiscina = $editPiscina;
		 } echo $editPiscina;
		 
		  ;?>" />
          
          
    </label>
    </td>
  </tr>
</table>

      <label>
        <span>Facilidades:</span>
        <input type="text" name="editFacilidades" value="<?php echo $editFacilidades;?>" size="128" />
      </label>
      
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>
    <label>
        <span>Rua:</span>
        <input type="text" name="editRua" value="<?php echo $editRua;?>" size="62" />
      </label>
    </td>
    <td>
    <label>
        <span>Número:</span>
        <input type="text" name="editNumero" value="<?php echo $editNumero;?>" size="62" />
      </label>
    </td>
  </tr>
  <tr>
    <td>
    <label>
        <span>Bairro:</span>
        <input type="text" name="editBairro" value="<?php echo $editBairro;?>" size="62" />
      </label>
    </td>
    <td>
    <label>
        <span>Próximo:</span>
        <input type="text" name="editProximo" value="<?php echo $editProximo;?>" size="62" />
      </label>
    
    </td>
  </tr>
</table>
<input type="hidden" name="editId" value="<?php echo $editId;?>" />
<input type="submit" name="executar" id="executar" value="Aprovar Anúncio" />


    </form>
   <h1>Imagens do anúncio!</h1> 
   
   
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
	$query_pegaImagem->bindValue(':imovelId',$editId,PDO::PARAM_STR);
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
        <input type="hidden" name="imovelId" value="<?php echo $editId;?>" />
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