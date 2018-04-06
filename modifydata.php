<?php
//DB接続クラス読み込み
require_once 'dbConnectClass.php';
//データチェッククラス読み込み
require_once 'dataCheckClass.php';
//フォームデータチェッククラス読み込み
require_once 'chkFormClass.php';

//クラス生成
$connect = new dbConnect();
$check = new dataCheckClass();
$checkf = new chkFormClass();

//登録データをフォームから取得
$process = $_POST['process'];
$id = $_POST['id'];
$kana = $check->strTrim($_POST['userNameKana']);
$name = $check->strTrim($_POST['userName']);
$age = $check->strTrim($_POST['age']);
$gender = $_POST['gender'];

//エラーチェック 
try{
    switch($process){
        case "更新":
            $flg = 'u';
            break;
        case "削除":
            $flg = 'd';
            break;
        default:
            throw new Exception('実行処理判定不可');
    }
    
if($flg=='u'){
    $errmsg = $checkf->inputChk($kana, $name, $age, $gender); 
    if(!$errmsg){

    //結果を取得
    $result = $connect->updateData($id, $kana, $name, $age, $gender);
    //結果メッセージを表示
    if($result->rowCount()>0){
         $r_message = '更新しました。';
    } else {
         $r_message = '更新に失敗しました。';
    }
} else {
    $r_message = $errmsg;
}
}
} catch(Exception $e){
   echo 'error:' .$e->getMessage();
   return;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>登録結果</title>
    </head>

    <body>
<?php
echo "結果：".$r_message;   
?>

    </body>
</html>