<?php
    //DB接続クラス読み込み
    require_once 'dbConnectClass.php';
    require_once 'dataCheckClass.php';

    //クラス生成
    $connect = new dbConnect();
    $check = new dataCheckClass();

    //検索するテーブル名
    $tablename = 'test122';

    try{
   //検索結果を取得
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
        <title>検索結果</title>
    </head>
    <body>
 <?php
    
    
?>

       <table border="1">
            <tr>
                <th>番号</th>
                <th>名前かな</th>
                <th>名前</th>
                <th>年齢</th>
                <th>性別</th>
                <th></th>
            </tr>

<?php
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        //print_r($row);
?>
            <tr>
                <td><?=htmlspecialchars($row['id'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['user_name_kana'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['user_name'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['age'],ENT_QUOTES,'utf-8')?></td>
                <td><?=htmlspecialchars($row['gender'],ENT_QUOTES,'utf-8')?></td>
                <td>
                    <form method="POST" action="changedata2.php">
                        <input type="submit" value="変更"></td>
                        <input type="hidden" name="id" value="<?=$row['id']?>"></td>
                    </form>
            </tr>
<?php
    }
?>
        </table>
   </body>
</html>