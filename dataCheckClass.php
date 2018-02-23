<?php

class dataCheckClass{

    //全角スペースを半角に変え、余分な空白をトリム
    function strTrim($str){
        $str = trim(mb_convert_kana($str,'s','utf-8'));
        return $str;
    }

//---------未検証----------------------------
//    //全角文字を半角文字に変換
//    function strFulltoHalf($str){
//        //a:英数字、s:スペース
//        $str = mb_convert_kana($str,'a,s','utf-8');
//        return $str;
//    }
//
//    //半角文字を全角文字に変換
//    function strHalftoFull($str){
//        //A:英数字、S:スペース、K:カタカナ、V:濁点付の文字を1文字にする
//        $str = mb_convert_kana($str,'A,S,K,V','utf-8');
//        return $str;
//    }

    //ひらがなチェック
    function chkKana($str){
        //正規表現　^先頭([]内の場合は否定）　”ぁ〜んー”　+1回以上の繰り返し $行末 u:utf-8
        if(preg_match("/^[ぁ-んー]+$/u",$str)){
            //ひらがなのみの場合trueを返す
            return true;
        }
        //ひらがな以外がある場合falseを返す
        return false;
    }

    //正規表現を使用して正の数値かチェック　正:true 負:false
    function chkNum($str){
        //0以上の正の数かチェック
        if(preg_match("/^[0-9]+$/", $str)){
            return true;
        } else {
            return false;
        }
    }
    
    //正の数値かチェック　正:true 負:false
    function chkNum1($str){
        //数値型かチェック
        if(is_numeric($str)){
            //整数型に変換し、0未満ならfalseを返す
            if (intval($str)<0){
                return false;
            }
            //0以上ならをtrue返す
            return true;
        }
    }

}
?>