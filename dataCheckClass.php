<?php

class dataCheckClass{

    //全角スペースを半角に変え、余分な空白をトリム
    function strTrim($str){
        $str = trim(mb_convert_kana($str,'s','utf-8'));
        return $str;
    }

    //全角文字を半角文字に変換
    function strFulltoHalf($str){
        //a:英数字、s:スペース
        $str = mb_convert_kana($str,'a,s','utf-8');
        return $str;
    }

    //半角文字を全角文字に変換
    function strHalftoFull($str){
        //A:英数字、S:スペース、K:カタカナ、V:濁点付の文字を1文字にする
        $str = mb_convert_kana($str,'A,S,K,V','utf-8');
        return $str;
    }

    //正の数値かチェック　正:true 負:false
    function chkNum($str){
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