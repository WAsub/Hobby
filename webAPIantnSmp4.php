<?php
// リクエストのbodyを取り出す。
$JSON_string = file_get_contents('php://input');
// JSON文字列を変換。arrayにするためにはtrueが必要です。
$JSON_array = JSON_decode($JSON_string,true);

// レスポンスの形式を指定
header("Content-Type: application/JSON; charset=utf-8");
// アカウント情報と比較
$account = "hoge";
$passwd = "piyo";
if (strcasecmp($account, $JSON_array['account']) == 0 &&
    strcasecmp($passwd, $JSON_array['passwd']) == 0) {
    // 認証成功
    // tokenと認証成功であることを返す。
    echo '{"result":"success", "token":"xxxxxxxxxx"}';
}
else {
    // 認証失敗
    
    echo '{"result":"faiiure"}';
}