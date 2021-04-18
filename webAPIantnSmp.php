<?php
// 文字コード設定
header('Content-Type: application/json; charset=UTF-8');

//データベース定義
    define('HOST', 'mysql1.php.xdomain.ne.jp');
    define('USR', 'haveabook_user2');
    define('PASS', 'androidsamp');
    define('DB', 'haveabook_android');

// numが存在するかつnumが数字のみで構成されているか
if(isset($_GET["num"]) && !preg_match('/[^0-9]/', $_GET["num"])) {
    // numをエスケープ(xss対策)
    $param = htmlspecialchars($_GET["num"]);
    // メイン処理
    //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
	}
        
        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');
        
        //SQL文の作成
        $sql = "SELECT * FROM userTable";
        
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        
        
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);            
        if($num > 0){
            //データの取得
            //取り出した値を変数に入れる
            $r = array();
            $i = 0;
            mysqli_stmt_bind_result($stmt, $id, $name);
            while(mysqli_stmt_fetch($stmt)){
                $r[$i] = array('userId'=>$id, 'userName'=>$name);
                $i++;
            }
        }
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    
    
    
    $arr["status"] = "yes";
    $arr["results"] = $r; 
//    $arr["x514"] = (string)((int)$param * 514); // 514倍
} else {
    // paramの値が不適ならstatusをnoにしてプログラム終了
    $arr["status"] = "no";
}

// 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
print json_encode($arr, JSON_PRETTY_PRINT);
?>