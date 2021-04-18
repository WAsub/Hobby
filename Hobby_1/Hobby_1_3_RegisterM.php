<?php
//データベース定義
        define('HOST', 'mysql1.php.xdomain.ne.jp');
        define('USR', 'haveabook_user1');
        define('PASS', 'waka7ari');
        define('DB', 'haveabook_db');
class Hobby_1_3_RegisterM{   
    
    private $msg = "";
    private $userID = "";
    private $password = "";
    private $email = "";
            
    function DBcollationToken($TOKEN){ //TODO
        $today = date("Y-m-d");
        //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
        }

        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');

        //SQL文の作成
        $sql = "SELECT email FROM H1_4_preRegister ";
        $sql.= "WHERE token LIKE \"".$TOKEN."\"";
        $sql.= "AND date = \"".$today."\"";

        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);

        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);
        $flg = "0";
        $ret = "";
        if($num > 0){
            //データの取得
            //取り出した値を変数に入れる
            mysqli_stmt_bind_result($stmt, $email);
            mysqli_stmt_fetch($stmt);
            $flg = "1";
            $ret = $email;    
        }

        
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return array($flg, $ret);
    }
    function DataGET(){
        $getmsg;
        if(isset($_GET["token"])) {
            $collation = $this->DBcollationToken(trim(htmlspecialchars($_GET["token"], ENT_QUOTES, 'UTF-8')));//データベースからトークン照合[0]にbool、[1]にemail
            if((bool)$collation[0]){
                $this->email = $collation[1];
                $getmsg =   '<form action="Hobby_1_3_Register.php" method="post">'.
                                '<div class="block">'.
                                    '<div class="left">'.
                                        'ID(英数字)<br><br>'.
                                        'パスワード(英数字6～8桁)<br><br>'.
                                        'メールアドレス'.
                                    '</div>'.
                                    '<div class="right">'.
                                        '<input type="text" id="ID" name="ID" ><br><br>'.
                                        '<input type="text" id="pass" name="pass" ><br><br>'.
                                        '<input type="text" id="email" name="email" value="'.$collation[1].'" readonly="readonly">'.
                                    '</div>'.
                                    '<button type="submit" name="submit" value="新規登録">新規登録</button>'.
                                '</div>'.                                
                            '</form>';
            }else{
                $getmsg =   '<div class="block">'.
                                '<div class="left">'.
                                '</div>'.
                                '<div class="right">'.
                                    'URLを取得してから日付が変わりました。'.
                                    'もう一度仮登録からやり直してください。'.
                                '</div>'.
                            '</div>';
            }
        }else{
            if(!isset($_POST["submit"])) {
                $getmsg =   '<div class="block">'.
                                '<div class="left">'.
                                '</div>'.
                                '<div class="right">'.
                                    'URLが正しくありません。'.
                                    'もう一度仮登録からやり直してください。'.
                                '</div>'.
                            '</div>';
            }
        }
        return $getmsg;
    }
    function DataPOST(){
        if(isset($_POST["submit"])) {
            $this->userID = trim(htmlspecialchars($_POST['ID'], ENT_QUOTES, 'UTF-8'));
            $this->password = trim(htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8'));
            $this->email = trim(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'));
            //正規表現 
            if(!preg_match("/^[A-Za-z0-9_]{6,20}$/", $this->userID)){
                $this->msg = "ユーザーIDは英数字で6文字以上20文字以内で入力してください。";
                return;
            }
            if(!preg_match("/^[A-Za-z0-9_]{6,8}$/", $this->userID)){
                $this->msg = "パスワードは英数字で6文字以上8文字以内で入力してください。";
                return;
            }
            $this->DBuserInsert($this->userID, $this->password, $this->email);
        }
    }
            
            
    function DBuserInsert($userID,$password,$email){
        //引数は正誤チェック済み
        while(true){
            //データベースサーバに接続
            if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
                die('データベースに接続できません');
            }

            //クエリの文字コードを設定
            mysqli_set_charset($conn, 'utf8');
                //SQL文の作成
                $sql =  "INSERT INTO H1_4_Users(ID, pass, email) ";
                $sql .= "VALUES(?,?,?)";

                $stmt = mysqli_prepare($conn, $sql);

                mysqli_stmt_bind_param($stmt, 'sss', $userID, $password, $email);

                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) > 0){
                    $this->msg = "登録完了しました！";
                    $this->DBcreate($userID);
                    return;
                }          

            //データベースの接続を閉じる
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
    function DBcreate($userID){
        //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
        }

        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');

        //SQL文の作成
        $sql = "SELECT CONCAT(mybase, Dno) FROM H1_4_Users ";
        $sql.= "WHERE ID LIKE \"".$userID."\"";

        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);

        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);
        if($num > 0){
            //データの取得
            //取り出した値を変数に入れる
            mysqli_stmt_bind_result($stmt, $mybase);
            mysqli_stmt_fetch($stmt);
            $myDatabase = $mybase;    
        }

        $sql = "CREATE TABLE ".$mybase." (SELECT * FROM H1_2_DefaultData)";
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);

        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        var_dump(mysqli_stmt_error($stmt));

        if(mysqli_stmt_error($stmt) != ""){
            $this->msg = "登録失敗。最初からやり直してください。";
        }
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    
    function getMsg(){
        return $this->msg;
    }
}