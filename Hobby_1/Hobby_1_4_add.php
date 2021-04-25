<?php
    session_start();
    require_once('Hobby_1_4_addM.php');
    $M = new Hobby_1_4_addM();
    $loginUser = $M->login(); // ログイン状況を把握
	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ツイステカード編成ツール</title>
        <meta charset="UTF-8"><meta name = "authr" content="有本 和奏">
        <link href="../css/Hobby_1/Hobby_1_4_add.css" rel="stylesheet" type="text/css">
    </head>
    <body onload="load()">
        <header>
            <div>
                <h1>ツイステカード編成ツール<a href="../Hobby_1/Hobby_1_1_home.php" id="homelink">ホームへ戻る</a></h1>
            </div>
        </header>
        <main>
            <br><br><br>
            <h2><?= $loginUser ?></h2><!-- ユーザ名表示 -->
            <form action="Hobby_1_4_add.php" method="post">
                <?php $M->addCard();?>
            </form>               
        </main>
        
        <script type="text/javascript" src="../js/Hobby_1/Hobby_1_2_custom.js"></script>
        <script type="text/javascript" src="../js/Hobby_1/sort.js"></script>
        <script src="../lib/vue.js"></script> 
        <script src="../js/Hobby_1/selectLv_vue.js"></script>
        <script src="../js/Hobby_1/selectLv_vue2.js"></script>
        <script src="../js/Hobby_1/selectCardLv_vue.js"></script>
        <script> new Vue({ el: '.contents' });</script>
    </body>
</html>
