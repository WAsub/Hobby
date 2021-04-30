<?php
//データベース定義
define('HOST', 'mysql1.php.xdomain.ne.jp');
define('USR', 'haveabook_user1');
define('PASS', 'waka7ari');
define('DB', 'haveabook_db');
		
class Hobby_1_4_addM{
    private $cardData = array(
        'cdno' =>array(), 
        'chno' =>array(), 
        'img'  =>array(), 
        'lv' =>array(), 
        'hp' =>array(), 
        'atk'  =>array(), 
        'm1' =>array(), 
        'm2'  =>array(), 
        'm1buf' =>array(), 
        'm2buf' =>array(), 
        'm1lv'  =>array(), 
        'm2lv' =>array(), 
        'b1' =>array(), 
        'b2'  =>array(), 
        'b3' =>array(), 
        'b1type' =>array(), 
        'b2type'  =>array(), 
        'b3type' =>array(), 
        'b1lv' =>array(), 
        'b2lv'  =>array(), 
        'b3lv'  =>array()
    );
    function login(){ // ログイン状況を把握
        if($_SESSION['userID'] != "" && $_SESSION['myTB'] != ""){ // ユーザーがログインしていたらそのままユーザー名を返す
            return 'ユーザーID:'.$_SESSION['userID'];
        }
        // 誰もログインしていなかったらMAXデータを設定してユーザー名を返す
        $_SESSION['myTB'] = "H1_2_DefaultDataMax";
        return 'ユーザーID:'.$_SESSION['userID'];
    }

