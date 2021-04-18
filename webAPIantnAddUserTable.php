<?php
//if(isset($_GET["num1"]) && isset($_GET["num2"])) {
//    $JSON_array["MyID"] = htmlspecialchars($_GET["num1"]);
//    $JSON_array["MyName"] = htmlspecialchars($_GET["num2"]);
//}else{
//    $JSON_array = "";
//}
//var_dump($JSON_array);

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
    
function random($length = 6){
    return array_reduce(range(1, $length), function($p){ return $p.str_shuffle('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz')[0]; });
}
// メイン処理
if($JSON_array != NULL){
    //データベースサーバに接続
    if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
        die('データベースに接続できません');
    }
    //クエリの文字コードを設定
    mysqli_set_charset($conn, 'utf8');
    
    $flg = false;
    if($JSON_array['MyID'] == "000000"){
        while($flg == false){
            $JSON_array['MyID'] = random();
//            var_dump("<br><br>");
//            var_dump($JSON_array['MyID']);

            //既に登録されているものか判別
            $sql = "SELECT * "
                 . "FROM userTable "
                 . "WHERE userID = \"".$JSON_array['MyID']."\"";

            //ステートメントン実行準備
            $stmt = mysqli_prepare($conn, $sql);
            //SQLステートメントの実行
            mysqli_stmt_execute($stmt); 
            mysqli_stmt_store_result($stmt);
            $num = mysqli_stmt_num_rows($stmt); 

            if($num > 0){
                //データの取得
                //取り出した値を変数に入れる
                mysqli_stmt_bind_result($stmt, $id, $name);
                mysqli_stmt_fetch($stmt);
                $flg = false;
            }else{
                $flg = true;
            }
//            var_dump("<br><br>");
//            var_dump($flg);
//            var_dump("<br><br>");
        }
    }
    //SQL文の作成
    if($flg){
        //新規登録
        $sql = "INSERT INTO userTable(userID, userName) "
             . "VALUES(\"".$JSON_array['MyID']."\",\"".$JSON_array['MyName']."\")";
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
    }else{
        //名前変更
//        $sql = "UPDATE userTable "
//             . "SET userName = \"".$JSON_array['MyName']."\" "
//             . "WHERE userID LIKE \"".$JSON_array['MyID']."\" ";
        $sql = "DELETE FROM userTable "
             . "WHERE userID = \"".$JSON_array['MyID']."\" ";
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        
        $sql = "INSERT INTO userTable(userID, userName) "
             . "VALUES(\"".$JSON_array['MyID']."\",\"".$JSON_array['MyName']."\")";
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
    }
//    var_dump("<br><br>");
//    var_dump($sql);
//    var_dump("<br><br>");
//    //ステートメントン実行準備
//    $stmt = mysqli_prepare($conn, $sql);
//    //SQLステートメントの実行
//    mysqli_stmt_execute($stmt); 
    if(mysqli_stmt_affected_rows($stmt) > 0){
        //更新成功
        $r[0]['userID'] = $JSON_array['MyID'];
        $r[0]['userName'] = $JSON_array['MyName'];
        $arr["status"] = "true";
        $arr["results"] = $r; 
    }else{
        $arr["status"] = "false";
    }
}else{
    $arr["status"] = "null";
}
// 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
print json_encode($arr, JSON_PRETTY_PRINT);

