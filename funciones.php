<?php

function encryptLink($val1){

	$keySalt = "Note9digo";  // change it

	$qryStr = $val1;  //making query string

	//$query = base64_encode(urlencode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($keySalt), $qryStr, MCRYPT_MODE_CBC, md5(md5($keySalt)))));    //this line of code encrypt the query string

	//return $query;
	return $qryStr;

}

function decryptLink(){
	
	$keySalt = "Note9digo";     // same as used in encryptLink function

	//$queryString = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($keySalt), urldecode(base64_decode($_SERVER['QUERY_STRING'])), MCRYPT_MODE_CBC, md5(md5($keySalt))), "\0");   //this line of code decrypt the query string

	//return $queryString;   //parse query string
	return $_SERVER['QUERY_STRING'];
	
}

?>