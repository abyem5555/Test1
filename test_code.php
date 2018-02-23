<?php   
    mb_regex_encoding("utf-8");
    if(empty($_POST['userNameKana'])) {
        $kana = "";
        $hantei = "";
    } else {
        $kana = $_POST['userNameKana'];

        //ひらがなチェック
        //正規表現　^先頭([]内の場合は否定）　”ぁ〜んー”　+1回以上の繰り返し $行末 u:utf-8
        if(preg_match("/^[ぁ-んー]+$/u",$kana)){
        //if(preg_match('/[^ぁ-んー]+$/u',$kana)){
            //ひらがなのみの場合trueを返す
           $hantei = "ひらがな"; 
        } else {
           $hantei = "ひらがな以外";
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
    <br><label>なまえ：<input type="text" name="userNameKana"></label>
    <br><label><input type="submit" value="判定"></label>
  </ul>
</form>

    <?php
    echo $kana;
    echo "<br>";
    echo $hantei;
    ?>
</body>

</html>