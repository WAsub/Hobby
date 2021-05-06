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
        $Lv = array(80,60,60,40);        
            for($i = 0; $i < 4; $i++){
                print '<div class="mcards">';
                /** 写真ファイルアップロード用 */
                print     '<input-file-own :id="\'mcard'.$i.'\'" :name="\'mcard'.$i.'\'"></input-file-own>';
                /** Lv HP ATK */
                $this->statusBasics($i, $Lv[$i]);
                /** 魔法関連 */
                $this->statusMagic($i, "1");
                $this->statusMagic($i, "2");
                /** バディ関連 */
                $this->statusBuddy($i);
                print '</div>';
            }
    }
    function statusBasics($i, $Lv){
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<th></th>'
                . '<td>Lv1</td>'
                . '<td>無凸MAX</td>'
                . '<td>LvMAX</td>'
            . '</tr>'
            . '<tr>'
                . '<th>Lv</th>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_lv_one" name="mcard'.$i.'_lv_one" 
                    :initial="1" 
                    :op="\'opAddCard\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_lv_middle" name="mcard'.$i.'_lv_middle" 
                    :initial="'.$Lv.'" 
                    :op="\'opAddCard\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_lv_max" name="mcard'.$i.'_lv_max" 
                    :initial="'.($Lv+20).'" 
                    :op="\'opAddCard\'"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<th>HP</th>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_one" id="mcard'.$i.'_hp_one" value="'.$this->cardData['hp'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_middle" id="mcard'.$i.'_hp_middle" value="'.$this->cardData['hp'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_max" id="mcard'.$i.'_hp_max" value="'.$this->cardData['hp'][$i].'" maxlength="5"></td>'
            . '</tr>'
            . '<tr>'
                . '<th>ATK</th>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_one" id="mcard'.$i.'_atk_one" value="'.$this->cardData['atk'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_middle" id="mcard'.$i.'_atk_middle" value="'.$this->cardData['atk'][$i].'" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_max" id="mcard'.$i.'_atk_max" value="'.$this->cardData['atk'][$i].'" maxlength="5"></td>'
            . '</tr>'
            . '</table>';
    }
    function statusMagic($i, $M){
        $Element = array("Nomal.jpg","Fire.jpg","Tree.jpg","Water.jpg");
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<th>M'.$M.'</th>'
                . '<td>Lv1</td>'
                . '<td>Lv5</td>'
                . '<td>Lv10</td>'
            . '</tr>'
            . '<tr>'
                . '<th>属性</th>'
                . '<td colspan="3">'
                . '<radio-element :id="\'mcard'.$i.'_m'.$M.'_element\'" :name="\'mcard'.$i.'_m'.$M.'_element\'"></radio-element>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<th>連撃</th>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_times_one" name="mcard'.$i.'_m'.$M.'_times_one" 
                    :initial="1" 
                    :op="\'opAddM_timas\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_times_five" name="mcard'.$i.'_m'.$M.'_times_five" 
                    :initial="1" 
                    :op="\'opAddM_timas\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_times_ten" name="mcard'.$i.'_m'.$M.'_times_ten" 
                    :initial="1" 
                    :op="\'opAddM_timas\'"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<th>強弱</th>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_power_one" name="mcard'.$i.'_m'.$M.'_power_one" 
                    :initial="\'S\'" 
                    :op="\'opAddM_power\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_power_five" name="mcard'.$i.'_m'.$M.'_power_five" 
                    :initial="\'S\'" 
                    :op="\'opAddM_power\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_power_ten" name="mcard'.$i.'_m'.$M.'_power_ten" 
                    :initial="\'S\'" 
                    :op="\'opAddM_power\'"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<th><p>追加効果</p></th>'
                . '<td class="effect">'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef1_one" name="mcard'.$i.'_m'.$M.'_ef1_one" 
                    :initial="\'nN\'" 
                    :op="\'opAddM_effect1\'"></select-own><br>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef2_one" name="mcard'.$i.'_m'.$M.'_ef2_one" 
                    :op="\'opAddM_effect2\'"></select-own>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef3_one" name="mcard'.$i.'_m'.$M.'_ef3_one" 
                    :op="\'opAddM_effect3\'"></select-own>'
                . '<span class="duoimg"><img-select :id="\'mcard'.$i.'_m'.$M.'_duo_one\'"></img-select></span>'
                . '</td>'
                . '<td class="effect">'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef1_five" name="mcard'.$i.'_m'.$M.'_ef1_five" 
                    :initial="\'nN\'" 
                    :op="\'opAddM_effect1\'"></select-own><br>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef2_five" name="mcard'.$i.'_m'.$M.'_ef2_five" 
                    :op="\'opAddM_effect2\'"></select-own>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef3_five" name="mcard'.$i.'_m'.$M.'_ef3_five" 
                    :op="\'opAddM_effect3\'"></select-own>'
                . '<span class="duoimg"><img-select :id="\'mcard'.$i.'_m'.$M.'_duo_five\'"></img-select></span>'
                . '</td>'
                . '<td class="effect">'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef1_ten" name="mcard'.$i.'_m'.$M.'_ef1_ten" 
                    :initial="\'nN\'" 
                    :op="\'opAddM_effect1\'"></select-own><br>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef2_ten" name="mcard'.$i.'_m'.$M.'_ef2_ten" 
                    :op="\'opAddM_effect2\'"></select-own>'
                . '<select-own id="mcard'.$i.'_m'.$M.'_ef3_ten" name="mcard'.$i.'_m'.$M.'_ef3_ten" 
                    :op="\'opAddM_effect3\'"></select-own>'
                . '<span class="duoimg"><img-select :id="\'mcard'.$i.'_m'.$M.'_duo_ten\'"></img-select></span>'
                . '</td>'
            . '</tr>'
            . '</table>';
    }
    function statusBuddy($i){
        print '<table border="0">'
            . '<tr>'
                . '<td class="Bimg"><img-select :id="\'mcard'.$i.'_b1\'"></img-select></td>'
                . '<td class="Bimg"><img-select :id="\'mcard'.$i.'_b2\'"></img-select></td>'
                . '<td class="Bimg"><img-select :id="\'mcard'.$i.'_b3\'"></img-select></td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b1_1" name="mcard'.$i.'_b1_1" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_1" name="mcard'.$i.'_b2_1" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b3_1" name="mcard'.$i.'_b3_1" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b1_2" name="mcard'.$i.'_b1_2" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_2" name="mcard'.$i.'_b2_2" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_3" name="mcard'.$i.'_b2_3" 
                    :op="\'opAddB\'"></select-own>'
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