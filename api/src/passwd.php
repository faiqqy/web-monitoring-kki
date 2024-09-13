<?php


$apiKey_tersimpan= array();
$apiKey_tersimpan[0]="8689a53eee577bd0b4e12e68615169a4f79a45c1c8e35db15857ca5e65a4eb37";



//check kebenaran api
function apiKey_check($api){
	
	global $apiKey_tersimpan;
	$api=hash('sha256', $api);
	
	//cek $api berisi atau tidak
	foreach($apiKey_tersimpan as $x){
		
		//check api benar
		if ($api == $x){
			return true;
		} else {
			return false;
		}
		
	}
	
	return false;	
	
}




?>