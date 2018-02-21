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

    //検索用ファンクション
    function select($sql, $var1){
        $pdosl = $this->pdo();
        $prestm = $pdosl->prepare($sql);
    
        //検索条件の値をバインド
        $prestm->bindValue(':name1',"%{$var1}%",PDO::PARAM_STR);
        //実行
        //$prestm->query($sql);
        $prestm->execute();
        //結果を戻す
        //$result=$prestm->fetchAll(PDO::FETCH_ASSOC);
        //return $result;
        return $prestm;
    }
}
?>