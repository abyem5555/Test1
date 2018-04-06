<?php
//DB接続クラス読み込み
require_once 'dbConnectClass.php';
//データチェッククラス読み込み
require_once 'dataCheckClass.php';
//フォームデータチェッククラス読み込み
require_once 'chkFormClass.php';

//クラス生成
$connect = new dbConnect();
$check = new dataCheckClass();
$checkf = new chkFormClass();

//検索するテーブル
$tablename = "test122";

//登録データをフォームから取得
$process = $_POST['process'];
$id = $_POST['id'];
$kana = $check->strTrim($_POST['userNameKana']);
$name = $check->strTrim($_POST['userName']);
$age = $check->strTrim($_POST['age']);
$gender = $_POST['gender'];

//エラーチェック 
try{

    //処理判定
    switch($process){
        //更新処理
        case "更新":
            //入力データをチェック（エラーがある場合はメッセージを返す）    
            $errmsg = $checkf->inputChk($kana, $name, $age, $gender); 
            
            //エラーメッセージがなければ更新
            if(!$errmsg){
                //結果を取得
                $result = $connect->updateData($id, $kana, $name, $age, $gender);
                //結果メッセージを表示
                if($result->rowCount()>0){
                     $r_message = '更新しました。';
                } else {
                     $r_message = '更新に失敗しました。またはデータ変更がありません。';
                }
            //エラーがある場合はメッセージを設定
            } else {
                $r_message = $errmsg;
            }
            break;

        //削除処理
        case "削除":
            $result = $connect->deleteData($id);
            
            //結果メッセージを表示
            if($result->rowCount()>0){
                $r_message = '削除しました。';
            } else {
                $r_message = '削除に失敗しました。';
            }
            break;

        default:
            throw new Exception('実行処理判定不可');
    }
    
    //更新・削除後の一覧を取得
    $afterdata = $connect->selectAllData($tablename);
    
} catch(Exception $e){
   echo 'error:' .$e->getMessage();
   return;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>登録結果</title>
    </head>

    <body>
<?php
echo "処理結果：".$r_message;   
echo "<br>";
echo "変更したデータ：";
echo "<br>";
echo "番号：".$id."  なまえ：".$kana."  名前：".$name."  年齢：".$age."  性別：".$gender;
echo "<br>";
echo "<br>";
echo "変更後の一覧";
?>

    <div>
    <table border="1">
        <tr>
            <th>番号</th>
            <th>なまえ</th>
            <th>名前</th>
            <th>年齢</th>
            <th>性別</th>
        </tr>

<?php
    while($row = $afterdata->fetch(PDO::FETCH_ASSOC)){
?>
        <tr>
            <td><?=htmlspecialchars($row['id'],ENT_QUOTES,'utf-8')?></td>
            <td><?=htmlspecialchars($row['user_name_kana'],ENT_QUOTES,'utf-8')?></td>
            <td><?=htmlspecialchars($row['user_name'],ENT_QUOTES,'utf-8')?></td>
            <td><?=htmlspecialchars($row['age'],ENT_QUOTES,'utf-8')?></td>
            <td><?=htmlspecialchars($row['gender'],ENT_QUOTES,'utf-8')?></td>
        </tr>
<?php
    }
?>
    </table>
    </div>

    </body>
</html>