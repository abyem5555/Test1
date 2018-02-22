<?php
  //DB接続クラス読み込み
  require_once 'dbConnectClass.php';
  require_once 'dataCheckClass.php';

  //クラス生成
  $connect = new dbConnect();
  $check = new dataCheckClass();

  //登録データをフォームから取得
  $name = $check->strTrim($_POST['userName']);
  $age = $check->strTrim($_POST['age']);
  switch($_POST['gender']){
      //男性
      case "male":
        $gender = 'M';
        break;
      //女性
      case "female":
        $gender = 'F';
        break;
      //未チェックの場合
      default:
        $gender ='';
        break;
  }
  //エラーチェック 
  try{
       //名前の入力がない場合エラー
       if(empty($name)){
           throw new Exception('名前を入力してください。');
       }
       //年齢の入力がない場合エラー(0才もエラー)
       if(empty($age)){
           throw new Exception('年齢を入力してください。');
       } else {
           //年齢が正の数字でない場合エラー
           if(!$check->chkNum($age)) {
            throw new Exception('年齢が正しくありません');   
           }
       }
       //性別の選択がない場合エラー
       if(empty($gender)){
           throw new Exception('性別を選択してください。');
       }
   //結果を取得
   $result = $connect->addData($name, $age, $gender);

    } catch(Exception $e){
       echo 'error:' .$e->getMessage();
       return;
   }

   //検索結果を取得
//   $result = $connect->select($name, $age, $gender);
   //if(!$result){
   //    throw new Exception('検索結果は0です。');
   //}
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>登録結果</title>
    </head>
    <body>
<?php
    
    
?>

    </body>
</html>