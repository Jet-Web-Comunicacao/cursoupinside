<?php include"../Connections/painel_config.php";

$conecta = mysql_connect("$hostname_painel_config","$username_painel_config","$password_painel_config");
$db = mysql_select_db("$database_painel_config");

$imovel = $_POST['imovel'];

$seleciona = mysql_query("SELECT * FROM up_imoveis WHERE imovelTipo = '$imovel' GROUP BY imovelBairro");
echo '<option value="">Selecione o bairro</option>';
while($res_seleciona = mysql_fetch_array($seleciona)){
	$bairro = $res_seleciona['imovelBairro'];
	echo '<option value="'.$bairro.'">'.$bairro.'</option>';
	
}?>
