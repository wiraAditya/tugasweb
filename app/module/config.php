<?php
	date_default_timezone_set('Asia/Makassar');
	$sekarang = new DateTime();
	$menit = $sekarang -> getOffset() / 60;
	 
	$tanda = ($menit < 0 ? -1 : 1);
	$menit = abs($menit);
	$jam = floor($menit / 60);
	$menit -= $jam * 60;
 	$offset = sprintf('%+d:%02d', $tanda * $jam, $menit);
	
	$db = new mysqli('localhost', 'root', '', 'db_elib') or die($db->error);
	$db->query("SET time_zone = '$offset'") or die($db->error);
?>