<?php
//データチェッククラス読み込み
require_once 'dataCheckClass.php';

class chkFormClass{

    //入力データチェックファンクション
    function inputChk($kana, $name, $age, $gender) {

        //クラス生成
        $check = new dataCheckClass();

        //エラーチェック 
        //かなの入力がない場合エラー
        if(empty($kana)){
            return '名前のふりがなを入力してください。';
        } else {
            //ひらがな以外エラー
            if(!$check->chkKana($kana)){
                return 'ふりがなはひらがなで入力してください。';
            }
        }

        //名前の入力がない場合エラー
        if(empty($name)){
            return '名前を入力してください。';
        }

        //年齢の入力がない場合エラー
        if(($age != "0") && empty($age)){
            return '年齢を入力してください。';
        } else {
            //年齢が正の数字でない場合エラー
            if(!$check->chkNum($age)) {
               return '年齢が正しくありません';   
            }
        }

        //性別の選択がない場合エラー
        if (empty($gender)){
            return '性別を選択してください。';
        }

        //チェックOKの場合はメッセージを返さない
        return;
    }
}
?>
