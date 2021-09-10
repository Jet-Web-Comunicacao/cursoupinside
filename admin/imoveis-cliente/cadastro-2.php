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
   
<?php
$imovelTitulo = strip_tags(trim($_POST['titulo']));
$imovelNegocio = strip_tags(trim($_POST['negocio']));
$imovelTipo = strip_tags(trim($_POST['tipo']));
$imovelValor = strip_tags(trim($_POST['valor']));
$imovelDescricao = strip_tags(trim($_POST['descricao']));
$imovelComods = strip_tags(trim($_POST['comodos']));
$imovelSuites = strip_tags(trim($_POST['suites']));
$imovelBanheiros = strip_tags(trim($_POST['banheiros']));
$imovelSalas = strip_tags(trim($_POST['salas']));
$imovelChurrasqueira = strip_tags(trim($_POST['churrasqueira']));
$imovelGaragem = strip_tags(trim($_POST['garagem']));
$imovelServico = strip_tags(trim($_POST['servico']));
$imovelPiscina = strip_tags(trim($_POST['piscina']));
$imovelFacilidades = strip_tags(trim($_POST['facilidades']));

$imovelVisitas = '1';
$imovelCadastro = date('Y-m-d H:m:s');
$imovelUpdate = date('Y-m-d H:m:s');
$datafinal = date('Y-m-d H:m:s',strtotime('+1 month'));
$imovelStatus = 'pendente';


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
	   
	   
	   $sql_cadastraImvel  = 'INSERT INTO up_imoveis (clienteId, imovelVisitas, imovelTitulo,imovelThumb, imovelTipo, imovelValor, imovelNegocio,
	                          imovelDescricao, imovelComodos, imovelSuites, imovelBanheiros, imovelSalas, imovelChurrasqueira, imovelGaragem,
							  imovelServico, imovelPiscina, imovelFacilidades, imovelCadastro, imovelUpdate, imovelTermino, imovelStatus) ';
	   $sql_cadastraImvel .= 'VALUES (:clienteId, :imovelVisitas, :imovelTitulo, :imovelThumb, :imovelTipo, :imovelValor, :imovelNegocio,
	                          :imovelDescricao, :imovelComodos, :imovelSuites, :imovelBanheiros, :imovelSalas, :imovelChurrasqueira, :imovelGaragem,
							  :imovelServico, :imovelPiscina, :imovelFacilidades, :imovelCadastro, :imovelUpdate, :imovelTermino, :imovelStatus)';
							  
	 try{
		 $query_cadastraImovel = $conecta->prepare($sql_cadastraImvel);
		 $query_cadastraImovel->bindValue(':clienteId',$clienteId,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelVisitas',$imovelVisitas,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelTitulo',$imovelTitulo,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelThumb',$nome,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelTipo',$imovelTipo,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelValor',$imovelValor,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelNegocio',$imovelNegocio,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelDescricao',$imovelDescricao,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelComodos',$imovelComods,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelSuites',$imovelSuites,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelBanheiros',$imovelBanheiros,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelSalas',$imovelSalas,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelChurrasqueira',$imovelChurrasqueira,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelGaragem',$imovelGaragem,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelServico',$imovelServico,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelPiscina',$imovelPiscina,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelFacilidades',$imovelFacilidades,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelCadastro',$imovelCadastro,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelUpdate',$imovelUpdate,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelTermino',$datafinal,PDO::PARAM_STR);
		 $query_cadastraImovel->bindValue(':imovelStatus',$imovelStatus,PDO::PARAM_STR);
		 $query_cadastraImovel->execute();
			
			echo '<h2>Imóvel Cadastrado, para melhor vendelo encha o resto dos formulários!</h2>'; 
		 
		 }catch(PDOexception $error_cadastraImovel){
			echo 'Erro ao cadastrar'.$error_cadastraImovel->getMessage(); 
		 }
		
	}else{
		echo '<h1>Volte o navegador e cadastre uma imagem perimitida para continuar seu cadastro!</h1>';
		die();
	}
	
	
}





?> 
   
   
<?php include_once("sistema/carregando.php");?>
<span style="font:16px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#069;">1: Informações | <strong>2: Endereços</strong> | 3: Imagens</span>
<?php
$imovelId = $conecta->lastInsertId();
?>
   
      <form name="cadastraImovelCliente-2" id="cadastraImovelCliente-2" action="painel.php?exe=imoveis-cliente/cadastro-3" method="post" enctype="multipart/form-data">

      <h2>Endereço</h2>

        <label>
          <span>Nome da Rua:</span>
          <input type="text" name="rua" size="50" />
        </label>
        
        <label>
          <span>Número:</span>
          <input type="text" name="numero" size="20" />
        </label>
        
        <label>
          <span>Bairro:</span>
          <input type="text" name="bairro" size="50" />
        </label>
        
        <label>
          <span>Próximo à:</span>
          <input type="text" name="proximo" size="50" />
        </label>
        
        <input type="hidden" name="imovelId" value="<?php echo $imovelId;?>" />
        
        <input type="submit" name="executar" id="executar" value="Próximo Passo" />

      </form>
   </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>