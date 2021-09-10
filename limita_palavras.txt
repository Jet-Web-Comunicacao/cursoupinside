<?php
define("TRUNC_BEFORE_LENGHT", 0);
define("TRUNC_AFTER_LENGHT", 1);
function str_truncate($str, $length, $rep=TRUNC_BEFORE_LENGHT)
{
if(strlen($str)<=$length) return $str;
if($rep == TRUNC_BEFORE_LENGHT) $oc = strrpos(substr($str,0,$length),' ');
if($rep == TRUNC_AFTER_LENGHT) $oc = strpos(substr($str,$length),' ') + $length;
return substr($str, 0, $oc);
}
?>