<?php
    require_once('Hobby_1_3_preRegisterM.php');
    $M = new Hobby_1_3_preRegisterM();
    
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
            <form action="Hobby_1_3_preRegister.php" method="post">
                <h3><?= $M->getMsg() ?></h3>
                <div class="block">
                    <div class="left">
                        メールアドレス
                    </div>
                    <div class="right">
                        <input type="text" id="email" name="email" >                        
                    </div>
                    <button type="submit" name="submit" value="新規登録">仮登録</button>
                </div>                
            </form>            
        </main>
        <footer>
        </footer>
    </body>
</html>
