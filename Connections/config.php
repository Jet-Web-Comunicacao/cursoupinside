<?php
define('HOST','localhost');
define('DB','imobi');
define('USER','root');
define('PASS','');
$conexao = 'mysql:host='.HOST.';dbname='.DB;
try{
	$conecta = new PDO($conexao,USER,PASS);
	$conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	}catch(PDOexception $error_conecta){
	  'Erro ao conectar, favor informe no email contato@upimoveis.com.br';
	}
?>