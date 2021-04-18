<?php
//データベース定義
        define('HOST', 'mysql1.php.xdomain.ne.jp');
        define('USR', 'haveabook_user1');
        define('PASS', 'waka7ari');
        define('DB', 'haveabook_db');
class Hobby_1_3_preRegisterM{   
    
    private $msg = "";
    private $email = "";
    private $token = "";
    
    private function get_token(){
        $TOKEN_LENGTH = 16;
        $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
        return bin2hex($bytes);
    }
    private function DBcollationEmail($EMAIL){
        //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
        }

        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');

        //SQL文の作成
        $sql = "SELECT ID FROM H1_4_Users ";
        $sql.= "WHERE email LIKE \"".$EMAIL."\"";

        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);

        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);
        $flg = false;
        if($num == 0){
            $flg = true;
        }
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        
        return $flg;
    }
            
    function DataPOST(){
        if(isset($_POST["submit"])) {
            $this->email = trim(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'));
            //正規表現 
            if(!preg_match("/^[A-Za-z0-9.]+@[A-Za-z0-9]+.[A-Za-z0-9]+$/", $this->email)){
                $this->msg = "正確なメールアドレスを入力してください。";
                return;
            }
            if(!$this->DBcollationEmail($this->email)){
                $this->msg = "すでに使われているメールアドレスは使えません。";
                return;
            }
            var_dump($this->DBcollationEmail($this->email));
            $this->DBpreInsert();
        }
    }
            
            
    private function DBpreInsert(){
        //引数は正誤チェック済み
        $this->token = $this->get_token();
        //本登録メールを送信
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $to = $this->email; //登録メアド
        $subject = "仮登録完了及び本登録URL通知";
        $message = "http://haveabook.php.xdomain.jp/Hobby_1/Hobby_1_3_Register.php?token=".$this->token;
        var_dump($to);
        var_dump($subject);
        var_dump($message);
        var_dump($this->msg);
        if(mb_send_mail($to, $subject, $message)){ //メールが送信出来たら登録
            $today = date("Y-m-d");
            var_dump($today);
            var_dump($this->email);
            var_dump($this->token);
            while(true){
                //データベースサーバに接続
                if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
                    die('データベースに接続できません');
                }
                //クエリの文字コードを設定
                mysqli_set_charset($conn, 'utf8');
                //SQL文の作成
                $sql =  "INSERT INTO H1_4_preRegister(email, token, date) ";
                $sql .= "VALUES(?,?,?)";

                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param($stmt, 'sss', $this->email, $this->token, $today);

                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) > 0){
                    $this->msg = "仮登録完了しました！";
                    break;
                } 
                var_dump(1);
            }
            //データベースの接続を閉じる
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }            
    }
    
    function getMsg(){
        return $this->msg;
    }
}