    function addCard(){ // カードデータを表示
        $Dormitory = array("","Heartslabyul","Savanaclaw","Octavinelle","Scarabia","Pomefiore","Ignihyde","Diasomnia");        
            for($i = 0; $i < 4; $i++){
                print '<div class="mcards">';
                /** 写真ファイルアップロード用 */
                print     '<img src="../img/Hobby_1/none.jpg" alt="" width="70.5" height="74.7" id="mcard'.$i.'">';
                /** Lv HP ATK */
                $this->statusBasics($i);
                /** 魔法関連 */
                $this->statusMagic($i);
                /** バディ関連 */
                $this->statusBuddy($i);
                print '</div>';
            }
    }
    function statusBasics($i){
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<td></td>'
                . '<td>Lv1</td>'
                . '<td>無凸MAX</td>'
                . '<td>LvMAX</td>'
            . '</tr>'
            . '<tr>'
                . '<td>Lv</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_lv_one" name="mcard'.$i.'_lv_one" 
                    :seled="1" 
                    :op="opAddCard"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_lv_middle" name="mcard'.$i.'_lv_middle" 
                    :seled="80" 
                    :op="opAddCard"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_lv_max" name="mcard'.$i.'_lv_max" 
                    :seled="100" 
                    :op="opAddCard"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>HP</td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_one" id="mcard'.$i.'_hp_one" value="'.$this->cardData['hp'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_middle" id="mcard'.$i.'_hp_middle" value="'.$this->cardData['hp'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_max" id="mcard'.$i.'_hp_max" value="'.$this->cardData['hp'][$i].'" maxlength="5"></td>'
            . '</tr>'
            . '<tr>'
                . '<td>ATK</td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_one" id="mcard'.$i.'_atk_one" value="'.$this->cardData['atk'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_middle" id="mcard'.$i.'_atk_middle" value="'.$this->cardData['atk'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_max" id="mcard'.$i.'_atk_max" value="'.$this->cardData['atk'][$i].'" maxlength="5"></td>'
            . '</tr>'
            . '</table>';
    }
    function statusMagic($i){
        $Element = array("Nomal.jpg","Fire.jpg","Tree.jpg","Water.jpg");
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<td></td>'
                . '<td>属性</td>'
                . '<td>連撃</td>'
                . '<td>強弱</td>'
                . '<td>追加効果</td>'
            . '</tr>'
            . '<tr>'
                . '<td>Lv1</td>'
                . '<td rowspan="3">'

                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_times_one" name="mcard'.$i.'_m1_times_one" 
                    :seled="1" 
                    :op="opAddM_timas"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_power_one" name="mcard'.$i.'_m1_power_one" 
                    :seled="opAddM_power[0].value" 
                    :op="opAddM_power"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_ef1_one" name="mcard'.$i.'_m1_ef1_one" 
                    :seled="opAddM_effect1[0].value" 
                    :op="opAddM_effect1"></select-own>'
                . '<select-own id="mcard'.$i.'_m1_ef2_one" name="mcard'.$i.'_m1_ef2_one" 
                    :seled="opAddM_effect2[0].value" 
                    :op="opAddM_effect2"></select-own>'
                . '<select-own id="mcard'.$i.'_m1_ef3_one" name="mcard'.$i.'_m1_ef3_one" 
                    :seled="1" 
                    :op="opAddM_effect3"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>Lv5</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_times_five" name="mcard'.$i.'_m1_times_five" 
                    :seled="1" 
                    :op="opAddM_timas"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_power_five" name="mcard'.$i.'_m1_power_five" 
                    :seled="opAddM_power[0].value" 
                    :op="opAddM_power"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_ef1_five" name="mcard'.$i.'_m1_ef1_five" 
                    :seled="opAddM_effect1[0].value" 
                    :op="opAddM_effect1"></select-own>'
                . '<select-own id="mcard'.$i.'_m1_ef2_five" name="mcard'.$i.'_m1_ef2_five" 
                    :seled="opAddM_effect2[0].value" 
                    :op="opAddM_effect2"></select-own>'
                . '<select-own id="mcard'.$i.'_m1_ef3_five" name="mcard'.$i.'_m1_ef3_five" 
                    :seled="1" 
                    :op="opAddM_effect3"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>Lv10</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_times_ten" name="mcard'.$i.'_m1_times_ten" 
                    :seled="1" 
                    :op="opAddM_timas"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_power_ten" name="mcard'.$i.'_m1_power_ten" 
                    :seled="opAddM_power[0].value" 
                    :op="opAddM_power"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m1_ef1_ten" name="mcard'.$i.'_m1_ef1_ten" 
                    :seled="opAddM_effect1[0].value" 
                    :op="opAddM_effect1"></select-own>'
                . '<select-own id="mcard'.$i.'_m1_ef2_ten" name="mcard'.$i.'_m1_ef2_ten" 
                    :seled="opAddM_effect2[0].value" 
                    :op="opAddM_effect2"></select-own>'
                . '<select-own id="mcard'.$i.'_m1_ef3_ten" name="mcard'.$i.'_m1_ef3_ten" 
                    :seled="1" 
                    :op="opAddM_effect3"></select-own>'
                . '</td>'
            . '</tr>'
            . '</table>';
    }
    function statusBuddy($i){
        print '<table border="0">'
            . '<tr>'
                . '<td><img id="mcard'.$i.'_b1" src="../img/Hobby_1/none.jpg" alt="" width="30" height="30"></td>'
                . '<td><img id="mcard'.$i.'_b2" src="../img/Hobby_1/none.jpg" alt="" width="30" height="30"></td>'
                . '<td><img id="mcard'.$i.'_b3" src="../img/Hobby_1/none.jpg" alt="" width="30" height="30"></td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b1_1" name="mcard'.$i.'_b1_1" 
                    :op="opAddB"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_1" name="mcard'.$i.'_b2_1" 
                    :op="opAddB"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b3_1" name="mcard'.$i.'_b3_1" 
                    :op="opAddB"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b1_2" name="mcard'.$i.'_b1_2" 
                    :op="opAddB"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_2" name="mcard'.$i.'_b2_2" 
                    :op="opAddB"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_3" name="mcard'.$i.'_b2_3" 
                    :op="opAddB"></select-own>'
                . '</td>'
            . '</tr>'
            . '</table>';
    }
    function hide($b){
        if($b == 0){
            return 'class="hidden"';
        }else{
            return '';
        }
    }
    function readonly(){
        if($_SESSION['userID'] == ""){
            return ' readonly';
        }else{
            return '';
        }
    }
    function enabled(){
        if($_SESSION['userID'] == ""){
            return ' disabled';
        }else{
            return '';
        }
    }
}