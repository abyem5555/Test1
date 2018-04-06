<?php
    //データベースに登録されている一覧を表示し変更したいデータを選択する
    //DB接続クラス読み込み
    require_once 'dbConnectClass.php';
    
    //クラス生成
    $connect = new dbConnect();
    $tablename = "test122";
    
    try{
      //テーブルにあるデータを全て取得
      $result = $connect->selectAllData($tablename);
    
    } catch(Exception $e){
      echo 'error:' .$e->getMessage();
      return;
    }
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>更新・削除するデータ選択</title>
    </head>
    <body>
    
    <table border="1">
        <tr>
            <th>番号</th>
            <th>なまえ</th>
            <th>名前</th>
            <th>年齢</th>
            <th>性別</th>
        </tr>

<?php
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
?>
        <tr>
            <td><a href="showdata.php?id=<?=$row['id']?>"><?=htmlspecialchars($row['id'],ENT_QUOTES,'utf-8')?></a></td>
            <td><?=htmlspecialchars($row['user_name_kana'],ENT_QUOTES,'utf-8')?></td>
            <td><?=htmlspecialchars($row['user_name'],ENT_QUOTES,'utf-8')?></td>
            <td><?=htmlspecialchars($row['age'],ENT_QUOTES,'utf-8')?></td>
            <td><?=htmlspecialchars($row['gender'],ENT_QUOTES,'utf-8')?></td>
        </tr>
<?php
    }
?>
    </table>
</body>
</html>
