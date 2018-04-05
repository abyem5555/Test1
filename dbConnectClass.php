<?php
class dbConnect {

    //定数        
    const DB_NAME = 'testdb';       //DB名
    const DB_HOST = 'localhost';    //ホスト名
    const DB_CHARSET = 'utf8';      //文字コード
    const DB_USER = 'testuser';     //ユーザー
    const DB_PWD = 'test';          //パスワード

    //DB接続ファンクション
    function pdo(){
        $dsn='mysql:dbname='.self::DB_NAME.
            ';host='.self::DB_HOST.
            ';charset='.self::DB_CHARSET;
        $db_user = self::DB_USER;
        $db_pwd = self::DB_PWD;

        try{
            //DSN、ユーザー名、パスワード、オプション
            
        //$pdo=new PDO(
        //'mysql:host=localhost;dbname=testdb;charset=utf8',
        //'testuser',
        //'test',
        //array(
        //    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        //    PDO::ATTR_EMULATE_PREPARES => false,
        //    )
            $pdo=new PDO(
                $dsn,
                $db_user,
                $db_pwd,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    )
            );
            //print('接続OK！');
 
        } catch (PDOException $e){
            exit('データベース接続失敗'.$e->getMessage());
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $pdo;
    }


    //テーブル名を指定して全データを表示するファンクション
    function selectAllData($tablename){
        //SQL文
        $sql = 'SELECT * 
                FROM ';
        $sql = $sql.$tablename; 

        //$sql = 'SELECT * FROM test122';
        //検索結果を取得
        $pdosl = $this->pdo();
        $prestm = $pdosl->prepare($sql);
    
        //実行
        $prestm->execute();
        //結果を戻す
        return $prestm;
    }

    //IDでの検索用ファンクション
    function selectID($id){

        //SQL文
        $sql = 'SELECT * 
                FROM test122
                WHERE id = :id';

        //検索結果を取得
        $pdosl = $this->pdo();
        $prestm = $pdosl->prepare($sql);
    
        if(!empty($id)){
            $prestm->bindValue(':id',$id,PDO::PARAM_STR);
        }
        //実行
        $prestm->execute();
        //結果を戻す
        return $prestm;
    }
    
    //名前・年齢・性別での検索用ファンクション
    function selectData($name, $age, $gender){

        //SQL文
        //！！！LIKEのエスケープ入れる？
        $sql = 'SELECT * 
                FROM test122
                WHERE';
        //$sql = $sql.' user_name = "高橋アイコ"';

        //検索条件に名前があるとき
        if(!empty($name)){
            $sqlArray[] = ' user_name LIKE(:name)';
        }
        //検索条件に名前があるとき
        if(!empty($age)){
            $sqlArray[] = ' age = :age';
        }
        //検索条件に名前があるとき
        if(!empty($gender)){
            $sqlArray[] =' gender = :gender';
        }

        //配列の判定した方がいい？
        //条件をANDでつないでSQL文を作成
        $sql= $sql.implode(" AND", $sqlArray);

        //検索結果を取得
        $pdosl = $this->pdo();
        $prestm = $pdosl->prepare($sql);
    
        //各項目の値がある場合、検索条件をバインド
        if(!empty($name)){
            $prestm->bindValue(':name',"%{$name}%",PDO::PARAM_STR);
        }
        if(!empty($age)){
            $prestm->bindValue(':age',$age,PDO::PARAM_INT);
        }
        if(!empty($gender)){
            $prestm->bindValue(':gender',$gender,PDO::PARAM_STR);
        }
        //実行
        $prestm->execute();
        //結果を戻す
        return $prestm;
    }
    
    //検索用ファンクション
    //function select($sql, $var1){
    //    $pdosl = $this->pdo();
    //    $prestm = $pdosl->prepare($sql);
    
    //    //検索条件の値をバインド
    //    $prestm->bindValue(':name',"%{$var1}%",PDO::PARAM_STR);
    //    $prestm->bindValue(':age',$age,PDO::PARAM_INT);
    //    $prestm->bindValue(':gender',$gender,PDO::PARAM_STR);
    //    
    //    //実行
    //    //$prestm->query($sql);
    //    $prestm->execute();
    //    //結果を戻す
    //    //$result=$prestm->fetchAll(PDO::FETCH_ASSOC);
    //    //return $result;
    //    return $prestm;
    //}

    //名前・年齢・性別での登録用ファンクション
    function addData($kana, $name, $age, $gender){
        $sql = 'INSERT INTO test122
                        (user_name_kana, user_name, age, gender)
                        VALUES
                        (:kana, :name, :age, :gender)';
        //SQL文作成
        $pdoins = $this->pdo();
        $prestm = $pdoins->prepare($sql);

        //トランザクション処理を開始
        $pdoins->beginTransaction();

        try{
            //各項目をバインド
            $prestm->bindValue(':kana',$kana,PDO::PARAM_STR);
            $prestm->bindValue(':name',$name,PDO::PARAM_STR);
            $prestm->bindValue(':age',$age,PDO::PARAM_INT);
            $prestm->bindValue(':gender',$gender,PDO::PARAM_STR);
            //実行
            $prestm->execute();
            //コミット
            $pdoins->commit();

        } catch (PDOException $e){
            //エラーの場合ロールバック
            $pdoins->rollBack();
            exit('登録出来ませんでした。'.$e->getMessage());
        }
        return $prestm;
    
    }

    //更新用ファンクション
    function updateData($id, $kana, $name, $age, $gender){
        $sql = 'UPDATE test122
                    SET user_name_kana = :kana,
                        user_name = :name,
                        age = :age,
                        gender = :gender
                    WHERE id = :id';
        
        //SQL文作成
        $pdoup = $this->pdo();
        $prestm = $pdoup->prepare($sql);

        //トランザクション処理を開始
        $pdoup->beginTransaction();

        try{
            //各項目をバインド
            $prestm->bindValue(':id',$id,PDO::PARAM_INT);
            $prestm->bindValue(':kana',$kana,PDO::PARAM_STR);
            $prestm->bindValue(':name',$name,PDO::PARAM_STR);
            $prestm->bindValue(':age',$age,PDO::PARAM_INT);
            $prestm->bindValue(':gender',$gender,PDO::PARAM_STR);
            //実行
            $prestm->execute();
            //コミット
            $pdoup->commit();

        } catch (PDOException $e){
            //エラーの場合ロールバック
            $pdoup->rollBack();
            exit('更新失敗しました。'.$e->getMessage());
        }
        return $prestm;
    
    }
}
?>