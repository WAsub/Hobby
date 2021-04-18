<?php
    session_start();
    require_once('Hobby_1_2_customM.php');
    $M = new Hobby_1_2_customM();
    $loginUser = $M->login(); // ログイン状況を把握
    $M->DBselect();
    $M->DataPOST();
    $msg = $M->DBupdate();
    $M->DBselect();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ツイステカード編成ツール</title>
        <meta charset="UTF-8"><meta name = "authr" content="有本 和奏">
        <link href="../css/Hobby_1/Hobby_1_2_custom.css" rel="stylesheet" type="text/css">
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
            <form action="Hobby_1_2_custom.php" method="post">
                <div id="Btns">
                    <h3>
                        <button type="submit" name="submit" value="更新">更新</button><!-- TODO -->
                        <?= $msg ?><!-- アップデート完了メッセージ -->
                    </h3>
                    <h3 id="sortBtns">
                        <span id="sortBtn" onclick="clickOpenSortModal()">ソート</span><!-- TODO -->
                        <img id="ud" src="../img/Hobby_1/desc.jpg" alt="desc" width="20" height="20" onclick="UD(this)">
                    </h3>
                </div>
                <div class="contents">
                    <div id="con"><!-- カード表示 -->
                        <?php
                            $M->updateCard();
                        ?>
                    </div>
                </div>

                <div id="overlaySort" class="hidden" onclick="clickCloseSortModal()"><!-- ソートモーダル -->
                    <div id="modalSort" class="hidden" onclick="stop()">
                        <label><input type="radio" name="sorts" value="default" onclick="sort(this)">デフォルト</label>
                        <label><input type="radio" name="sorts" value="Lv" onclick="sort(this)">Lv</label>
                        <label><input type="radio" name="sorts" value="HP" onclick="sort(this)">HP</label>
                        <label><input type="radio" name="sorts" value="ATK" onclick="sort(this)">ATK</label>
                        <label><input type="radio" name="sorts" value="chNo" onclick="sort(this)">キャラクター</label>
                        <br><br>
                        <label><input type="checkbox" class="filter1" value="0" onclick="sort(this)" checked>すべて</label>
                        <label><input type="checkbox" class="filter1" value="1" onclick="sort(this)">Heartslabyul</label>
                        <label><input type="checkbox" class="filter1" value="2" onclick="sort(this)">Savanaclaw</label>
                        <label><input type="checkbox" class="filter1" value="3" onclick="sort(this)">Octavinelle</label>
                        <label><input type="checkbox" class="filter1" value="4" onclick="sort(this)">Scarabia</label>
                        <label><input type="checkbox" class="filter1" value="5" onclick="sort(this)">Pomefiore</label>
                        <label><input type="checkbox" class="filter1" value="6" onclick="sort(this)">Ignihyde</label>
                        <label><input type="checkbox" class="filter1" value="7" onclick="sort(this)">Diasomnia</label>
                        <br>
                        <label><input type="checkbox" class="filter2" value="0" onclick="sort(this)">Nomal</label>
                        <label><input type="checkbox" class="filter2" value="1" onclick="sort(this)">Fire</label>
                        <   label><input type="checkbox" class="filter2" value="2" onclick="sort(this)">Tree</label>
                        <label><input type="checkbox" class="filter2" value="3" onclick="sort(this)">Water</label>
                        <br>
                        <label><input type="checkbox" class="filter3" value="0" onclick="sort(this)">持ってるやつ</label>
                    </div>
                </div>
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
