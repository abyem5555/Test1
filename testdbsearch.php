
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>データベーステスト検索</title>
</head>

<body>
<form method="POST" action="dbconnect.php">
  <ul>
    <br><label>名前：<input type="text" name="userName"></label>
    <br><label>年齢：<input type="number" name="age"></label>
    <br><label>性別：<input type="radio" name="gender" value="male">男
                <input type="radio" name="gender" value="female">女
                <input type="radio" name="gender" value="both" checked>指定なし
</label>
    <br><label><input type="submit" value="検索"></label>
  </ul>
</form>
</body>

</html>

