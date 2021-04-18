<?php
//データベース定義
        define('HOST', 'mysql1.php.xdomain.ne.jp');
        define('USR', 'haveabook_user1');
        define('PASS', 'waka7ari');
        define('DB', 'haveabook_db');
class Hobby_1_3_loginM{   
    
    private $msg = "";
    
    function DataPOST(){
        if(isset($_POST["submit"])) {
            $userID = trim(htmlspecialchars($_POST['ID'], ENT_QUOTES, 'UTF-8'));
            $password = trim(htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8'));
            
            $login = $this->DBchecklogin($userID, $password);
            
            if((bool)$login[0]){
                $_SESSION['userID'] = $login[1];
                $_SESSION['myTB'] = $login[2];
                echo '<meta http-equiv="refresh" content=" 0; url=Hobby_1_1_home.php">';
            }
        }
    }
    private function DBchecklogin($userID,$password){
        //引数は正誤チェック済み
        //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
        }
        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');
        //SQL文の作成
        $sql = "SELECT ID, CONCAT(mybase, Dno) FROM H1_4_Users ";
        $sql.= "WHERE ID LIKE \"".$userID."\"";
        $sql.= "AND pass LIKE \"".$password."\"";
        
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);
        $flg = "0";
        if($num > 0){
            //データの取得
            //取り出した値を変数に入れる
            mysqli_stmt_bind_result($stmt, $id, $mybase);
            mysqli_stmt_fetch($stmt);
            $flg = "1";
            $ID = $id;
            $myDatabase = $mybase;    
        } 

            //データベースの接続を閉じる
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            
            return array($flg, $ID, $myDatabase);
    }
     
}