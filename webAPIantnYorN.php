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
// メイン処理
 
if($JSON_array != NULL){
    //データベースサーバに接続
    if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
        die('データベースに接続できません');
    }

    //クエリの文字コードを設定
    mysqli_set_charset($conn, 'utf8');

    //SQL文の作成
    $sql = "UPDATE requestFriend ";
    $sql.= "SET YorN = true ";
    $sql.= "WHERE fromID LIKE \"".$JSON_array['fromID']."\" ";
    $sql.= "AND toID LIKE \"".$JSON_array['toID']."\"";

    //ステートメントン実行準備
    $stmt = mysqli_prepare($conn, $sql);
    //SQLステートメントの実行
    mysqli_stmt_execute($stmt); 
    if(mysqli_stmt_affected_rows($stmt) > 0){
        //更新成功
        $arr["status"] = "true";
    }else{
        $arr["status"] = "false";
    }
}else{
    $arr["status"] = "null";
}
// 配列をjson形式にデコードして出力, 第二引数は、整形するためのオプション
print json_encode($arr, JSON_PRETTY_PRINT);

