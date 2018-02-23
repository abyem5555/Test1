<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>データベーステスト登録</title>
</head>

<body>

<form method="POST" action="registerdata.php">
  <ul>
    <br><label>なまえ：<input type="text" name="userNameKana"></label>
    <br><label>名前：<input type="text" name="userName"></label>
    <br><label>年齢：<input type="number" name="age"></label>
    <br><label>性別：<input type="radio" name="gender" value="male">男
                <input type="radio" name="gender" value="female">女
        </label>
    <br><label><input type="submit" value="登録"></label>
  </ul>
</form>
</body>

</html>

