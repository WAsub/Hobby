<?php
// リクエストのbodyを取り出す。
$JSON_string = file_get_contents('php://input');
// JSON文字列を変換。arrayにするためにはtrueが必要です。
$JSON_array = JSON_decode($JSON_string,true);

// レスポンスの形式を指定
header("Content-Type: application/JSON; charset=utf-8");
//データベース定義
    define('HOST', 'mysql1.php.xdomain.ne.jp');
    define('USR', 'haveabook_user2');
    define('PASS', 'androidsamp');
    define('DB', 'haveabook_android');

if($JSON_array != NULL){
    // メイン処理
    //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
	}
        
        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');
        
        //SQL文の作成
        $sql = "SELECT req.no, req.fromID, req.toID, req.YorN, req.date, user.userName "
             . "FROM requestFriend AS req INNER JOIN userTable user ON req.fromID = user.userID "
             . "WHERE req.toID LIKE \"".$JSON_array['MyID']."\"";
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
            mysqli_stmt_bind_result($stmt, $no, $fromID, $toID, $YN, $date, $uN);
            while(mysqli_stmt_fetch($stmt)){
                
                $r[$i] = array('no'=>$no, 'fromID'=>$fromID, 'toID'=>$toID, 'YorN'=>(boolean)$YN, 'date'=>$date, 'userName'=>$uN);
                $i++;
            }
        }
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    
    
    
    $arr["status"] = "yes";
    $arr["results"] = $r;
    $arr["len"] = count($r);
} else {
    // paramの値が不適ならstatusをnoにしてプログラム終了
    $arr["status"] = "no";
}

// 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
print json_encode($arr, JSON_PRETTY_PRINT);
?>