<?php
function Redimensionar($tmp, $name, $largura, $pasta){
    $img = imagecreatefromjpeg($tmp);
	$x = imagesx($img);
	$y = imagesy($img);
	$altura = ($largura*$y) / $x;
	$nova = imagecreatetruecolor($largura, $altura);
	imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
	imagejpeg($nova, "$pasta/$name");
        imagedestroy($img);
	imagedestroy($nova);
	return($name);
}
?>