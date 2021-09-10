<?php function up_homePosts(){
	
	include"Connections/config.php";
	
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal ORDER BY imovelId DESC LIMIT 4';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
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

         echo '<li>';
		 echo '<a href="index.php?pg=single&imovel='.$imovelID.'"><img src="timthumb.php?src=midias/'.$thumb.'&h=150&w=200&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a>';
		 echo '<h2><a href="index.php?pg=single&imovel='.$imovelID.'">'.$tipo.' a '.$negocio.'</a></h2>';
		 echo '<h3><a href="index.php?pg=single&imovel='.$imovelID.'">Valor R$'.$valor.'</a></h3>';
		 echo '<a href="index.php?pg=single&imovel='.$imovelID.'" class="veja_mais">Veja Mais</a>';
		 echo '</li>';

			
		}
	
}?>

<?php function up_homePostsListaDois(){
	
	include"Connections/config.php";
	
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal ORDER BY imovelId DESC LIMIT 4,2';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
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

         echo '<li>';
		 echo '<a href="index.php?pg=single&imovel='.$imovelID.'"><img src="timthumb.php?src=midias/'.$thumb.'&h=150&w=200&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a>';
		 echo '<h2><a href="index.php?pg=single&imovel='.$imovelID.'">'.$tipo.' a '.$negocio.'</a></h2>';
		 echo '<h3><a href="index.php?pg=single&imovel='.$imovelID.'">Valor R$'.$valor.'</a></h3>';
		 echo '<a href="index.php?pg=single&imovel='.$imovelID.'" class="veja_mais">Veja Mais</a>';
		 echo '</li>';

			
		}
	
}?>


<?php function up_footerPosts(){
	
	include"Connections/config.php";
	
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal ORDER BY RAND() LIMIT 5';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
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

         echo '<li>';
		 echo '<a href="index.php?pg=single&imovel='.$imovelID.'"><img src="timthumb.php?src=midias/'.$thumb.'&h=120&w=160&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a>';
		 echo '<h1><a href="index.php?pg=single&imovel='.$imovelID.'">'.$tipo.' a '.$negocio.'</a></h1>';
		 echo '<h2><a href="index.php?pg=single&imovel='.$imovelID.'">Valor R$'.$valor.'</a></h2>';
		 echo '<a href="index.php?pg=single&imovel='.$imovelID.'" class="veja_mais">Veja Mais</a>';
		 echo '</li>';

			
		}
	
}?>


<?php function get_categoria(){
	
	include"Connections/config.php";
	$operacao = $_GET['operacao'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelNegocio = :operacao ORDER BY imovelId DESC';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':operacao',$operacao,PDO::PARAM_STR);
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
			$dormitorios = $res['imovelComodos'];
			$data       = $res['imovelCadastro'];

           echo '<tr>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'"><img src="timthumb.php?src=midias/'.$thumb.'&h=60&w=100&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.$dormitorios.' Domitórios</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.date('d/m/Y',strtotime($data)).'</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'" class="veja_mais">Veja Mais</a></td>';
		   echo '</tr>';

			
		}
	
}?>


<?php function get_cliente(){
	
	include"Connections/config.php";
	$cliente = $_GET['cliente'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND clienteId = :clienteId ORDER BY imovelId DESC';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':clienteId',$cliente,PDO::PARAM_STR);
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
			$dormitorios = $res['imovelComodos'];
			$data       = $res['imovelCadastro'];

           echo '<tr>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'"><img src="timthumb.php?src=midias/'.$thumb.'&h=60&w=100&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.$dormitorios.' Domitórios</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.date('d/m/Y',strtotime($data)).'</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'" class="veja_mais">Veja Mais</a></td>';
		   echo '</tr>';

			
		}
	
}?>


<?php function get_search(){
	
	include"Connections/config.php";
	$posts = $_POST['p'];
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelTitulo LIKE :imovelTitulo ORDER BY imovelId DESC';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':imovelTitulo','%'.$posts.'%',PDO::PARAM_STR);
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
			$dormitorios = $res['imovelComodos'];
			$data       = $res['imovelCadastro'];

           echo '<tr>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'"><img src="timthumb.php?src=midias/'.$thumb.'&h=60&w=100&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.$negocio.'</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.$dormitorios.' Domitórios</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.date('d/m/Y',strtotime($data)).'</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'" class="veja_mais">Veja Mais</a></td>';
		   echo '</tr>';

			
		}
	
}?>

<?php function get_filtro(){
	
	include"Connections/config.php";
	
      $tipo = $_POST['tipo'];
      $categoria = $_POST['categoria'];
      $subCat = $_POST['sub-cat'];
      $bairro = $_POST['bairro'];
	  
	$dataVal = date('Y-m-d H:m:s');
	$sql = 'SELECT * FROM up_imoveis WHERE imovelTermino >= :dataVal AND imovelNegocio LIKE :tipo AND imovelTipo LIKE :categoria
	        AND ImovelBairro LIKE :subcat AND imovelComodos LIKE :bairro ORDER BY imovelId DESC';
	try{
		$query = $conecta->prepare($sql);
		$query->bindValue(':dataVal',$dataVal,PDO::PARAM_STR);
		$query->bindValue(':tipo','%'.$tipo.'%',PDO::PARAM_STR);
		$query->bindValue(':categoria','%'.$categoria.'%',PDO::PARAM_STR);
		$query->bindValue(':subcat','%'.$subCat.'%',PDO::PARAM_STR);
		$query->bindValue(':bairro','%'.$bairro.'%',PDO::PARAM_STR);
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
			$dormitorios = $res['imovelComodos'];
			$data       = $res['imovelCadastro'];

           echo '<tr>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'"><img src="timthumb.php?src=midias/'.$thumb.'&h=60&w=100&zc=1" alt="'.$titulo.'" title="'.$titulo.'" border="0" /></a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.$negocio.'</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.$dormitorios.' Domitórios</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'">'.date('d/m/Y',strtotime($data)).'</a></td>';
		   echo '<td align="center" bgcolor="#F0F0F0"><a href="index.php?pg=single&imovel='.$imovelID.'" class="veja_mais">Veja Mais</a></td>';
		   echo '</tr>';

			
		}
	
}?>