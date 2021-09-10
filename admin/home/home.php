<?php include_once("sistema/restrito_all.php");?>
<?php include_once("sistema/validar_user.php");?>

<?php
if($clienteNivel == 'cliente'){
    include"cliente.php";
}elseif($clienteNivel == 'admin'){
    include"admin.php";
}else{
    include"deslogar.php";
}

;?>