<?php
    session_start();
    require_once('Hobby_1_1_homeM.php');
    require_once('Hobby_1_1_homeM2.php');
    $M = new Hobby_1_1_homeM();
    $M2 = new Hobby_1_1_homeM2();
    
    $log = $M->login();
    $M->DBselect();
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>ツイステカード編成ツール</title>
        <meta charset="UTF-8">
        <meta name = "authr" content="有本 和奏" charset="utf-8">
        <link href="../css/Hobby_1/Hobby_1_1_home.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div>
                <h1>ツイステカード編成ツール<a href="Hobby_1_3_preRegister.php"  target="_self">新規登録</a></h1>
            </div>
        </header>
        <main>
            <form>
            <br><br>
            <h2><?= $log ?></h2>
            <br><br><br>
            <div id="Mcontents">
                <div id="CandS">
                    <div id="card">
                        <?= $M2->printCards() ?>
                    </div>
                    <div id="status">
                        <?= $M2->printStatuses() ?>
                    </div>
                </div>
                <div id="button">
                    <table id="Ttotal" style="font-size: 11px;">
                    <tr>
                        <td>合計HP</td><td>合計HP(回復込み)</td>
                    </tr>
                    <tr>
                        <td><input id="DtotalHP" class="text2" type="text" value="" readonly="readonly"></td>
                        <td><input id="DtotalHPrec" class="text2" type="text" value="" readonly="readonly"></td>
                    </tr>
                    <tr>
                        <td colspan="2">各試験の予想トータルダメージ</td>
                    </tr>
                    <tr>
                        <td style="color: rgb(122,124,125);">
                        無属性の試験
                        </td>
                        <td>
                        <input id="DtotalN" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: green;">
                        木属性の試験
                        </td>
                        <td>
                        <input id="DtotalT" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: blue;">
                        水属性の試験
                        </td>
                        <td>
                        <input id="DtotalW" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: red;">
                        火属性の試験
                        </td>
                        <td>
                        <input id="DtotalF" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">各試験の予想ダメージ(選択)</td>
                    </tr>
                    <tr>
                        <td style="color: rgb(122,124,125);">
                        無属性の試験
                        </td>
                        <td>
                        <input id="DtotalNsel" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: green;">
                        木属性の試験
                        </td>
                        <td>
                        <input id="DtotalTsel" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: blue;">
                        水属性の試験
                        </td>
                        <td>
                        <input id="DtotalWsel" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    <tr>
                        <td style="color: red;">
                        火属性の試験
                        </td>
                        <td>
                        <input id="DtotalFsel" class="text2" type="text" value="" readonly="readonly">
                        </td>
                    </tr>
                    </table>
                    <?= $M->customlink() ?>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br>
            <div id="overlay" class="hidden" onclick="clickCloseModal(this)">
                <div id="modal" class="hidden" onclick="stop()">
                    <input type="hidden" id="target" value="">
                    <span id="sortBtn" onclick="clickOpenSortModal()">ソート</span>
                    <img id="ud" src="../img/Hobby_1/desc.jpg" alt="desc" width="20" height="20" onclick="UD(this)">
                    <?= $M->printCard() ?>
                    
                </div>
            </div>
            <div id="overlaySort" class="hidden" onclick="clickCloseSortModal()">
                <div id="modalSort" class="hidden" onclick="stop()">
                    <label><input name="sorts" type="radio" value="default" onclick="sort(this)">デフォルト</label>
                    <label><input name="sorts" type="radio" value="Lv" onclick="sort(this)">Lv</label>
                    <label><input name="sorts" type="radio" value="HP" onclick="sort(this)">HP</label>
                    <label><input name="sorts" type="radio" value="ATK" onclick="sort(this)">ATK</label>
                    <label><input name="sorts" type="radio" value="chNo" onclick="sort(this)">キャラクター</label>
                    <br><br>
                    <label><input class="filter1" type="checkbox" value="0" onclick="sort(this)" checked>すべて</label>
                    <label><input class="filter1" type="checkbox" value="1" onclick="sort(this)">Heartslabyul</label>
                    <label><input class="filter1" type="checkbox" value="2" onclick="sort(this)">Savanaclaw</label>
                    <label><input class="filter1" type="checkbox" value="3" onclick="sort(this)">Octavinelle</label>
                    <label><input class="filter1" type="checkbox" value="4" onclick="sort(this)">Scarabia</label>
                    <label><input class="filter1" type="checkbox" value="5" onclick="sort(this)">Pomefiore</label>
                    <label><input class="filter1" type="checkbox" value="6" onclick="sort(this)">Ignihyde</label>
                    <label><input class="filter1" type="checkbox" value="7" onclick="sort(this)">Diasomnia</label>
                    <br>
                    <label><input class="filter2" type="checkbox" value="0" onclick="sort(this)">Nomal</label>
                    <label><input class="filter2" type="checkbox" value="1" onclick="sort(this)">Fire</label>
                    <label><input class="filter2" type="checkbox" value="2" onclick="sort(this)">Tree</label>
                    <label><input class="filter2" type="checkbox" value="3" onclick="sort(this)">Water</label>
                    <br>
                    <label><input class="filter3" type="checkbox" value="0" onclick="sort(this)">持ってるやつ</label>
                </div>
            </div>
            </form>
        </main>
        <footer>
            
        </footer>
        <script type="text/javascript" src="../js/Hobby_1/Hobby_1_1_home.js"></script>
        <script type="text/javascript" src="../js/Hobby_1/sort.js"></script>
        <script src="../lib/vue.js"></script> 
        <script src="../js/Hobby_1/selectLv_vue.js"></script>
        <script> new Vue({ el: '#status' });</script>
    </body>
</html>