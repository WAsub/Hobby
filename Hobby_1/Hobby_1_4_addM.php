<?php
//データベース定義
define('HOST', 'mysql1.php.xdomain.ne.jp');
define('USR', 'haveabook_user1');
define('PASS', 'waka7ari');
define('DB', 'haveabook_db');
		
class Hobby_1_4_addM{
    function addCard(){ // カードデータを表示
        $Dormitory = array("","Heartslabyul","Savanaclaw","Octavinelle","Scarabia","Pomefiore","Ignihyde","Diasomnia");        
            for($i = 0; $i < 4; $i++){
                print '<div class="mcards">';
                /** 写真ファイルアップロード用 */
                print     '<img src="../img/Hobby_1/'.$Dormitory[(int)$this->cardData['chno'][$i]/10].'/'.$this->cardData['img'][$i].'" alt="'.$this->cardData['chno'][$i].'" width="70.5" height="74.7" id="mcard'.$i.'">';
                /** Lv HP ATK */
                $this->statusBasics($i);
                /** 魔法関連 */
                $this->statusMagic($i);
                /** バディ関連 */
                $this->statusBuddy($i);
                print '</div>';
            }
        print     '<input type="hidden" id="cardlen" value="'.count($this->cardData['cdno']).'">';
    }
    function statusBasics($i){
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<td>Lv1</td>'
                . '<td>無凸MAX</td>'
                . '<td>LvMAX</td>'
            . '</tr>'
            . '<tr>'
                . '<td>Lv</td>'
                . '<td>'
                . '<select-cardlv id="mcard'.$i.'_lv_one" name="mcard'.$i.'_lv_one" disabled></select-cardlv>'
                . '<input id="mcard'.$i.'_lvH" type="hidden" value="'.$this->cardData['lv'][$i].'" '.$this->readonly().'>'
                . '</td>'
                . '<td>'
                . '<select-cardlv id="mcard'.$i.'_lv_middle" name="mcard'.$i.'_lv_middle"></select-cardlv>'
                . '<input id="mcard'.$i.'_lvH" type="hidden" value="'.$this->cardData['lv'][$i].'" '.$this->readonly().'>'
                . '</td>'
                . '<td>'
                . '<select-cardlv id="mcard'.$i.'_lv_max" name="mcard'.$i.'_lv_max"></select-cardlv>'
                . '<input id="mcard'.$i.'_lvH" type="hidden" value="'.$this->cardData['lv'][$i].'" '.$this->readonly().'>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>HP</td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp" id="mcard'.$i.'_hp" value="'.$this->cardData['hp'][$i].'" maxlength="5"'.$this->readonly().'></td>'
            . '</tr>'
            . '<tr>'
                . '<td>ATK</td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk" id="mcard'.$i.'_atk" value="'.$this->cardData['atk'][$i].'" maxlength="5"'.$this->readonly().'></td>'
            . '</tr>'
            . '</table>';
    }
    function statusMagic($i){
        $Element = array("Nomal.jpg","Fire.jpg","Tree.jpg","Water.jpg");
        print '<table border="0" id="THpAtk">'
            . '<tr>'
                . '<td>'
                . '<img id="mcard'.$i.'_m1" src="../img/Hobby_1/Element/'.$Element[substr($this->cardData['m1'][$i],0,1)].'" alt="" width="20" height="20">'
                . '</td>'
                . '<td>Lv</td>'
                . '<td>'
                . '<select-lv id="mcard'.$i.'_m1lv" name="mcard'.$i.'_m1lv" '.$this->enabled().'></select-lv>'
                . '<input id="mcard'.$i.'_m1lvH" type="hidden" value="'.$this->cardData['m1lv'][$i].'" maxlength="2"'.$this->readonly().'>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<img id="mcard'.$i.'_m2" src="../img/Hobby_1/Element/'.$Element[substr($this->cardData['m2'][$i],0,1)].'" alt="" width="20" height="20">'
                . '</td>'
                . '<td>Lv</td>'
                . '<td>'
                . '<select-lv id="mcard'.$i.'_m2lv" name="mcard'.$i.'_m2lv" '.$this->enabled().'></select-lv>'
                . '<input id="mcard'.$i.'_m2lvH" type="hidden" value="'.$this->cardData['m2lv'][$i].'" '.$this->readonly().'>'
                . '</td>'
            . '</tr>'
            . '</table>';
    }
    function statusBuddy($i){
        print '<table border="0">'
            . '<tr>'
                . '<td><img id="mcard'.$i.'_b1" src="../img/Hobby_1/Another/'.$this->cardData['b1'][$i].'.jpg" alt="" width="30" height="30"></td>'
                . '<td><img id="mcard'.$i.'_b2" '.$this->hide($this->cardData['b2'][$i]).' src="../img/Hobby_1/Another/'.$this->cardData['b2'][$i].'.jpg" alt="" width="30" height="30"></td>'
                . '<td><img id="mcard'.$i.'_b3" '.$this->hide($this->cardData['b3'][$i]).' src="../img/Hobby_1/Another/'.$this->cardData['b3'][$i].'.jpg" alt="" width="30" height="30"></td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . 'Lv<select-lvzero id="mcard'.$i.'_b1lv" name="mcard'.$i.'_b1lv" '.$this->enabled().'></select-lvzero>'
                . '<input id="mcard'.$i.'_b1lvH" type="hidden" value="'.$this->cardData['b1lv'][$i].'">'
                . '</td>'
                . '<td>'
                . 'Lv<select-lvzero id="mcard'.$i.'_b2lv" name="mcard'.$i.'_b2lv" '.$this->enabled().'></select-lvzero>'
                . '<input id="mcard'.$i.'_b2lvH" '.$this->hide($this->cardData['b2'][$i]).' type="hidden" value="'.$this->cardData['b2lv'][$i].'">'
                . '</td>'
                . '<td>'
                . 'Lv<select-lvzero id="mcard'.$i.'_b3lv" name="mcard'.$i.'_b3lv" '.$this->enabled().'></select-lvzero>'
                . '<input id="mcard'.$i.'_b3lvH" '.$this->hide($this->cardData['b3'][$i]).' type="hidden" value="'.$this->cardData['b3lv'][$i].'">'
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