<?php include_once("sistema/restrito_admin.php");?>
<?php include_once("sistema/validar_user.php");?>
<?php include_once("header.php");?>
<div id="local">
   <div class="caminho">Onde Estou: UpImóveis &raquo; Painel de Controle &raquo; Editar cliente</div><!--caminho-->
   <div class="welcome">Olá <?php echo $clienteNome;?>| Hoje <?php echo date('d/m/Y H:i').'h';?> | <a href="deslogar.php">Deslogar</a></div><!--welcome-->
</div><!--local-->
   
<div id="content">

<?php include_once("menu.php");?>     

   <div id="content_conteudo">
   
<?php include_once("sistema/carregando.php");?>
 
<?php if(isset($_POST['executar'])){
$clienteEditaId = $_POST['editaCliente'];
$sendFone = strip_tags(trim($_POST['sendFone']));
$sendNome = strip_tags(trim($_POST['sendNome']));

$sendSenha = strip_tags(trim($_POST['sendSenha']));
if($sendSenha == ''){
	$sendSenha = $clienteSenha;
}else{
	$sendSenha = strip_tags(trim(md5($_POST['sendSenha'])));
}


$sql_atualizaPefil = 'UPDATE up_clientes SET nome = :clienteNome, senha = :clienteSenha, telefone =                      :clienteTelefone WHERE clienteId = :clienteId';
					  
	try{
		$query_atualizaPerfil = $conecta->prepare($sql_atualizaPefil);
		$query_atualizaPerfil->bindValue(':clienteNome',$sendNome,PDO::PARAM_STR);
		$query_atualizaPerfil->bindValue(':clienteSenha',$sendSenha,PDO::PARAM_STR);
		$query_atualizaPerfil->bindValue(':clienteTelefone',$sendFone,PDO::PARAM_STR);
		$query_atualizaPerfil->bindValue(':clienteId',$clienteEditaId,PDO::PARAM_STR);
		$query_atualizaPerfil->execute();
		
		echo '<div class="ok">Cliente atualizado com sucesso!</div>';
		
		}catch(PDOexception $error_atualizaPerfil){
			echo 'Erro ao atualizar perfil';
			}
}

?> 
<?php
    $clienteEditaId = $_GET['clienteid'];
    $sql_pegaCliente = 'SELECT * FROM up_clientes WHERE clienteId = :clienteId';
	
	try{
		$query_pegaClientes = $conecta->prepare($sql_pegaCliente);
		$query_pegaClientes->bindValue(':clienteId',$clienteEditaId,PDO::PARAM_STR);
		$query_pegaClientes->execute();
		
		$res_queryPegaCliente = $query_pegaClientes->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexcetpion $error_clientes){
		  echo 'Erro ao seleciona os clientes!';	
		}
		
		foreach($res_queryPegaCliente as $resCliente){
			$clienteEditaId    = $resCliente['clienteId'];
			$clienteNome  = $resCliente['nome'];
			$clienteemail = $resCliente['email'];
			$clienteTelefone = $resCliente['telefone'];
            $i++;
		if($i % 2 == 0){
			$cor = 'style="background:#E6FFF2"';
		}else{
			$cor = 'style="background:#f4f4f4;"';
		}

?>   
      
      <form name="perfil" action="" enctype="multipart/form-data" method="post">
         <label>
           <span>Seu Nome:</span>
           <input type="text" name="sendNome" size="50" value="<?php echo $clienteNome;?>" />
         </label>
                
         <label>
           <span>Senha:</span>
         <input type="password" name="sendSenha" />
         </label>
         
         <label>
           <span>Telefone:</span>
           <input type="text" name="sendFone" value="<?php echo $clienteTelefone;?>" />
         </label>
         
         <input type="hidden" name="editaCliente" value="<?php echo $clienteEditaId;?>" />
         
         <input type="submit" name="executar" id="executar" value="Atualizar Dados" />
      
<?php
		}
?>    
      
      </form>
      
   <a href="painel.php?exe=clientes/clientes">Voltar</a>   
      
   </div><!--conteudo-->

</div><!--contet-->
     
<?php include_once("footer.php");?>