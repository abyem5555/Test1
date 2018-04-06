<?php
  //DB接続クラス読み込み
  require_once 'dbConnectClass.php';

  //クラス生成
  $connect = new dbConnect();

  try{
   //検索結果を取得
   $result = $connect->selectAllData("test122");

    } catch(Exception $e){
       echo 'error:' .$e->getMessage();
       return;
   }
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>データベーステスト更新・削除</title>
    </head>
    <body>
    
    <form method="POST" action="modifydata.php">
       <table border="1">
            <tr>
                <th>番号</th>
                <th>名前</th>
                <th>年齢</th>
                <th>性別</th>
            </tr>

<?php
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td><a href="showdata.php?id=<?=$row['id']?>"><?=htmlspecialchars($row['id'],ENT_QUOTES,'utf-8')?></a></td>
                <td><?=htmlspecialchars($row['user_name'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['age'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['gender'],ENT_QUOTES,'utf-8')?></td>
            </tr>
<?php
    }
?>
        </table>
    <br>
</form>
</body>
</html>
