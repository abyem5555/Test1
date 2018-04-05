<?php   

    //DB接続クラス読み込み
    require_once 'dbConnectClass.php';
    //データチェッククラス読み込み
    require_once 'dataCheckClass.php';

    //クラス生成
    $check = new dataCheckClass();

    mb_regex_encoding("utf-8");
    $f_data1 = "";
    $hantei = "";
    $a = "";

    if(isset($_POST['formData1'])){

        //フォームからデータ取得
        $f_data1 = $_POST['formData1'];

        //$a = $check->strHalftoFull($_POST('formData1'));
        //ひらがなチェック
        //正規表現
        // //区切り文字 //でなくてもよい（\でエスケープ）
        // ^先頭([]内の場合は否定）
        // []括弧内の1文字にマッチ
        // ”ぁ〜んー” テストする文字
        // + 1回以上の繰り返し
        // $ 行末
        // u utf-8 (文字コード指定)
        //if(preg_match("/^[ぁ-んー]+$/u",$f_data1)){
        if($check->chkKana($f_data1)){
            //ひらがなのみの場合trueを返す
           $hanteiArray[] = "ひらがな"; 
        } else {
           $hanteiArray[] = "ひらがな以外";
        }

        //0以上の正の数かチェック
        if(preg_match("/^[0-9]+$/", $f_data1)){
            $hanteiArray[] = "0または正の数字";
        } else {
            $hanteiArray[] = "0と正の数字以外";
        }
        if(!empty($hanteiArray)){
            $hantei = implode("<br>", $hanteiArray);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>コードテスト用</title>
</head>
<body>
    <h1>テスト用</h1>

<form method="POST" action="test_code.php">
  <ul>
    <br><label>判定する文字：<input type="text" name="formData1" autofocus></label>
    <br><label><input type="submit" value="判定"></label><label><input type="reset" value="クリア"></label>
  </ul>
</form>

    <?php
    echo "<br>";
    echo "入力したデータ：";
    echo $f_data1;
    echo "<br>";
    echo $hantei;
    ?>
</body>

</html>