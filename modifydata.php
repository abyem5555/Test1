<?php
//DB接続クラス読み込み
require_once 'dbConnectClass.php';
//データチェッククラス読み込み
require_once 'dataCheckClass.php';

//クラス生成
$connect = new dbConnect();
$check = new dataCheckClass();

//登録データをフォームから取得
$process = $_POST['process'];
$id = $_POST['id'];
$kana = $check->strTrim($_POST['userNameKana']);
$name = $check->strTrim($_POST['userName']);
$age = $check->strTrim($_POST['age']);

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
    //かなの入力がない場合エラー
    if(empty($kana)){
        throw new Exception('名前のふりがなを入力してください。');
    } else {
        //ひらがなでない場合エラー
        if(!$check->chkKana($kana)){
            throw new Exception('ふりがなはひらがなで入力してください。');
        }
    }

    //名前の入力がない場合エラー
    if(empty($name)){
        throw new Exception('名前を入力してください。');
    }
    
    //年齢の入力がない場合エラー
    if(($age != "0") && empty($age)){
        throw new Exception('年齢を入力してください。');
    } else {
        //年齢が正の数字でない場合エラー
        if(!$check->chkNum($age)) {
            throw new Exception('年齢が正しくありません');   
        }
    }
    
    //性別の選択がない場合エラー
    if (empty($_POST['gender'])){
        throw new Exception('性別を選択してください。');
    } else {
        //性別の取得
        switch($_POST['gender']){
            //男性
            case "male":
                $gender = 'M';
                break;
            //女性
            case "female":
                $gender = 'F';
                break;
            //それ以外
            default:
                $gender = '';
                break;
        }
    }

    //結果を取得
    $result = $connect->updateData($id, $kana, $name, $age, $gender);
    //結果メッセージを表示
    if($result->rowCount()>0){
         $r_message = '更新しました。';
    } else {
         $r_message = '更新に失敗しました。';
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