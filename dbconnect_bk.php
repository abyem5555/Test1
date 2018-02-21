<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>検索結果</title>
    </head>
    <body>
 <?php
try{
    $pdo=new PDO(
        'mysql:host=localhost;dbname=testdb;charset=utf8',
        'testuser',
        'test',
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        )
    );

    //print('接続OK！');
    
    //検索条件
    $nam1 = $_POST['userName'];
    //$nam1 = "高橋";
    
    //SQL文
    $prestm = $pdo->prepare('SELECT * 
                                FROM test122
                                WHERE user_name LIKE(:name1)');
    
    //値をバインド
    //.で文字連結して検索
    //$prestm->bindValue(':name1','%'.$nam1.'%',PDO::PARAM_STR);
    //%{}%で検索
    $prestm->bindValue(':name1',"%{$nam1}%",PDO::PARAM_STR);
    //実行
    $prestm->execute();

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
    

} catch (PDOException $e){
    exit('データベース接続失敗'.$e->getMessage());
}

?>

       <table border="1">
            <tr>
                <th>番号</th>
                <th>名前</th>
                <th>年齢</th>
                <th>性別</th>
            </tr>
<?php
    while($row = $prestm->fetch(PDO::FETCH_ASSOC)){
?>
            <tr>
                <td><?=htmlspecialchars($row['id'])?></td>
                <td><?=htmlspecialchars($row['user_name'])?></td>
                <td><?=htmlspecialchars($row['age'])?></td>
                <td><?=htmlspecialchars($row['sex'])?></td>
            </tr>
<?php
    }
//接続を閉じる
$pdo = null;
?>
        </table>
    </body>
</html>