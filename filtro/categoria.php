<?php include"../Connections/painel_config.php";

$conecta = mysql_connect("$hostname_painel_config","$username_painel_config","$password_painel_config");
$db = mysql_select_db("$database_painel_config");

$cat = $_POST['categoria'];
$seleciona = mysql_query("SELECT * FROM up_imoveis WHERE imovelNegocio = '$cat' GROUP BY imovelTipo");
echo '<option value="">Selecione a Categoria</option>';
while($res_seleciona = mysql_fetch_array($seleciona)){
	$tipo = $res_seleciona['imovelTipo'];
	echo '<option value="'.$tipo.'">'.$tipo.'</option>';
	
}?>
