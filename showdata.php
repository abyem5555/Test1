<?php
    //一覧でクリックした番号をキーにデータをフォームに表示。
    //フォームを表示しデータ変更・削除する画面

    //セッション開始
    session_start();

    //DB接続クラス読み込み
    require_once 'dbConnectClass.php';
    //セッション管理クラスを読み込み
    require_once 'sessionManageClass.php';

    //クラス生成
    $connect = new dbConnect();
    $sessionm = new sessionManageClass();

    try{

    //IDを前のページから取得
    $id = $_GET['id'];

    //メッセージを初期化
    $msg = "";

    //セッション変数に保存した入力データを取り出す
    if (isset($_SESSION["errmsg"])){
        $msg = $_SESSION["errmsg"];
        $userNameKana = $_SESSION["kana"];
        $userName = $_SESSION["name"];
        $age = $_SESSION["age"];
        $gender = $_SESSION["gender"];
        $sessionm->killSession();
    } else {

        //検索結果を取得
        $result = $connect->selectID($id);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        
        //DBから取得した値をフォームに表示
        $userNameKana = $row['user_name_kana'];
        $userName = $row['user_name'];
        $age = $row['age'];
        $gender = $row['gender'];
        
    }

        //ラジオボタンチェック判定変数
        $male = "";
        $female = "";
        
        //性別のラジオボタンチェック
        switch($gender){
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
    
    <?php
    if ($msg){
        echo "$msg";
        echo "<br>";
    }
    ?>
    
    <form method="POST" action="modifydata.php">
      <ul>
        <br><label>番号：<?=htmlspecialchars($id,ENT_QUOTES,'utf-8')?></label>
        <br><label>なまえ：<input type="text" name="userNameKana" value="<?=$userNameKana?>"></label>
        <br><label>名前：<input type="text" name="userName"
                    value="<?=$userName?>"></label>
        <br><label>年齢：<input type="number" name="age" value="<?=$age?>"></label>
        <br><label>性別：<input type="radio" name="gender" value="M" <?=$male?>>男
                    <input type="radio" name="gender" value="F" <?=$female?>>女
            </label>
        <br>
        <label><input type="submit" value="更新" name="process"></label>
        <label><input type="submit" value="削除" name="process"></label>
        <label><input type="hidden" name="id" value="<?=$id?>"></label>
        </ul>
    </form>
    </body>
</html>