<h3>PARA IMPRIMIR PRECIONE CRTL+P NO SEU TECLADO</h3>

<?php
	
	include"../Connections/config.php";
	
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
			$titulo       = $res['imovelTitulo'];
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
			$rua       = $res['imovelRua'];
			$numero       = $res['imovelNumero'];
			$bairro    = $res['imovelBairro'];
			$proximo      = $res['imovelProximo'];
			
			

         echo '<li><strong>ID:</strong> '.$imovelID.'</li>';
		 echo '<li><strong>Titulo:</strong> '.$titulo.'</li>';
		 echo '<li><strong>Negocio:</strong> '.$negocio.'</li>';
		 echo '<li><strong>Valor:</strong> '.$valor.'</li>';
		 
		 echo '<li><strong>Rua:</strong> '.$rua.'</li>';
		 echo '<li><strong>Número:</strong> '.$numero.'</li>';
		 echo '<li><strong>Bairro:</strong> '.$bairro.'</li>';
		 echo '<li><strong>Próximo:</strong> '.$proximo.'</li>';
		 
		 echo '<li><strong>Comodos:</strong> '.$dormitorios.'</li>';
		 echo '<li><strong>Suites:</strong> '.$suites.'</li>';
		 echo '<li><strong>Banheiros:</strong> '.$banheiros.'</li>';
		 echo '<li><strong>Salas:</strong> '.$salas.'</li>';
		 echo '<li><strong>Churrasqueira:</strong> '.$churrasqueira.'</li>';
		 echo '<li><strong>Garagem:</strong> '.$garagem.'</li>';
		 echo '<li><strong>Área de serviço:</strong> '.$area.'</li>';
		 echo '<li><strong>Piscina:</strong> '.$piscina.'</li>';
		}
	
?>
   
   


     
