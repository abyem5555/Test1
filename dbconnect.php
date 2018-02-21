<?php
  //DB接続クラス読み込み
  require_once 'dbConnectClass.php';

  //クラス生成
  $connect = new dbConnect();

  //検索条件
  $name = $_POST['userName'];
  //$name = "高橋";
    
  //SQL文
  //！！！LIKEのエスケープ入れる？
  $sql = 'SELECT * 
            FROM test122
            WHERE user_name LIKE(:name1)';
            //WHERE user_name = "高橋アイコ"';
            //echo $sql;

  $result = $connect->select($sql, $name);
  
  
    //値をバインド
    //.で文字連結して検索
    //$prestm->bindValue(':name1','%'.$nam1.'%',PDO::PARAM_STR);
    //%{}%で検索
    //$prestm->bindValue(':name1',"%{$nam1}%",PDO::PARAM_STR);
    //実行
    //$prestm->execute();

    //DBから該当するデータを全て取得
    //$result = $prestm->fetchAll(PDO::FETCH_ASSOC);

    //$stm = $pdo->query("select * from test122");
    //print($pdo->query("select user_name from test122 where id =1"));
    //$stm->execute();
    //$result = $stm->fetchall(PDO::FETCH_ASSOC);
   //print_r($result);
    //var_dump($result);
    //echo $result[user_name];

    //while($row = $stm->fetch()){
    //    printf($row['age']);
    //    printf("br");
    //}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>検索結果</title>
    </head>
    <body>
 <?php
    
    
?>

       <table border="1">
            <tr>
                <th>番号</th>
                <th>名前</th>
                <th>年齢</th>
                <th>性別</th>
            </tr>

<?php
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        //print_r($row);
?>
            <tr>
                <td><?=htmlspecialchars($row['id'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['user_name'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['age'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['sex'],ENT_QUOTES,'utf-8')?></td>
            </tr>
<?php
    }
?>
        </table>
    </body>
</html>