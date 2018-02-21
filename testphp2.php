<?php
function hello($who){
	echo "{$who}さん、こんにちは";
	echo "<br>";
}

function bye($who){
	echo "{$who}さん、さよなら";
	echo "<br>";
}

//実行する関数名
$msg = "bye";
	if(function_exists($msg)){
		$msg("チューリップ");
}

$msg = "hello";
	if(function_exists($msg)){
		$msg("スイートピー");

}

?>
