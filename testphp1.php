<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World!</title>
</head>
<body>
    <h1>ハローワールド！</h1>


<?php
//エラーメッセージ表示
ini_set('display_errors',1);
//全てのエラーレベルをリポート
'error_reporting(E_ALL)';
?>

<?php
for ($i=1; $i<=10; $i++){
	$num = mt_rand(1, 50);
	echo " {$num},<br>" ;}

?>


</body>
</html>
