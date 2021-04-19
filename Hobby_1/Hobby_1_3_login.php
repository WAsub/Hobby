<?php
    session_start();
    require_once('Hobby_1_3_loginM.php');
    $M = new Hobby_1_3_loginM();
    
    $M->DataPOST();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ツイステカード編成ツール</title>
        <meta charset="UTF-8">
        <meta name = "authr" content="有本 和奏">
        <link href="../css/Hobby_1/Hobby_1_3_login.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <header>
            <div>
                <h1>ツイステカード編成ツール<a href="../index.html" id="homelink">ホームへ戻る</a></h1>
            </div>
        </header>
        <main>
            <br><br><br><br>
            <form action="Hobby_1_3_login.php" method="post">
                <div class="block">
                    <div class="left">
                        ID(英数字)<br><br>
                        パスワード(英数字6～8桁)
                    </div>
                    <div class="right">
                        <input type="text" id="ID" name="ID" ><br><br>
                        <input type="password" id="pass" name="pass" >
                    </div> 
                    <button type="submit" name="submit" value="ログイン">ログイン</button>
                </div>                
            </form>            
        </main>
        <footer>
        </footer>
    </body>
</html>
