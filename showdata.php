<?php
    //DB接続クラス読み込み
    require_once 'dbConnectClass.php';

    //クラス生成
    $connect = new dbConnect();

    try{

        //IDを前のページから取得
        $id = $_GET['id'];
        //検索結果を取得
        $result = $connect->selectID($id);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        //DBから取得した値をフォームに表示
        $userNameKana = $row['user_name_kana'];
        $userName = $row['user_name'];
        $age = $row['age'];
        
        $male = "";
        $female = "";
        
        //性別のラジオボタンチェック
        switch($row['gender']){
            //男性
            case "M":
            $male = "checked";
            break;
            //女性
            case "F":
            $female = "checked";
            break;
            //それ以外 
            default:
            break;
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
        <title>更新・削除画面</title>
    </head>
    <body>
    
    <form method="POST" action="modifydata.php">
      <ul>
        <br><label>番号：<?=htmlspecialchars($id,ENT_QUOTES,'utf-8')?></label>
        <br><label>なまえ：<input type="text" name="userNameKana" value="<?=$userNameKana?>"></label>
        <br><label>名前：<input type="text" name="userName"
                    value="<?=$userName?>"></label>
        <br><label>年齢：<input type="number" name="age" value="<?=$age?>"></label>
        <br><label>性別：<input type="radio" name="gender" value="male" <?= $male?>>男
                    <input type="radio" name="gender" value="female" <?=$female?>>女
            </label>
        <br>
        <label><input type="submit" value="更新" name="process"></label>
        <label><input type="submit" value="削除" name="process"></label>
        <label><input type="hidden" name="id" value="<?=$id?>"></label>
        </ul>
    </form>
    </body>
</html>