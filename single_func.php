<?php function get_clienteDados(){
	
	include"Connections/config.php";
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelID   = $res['imovelId'];
			$imovelCliente = $res['clienteId'];
			$imovelVisitas = $res['imovelVisitas'];
			
$imovelSomaVisitas = $imovelVisitas + 1;		
$sqlVisitas = 'UPDATE up_imoveis SET imovelVisitas = :imovelVisitas WHERE imovelId = :imovelId';
try{
	$queryVisitas = $conecta->prepare($sqlVisitas);
	$queryVisitas->bindValue(':imovelVisitas',$imovelSomaVisitas,PDO::PARAM_STR);
	$queryVisitas->bindValue(':imovelId',$idImovel,PDO::PARAM_STR);
	$queryVisitas->execute();
	
	}catch(PDOexception $errorVistas){
	  echo 'Erro ao somar visitas'.$errorVistas->getMessage();
	}
			
			
			$pegaCliente = 'SELECT * FROM up_clientes WHERE clienteId = :clienteId';
			try{
				$queryPegaCliente = $conecta->prepare($pegaCliente);
				$queryPegaCliente->bindValue(':clienteId',$imovelCliente,PDO::PARAM_STR);
				$queryPegaCliente->execute();
				
				$resPegaCliente = $queryPegaCliente->fetchAll(PDO::FETCH_ASSOC);
				
				}catch(PDOexception $clienteError){
				   echo 'Erro ao selecionar o cliente';	
				}
				
				foreach($resPegaCliente as $resCliente){
					$clienteNome = $resCliente['nome'];
					$clienteTelefone = $resCliente['telefone'];
					
                echo '<li><img src="images/fone.png" alt="'.$clienteNome.'" /> '.$clienteNome.' | '.$clienteTelefone.'</li>';
				echo '<li><img src="images/outros_anuncios.png" alt="'.$clienteNome.'" /><a href="index.php?pg=cliente&cliente='.$imovelCliente.'">Mais anúncios dele</a></li>';	
				}
			
			

		}
	
}?>

<?php function get_postsVisitas(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelID   = $res['imovelId'];
			$tipo       = $res['imovelTipo'];
			$negocio    = $res['imovelNegocio'];
			$valor      = $res['imovelValor'];
			$thumb      = $res['imovelThumb'];
			$titulo     = $res['imovelTitulo'];
			$visitas     = $res['imovelVisitas'];

         echo '<li><img src="images/visitas.png" alt="Visitas neste imóvel" />Visitado '.$visitas.' vezes</li>';

			
		}
	
}?>

<?php function get_postsTitulo(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$titulo   = $res['imovelTitulo'];


         echo $titulo;

			
		}
	
}?>

<?php function get_imovelId(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelId   = $res['imovelId'];
        echo $imovelId;

			
		}
	
}?>

<?php function get_postThumb(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelID   = $res['imovelId'];
			$tipo       = $res['imovelTipo'];
			$negocio    = $res['imovelNegocio'];
			$valor      = $res['imovelValor'];
			$thumb      = $res['imovelThumb'];
			$titulo     = $res['imovelTitulo'];

         echo '<a href="midias/'.$thumb.'" rel="shadowbox"><img src="timthumb.php?src=midias/'.$thumb.'&h=300&w=400&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a>';

			
		}
	
}?>

<?php function get_postGallery(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$sql = 'SELECT * FROM up_midias WHERE imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelFoto  = $res['imovelImg'];

echo '<li><a href="midias/'.$imovelFoto.'" title="UpImoves - Foto do imóvel" rel="shadowbox[1]"><img src="timthumb.php?src=midias/'.$imovelFoto.'&h=49&w=65&zc=1" alt="" title="UpImóveis | Anúncie seu imóvel" /></a>';

			
		}
	
}?>


<?php function get_postDetalhes(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelID   = $res['imovelId'];
			$tipo       = $res['imovelTipo'];
			$negocio    = $res['imovelNegocio'];
			$valor      = $res['imovelValor'];
			$thumb      = $res['imovelThumb'];
			$titulo     = $res['imovelTitulo'];

         echo '<strong>Tipo:</strong> '.$tipo.' <strong>| Valor:</strong> R$'.$valor.' <strong>| Negocio:</strong> '.$negocio.'';

			
		}
	
}?>


<?php function get_postDesc(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelID   = $res['imovelId'];
			$tipo       = $res['imovelTipo'];
			$negocio    = $res['imovelNegocio'];
			$valor      = $res['imovelValor'];
			$thumb      = $res['imovelThumb'];
			$titulo     = $res['imovelTitulo'];
			$descricao  = $res['imovelDescricao'];

         echo $descricao;

			
		}
	
}?>

<?php function get_postItens(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelID   = $res['imovelId'];
			$tipo       = $res['imovelTipo'];
			$negocio    = $res['imovelNegocio'];
			$valor      = $res['imovelValor'];
			$thumb      = $res['imovelThumb'];
			$titulo     = $res['imovelTitulo'];
			$descricao  = $res['imovelDescricao'];
			$dormitorios = $res['imovelComodos'];
			$suites = $res['imovelSuites'];
			$banheiros = $res['imovelBanheiros'];
			$salas = $res['imovelSalas'];
			$churrasqueira = $res['imovelChurrasqueira'];
			$garagem = $res['imovelGaragem'];
			$area = $res['imovelServico'];
			$piscina = $res['imovelPiscina'];
			
			

         echo '<li>Comodos: '.$dormitorios.'</li>';
		 echo '<li>Suites: '.$suites.'</li>';
		 echo '<li>Banheiros: '.$banheiros.'</li>';
		 echo '<li>Salas: '.$salas.'</li>';
		 echo '<li>Churrasqueira: '.$churrasqueira.'</li>';
		 echo '<li>Garagem: '.$garagem.'</li>';
		 echo '<li>Área de serviço: '.$area.'</li>';
		 echo '<li>Piscina: '.$piscina.'</li>';
		}
	
}?>


<?php function get_postFacil(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$imovelID   = $res['imovelId'];
			$tipo       = $res['imovelTipo'];
			$negocio    = $res['imovelNegocio'];
			$valor      = $res['imovelValor'];
			$thumb      = $res['imovelThumb'];
			$titulo     = $res['imovelTitulo'];
			$facilidades  = $res['imovelFacilidades'];

         echo $facilidades;

			
		}
	
}?>


<?php function get_postEnd(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$rua       = $res['imovelRua'];
			$numero       = $res['imovelNumero'];
			$bairro    = $res['imovelBairro'];
			$proximo      = $res['imovelProximo'];

         echo '<strong>Nome da rua:</strong> '.$rua.' <strong>N°:</strong> '.$numero.'<br />';
		 echo '<strong>Bairro:</strong> '.$bairro.'<br />';
		 echo '<strong>Próximo:</strong> '.$proximo.'';
			
		}
	
}?>

<?php function get_ClienteId(){
	
	include"Connections/config.php";
	
	$idImovel = $_GET['imovel'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelId = :idImovel';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':idImovel',$idImovel,PDO::PARAM_STR);
		$query->execute();
		
		$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $error_imovels){
		  echo 'Erro ao selecionar os imoves!'; 	
		}
		
		foreach($resultado as $res){
			$idDoCliente       = $res['clienteId'];
             echo $idDoCliente;
		}
	
}?>
     
     
     

