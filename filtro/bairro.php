<?php include"../Connections/painel_config.php";

$conecta = mysql_connect("$hostname_painel_config","$username_painel_config","$password_painel_config");
$db = mysql_select_db("$database_painel_config");

$bairro = $_POST['bairro'];

$seleciona = mysql_query("SELECT * FROM up_imoveis WHERE imovelBairro = '$bairro' GROUP BY imovelComodos");
echo '<option value="">Selecione os comodos</option>';
while($res_seleciona = mysql_fetch_array($seleciona)){
	$comodos = $res_seleciona['imovelComodos'];
	echo '<option value="'.$comodos.'">'.$comodos.'</option>';
	
}?>
