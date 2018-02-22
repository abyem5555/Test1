<?php
  //DB接続クラス読み込み
  require_once 'dbConnectClass.php';
  require_once 'dataCheckClass.php';

  //クラス生成
  $connect = new dbConnect();
  $check = new dataCheckClass();

  //検索条件をフォームから取得
  $name = $check->strTrim($_POST['userName']);
  $age = $check->strTrim($_POST['age']);
  //$gender = $_POST['gender'];
  switch($_POST['gender']){
      //男性
      case "male":
        $gender = 'M';
        break;
      //女性
      case "female":
        $gender = 'F';
        break;
      //"both"の場合
      default:
        $gender ='';
        break;
  }
  //$name = "高橋";
  //エラーチェック 
  try{
       //どの項目にも入力がない場合エラー
       if(empty($name) && empty($age) && empty($gender)){
           throw new Exception('条件を入力してください。');
       }
       //年齢が正の数字でない場合エラー
       if(!empty($age) && !$check->chkNum($age)) {
            throw new Exception('年齢が正しくありません');   
       }
    } catch(Exception $e){
       echo 'error:' .$e->getMessage();
       return;
   }
//            //SQL文
//            //！！！LIKEのエスケープ入れる？
//            $sql = 'SELECT * 
//                    FROM test122
//                    WHERE';
//
//            //検索条件に名前があるとき
//            if(!empty($name)){
//                $sqlArray[] = ' user_name LIKE(:name)';
//            }
//            //検索条件に名前があるとき
//            if(!empty($age)){
//                $sqlArray[] = ' age = :age';
//            }
//            //検索条件に名前があるとき
//            if(!empty($gender)){
//                $sqlArray[] =' gender = :gender';
//            }
//
            //検索結果を取得
            $result = $connect->select($name, $age, $gender);
            //if(!$result){
            //    throw new Exception('検索結果は0です。');
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
                <td><?=htmlspecialchars($row['gender'],ENT_QUOTES,'utf-8')?></td>
            </tr>
<?php
    }
?>
        </table>
    </body>
</html>