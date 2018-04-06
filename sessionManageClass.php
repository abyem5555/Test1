<?php

//セッション管理クラス
class sessionManageClass{

    //セッション破棄するファンクション
    function killSession() {
    
        //セッション変数を空にする
        $_SESSION = [];
        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(), '', time()-36000);
        }

        //セッションを破棄する
        session_destroy();
    }
}
?>
