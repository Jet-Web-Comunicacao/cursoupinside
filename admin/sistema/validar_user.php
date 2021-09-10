<?php

include"../Connections/config.php";

$usuarioSistema = $_SESSION['MM_Username'];
$sqlSistema_usuarioSistema = 'SELECT * FROM up_clientes WHERE email = :usuarioSistema';

try{
	$querySistema_usuarioSistema = $conecta->prepare($sqlSistema_usuarioSistema);
	$querySistema_usuarioSistema->bindValue(':usuarioSistema',$usuarioSistema,PDO::PARAM_STR);
	$querySistema_usuarioSistema->execute();
	
	$resultado_querySistema = $querySistema_usuarioSistema->fetchAll(PDO::FETCH_ASSOC);
	
	}catch(PDOexception $error_usuarioSistema){
		echo 'erro ao selecionar o usuario';
		echo '<meta http-equiv="refresh" content="2, deslogar.php" />';
		}
		
    foreach($resultado_querySistema as $res_usuarioSistema);
	  $clienteId = $res_usuarioSistema['clienteId'];
	  $clienteCriado = $res_usuarioSistema['criadoEm'];
	  $clienteModificado = $res_usuarioSistema['modificadoEm'];
	  $clienteStatus = $res_usuarioSistema['clienteStatus'];
	  $clienteNivel = $res_usuarioSistema['usuarioNivel'];
	  $clienteNome = $res_usuarioSistema['nome'];
	  $clienteEmail = $res_usuarioSistema['email'];
	  $clienteSenha = $res_usuarioSistema['senha'];
	  $clienteTelefone = $res_usuarioSistema['telefone'];

?>