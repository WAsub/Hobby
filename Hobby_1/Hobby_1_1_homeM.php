<?php
//データベース定義
        define('HOST', 'mysql1.php.xdomain.ne.jp');
        define('USR', 'haveabook_user1');
        define('PASS', 'waka7ari');
        define('DB', 'haveabook_db');


class Hobby_1_1_homeM{
    private $cdno = array();    private $chno = array();
    private $img = array();
    private $lv = array();
    private $hp = array();    private $atk = array();
    private $m1_1 = array();    private $m2_1 = array();
    private $m1_5 = array();    private $m2_5 = array();
    private $m1_10 = array();    private $m2_10 = array();
    private $m1buf_1 = array();    private $m2buf_1 = array();
    private $m1buf_5 = array();    private $m2buf_5 = array();
    private $m1buf_10 = array();    private $m2buf_10 = array();
    private $m1lv = array();    private $m2lv = array();
    private $b1 = array();    private $b2 = array();    private $b3 = array();//無ければ0
    private $b1type = array();    private $b2type = array();    private $b3type = array();//無ければ0
    private $b1lv = array();    private $b2lv = array();    private $b3lv = array();//無ければ0
    private $hpmax = array();    private $atkmax = array();
    private $m1max = array();
    private $m2max = array();
    private $m1bufmax = array();
    private $m2bufmax = array();
    
    function login(){
        if(isset($_GET['logout'])){
            $_SESSION['userID'] = "";
            $_SESSION['myTB'] = "H1_2_DefaultDataMax";
            return 'ユーザーID:'.$_SESSION['userID'].' <a href="Hobby_1_3_login.php" id="loglink"  target="_blank">ログイン</a>';
        }
        if($_SESSION['userID'] != "" && $_SESSION['myTB'] != ""){
            return 'ユーザーID:'.$_SESSION['userID'].' <a href="Hobby_1_1_home.php?logout='.$_SESSION['userID'].'" id="loglink">ログアウト</a>';
        }        
        $_SESSION['myTB'] = "H1_2_DefaultDataMax";
        return 'ユーザーID:'.$_SESSION['userID'].' <a href="Hobby_1_3_login.php" id="loglink"  target="_blank">ログイン</a>';
    }
    function customlink(){
        if($_SESSION['userID'] == ""){
            return '<a href="Hobby_1_2_custom.php" id="customlink" target="_blank">カードステータス閲覧</a>';
        }else if($_SESSION['userID'] == "wakana"){ // 管理者
            return '<a href="Hobby_1_2_custom.php" id="customlink">カードステータス編集</a><br>
                    <a href="Hobby_1_4_add.php" id="customlink">カード追加</a>';
        }else{
            return '<a href="Hobby_1_2_custom.php" id="customlink">カードステータス編集</a>';
        }
    }
    
    function DBselect(){//TODO
        //データベースサーバに接続
            if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
                die('データベースに接続できません');
            }
        
        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');
        
        //SQL文の作成
        $sql = "SELECT d1.cdno, d1.chno, d1.cimg, d2.lv, d2.hp, d2.atk, ";
        $sql.= "d1.m1_1, d1.m2_1, d1.m1buf_1, d1.m2buf_1, ";
        $sql.= "d1.m1_5, d1.m2_5, d1.m1buf_5, d1.m2buf_5, ";
        $sql.= "d1.m1_10, d1.m2_10, d1.m1buf_10, d1.m2buf_10, ";
        $sql.= "d2.m1lv, d2.m2lv, ";
        $sql.= "d1.b1, d1.b2, d1.b3, d1.b1type, d1.b2type, d1.b3type, d2.b1lv, d2.b2lv, d2.b3lv, ";
        $sql.= "d3.hp, d3.atk ";
        $sql.= "FROM H1_1_CardData AS d1 INNER JOIN ".$_SESSION['myTB']." AS d2 ON d1.cdno = d2.cdno ";
        $sql.=                          "INNER JOIN H1_2_DefaultDataMax AS d3 ON d2.cdno = d3.cdno ";
        $sql.= "ORDER BY d1.cdno ASC";
        
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);            
        if($num > 0){
            //データの取得
            //取り出した値を変数に入れる
            $i = 0;
            mysqli_stmt_bind_result($stmt, $cdN, $chN, $cimg, $clv, $chp, $catk,
                                           $m1_1, $m2_1, $m1b_1, $m2b_1,
                                           $m1_5, $m2_5, $m1b_5, $m2b_5,
                                           $m1_10, $m2_10, $m1b_10, $m2b_10,
                                           $m1lvl, $m2lvl,
                                           $bd1, $bd2, $bd3, $b1T, $b2T, $b3T, $b1lvl, $b2lvl, $b3lvl,
                                           $maxhp, $maxatk);
            while(mysqli_stmt_fetch($stmt)){
                $this->cdno[$i] = $cdN;
                $this->chno[$i] = $chN;
                $this->img[$i] = $cimg;
                $this->lv[$i] = $clv;
                $this->hp[$i] = $chp;
                $this->atk[$i] = $catk;
                $this->m1_1[$i] = $m1_1;
                $this->m2_1[$i] = $m2_1;
                $this->m1_5[$i] = $m1_5;
                $this->m2_5[$i] = $m2_5;
                $this->m1_10[$i] = $m1_10;
                $this->m2_10[$i] = $m2_10;
                $this->m1buf_1[$i] = $m1b_1;
                $this->m2buf_1[$i] = $m2b_1;
                $this->m1buf_5[$i] = $m1b_5;
                $this->m2buf_5[$i] = $m2b_5;
                $this->m1buf_10[$i] = $m1b_10;
                $this->m2buf_10[$i] = $m2b_10;
                $this->m1lv[$i] = $m1lvl;
                $this->m2lv[$i] = $m2lvl;
                $this->b1[$i] = $bd1;
                $this->b2[$i] = $bd2;
                $this->b3[$i] = $bd3;
                $this->b1type[$i] = $b1T;
                $this->b2type[$i] = $b2T;
                $this->b3type[$i] = $b3T;
                $this->b1lv[$i] = $b1lvl;
                $this->b2lv[$i] = $b2lvl;
                $this->b3lv[$i] = $b3lvl;
                $this->hpmax[$i] = $maxhp;
                $this->atkmax[$i] = $maxatk;
                $this->m1max[$i] = $m1_10;
                $this->m1bufmax[$i] = $m1b_10;
                $this->m2max[$i] = $m2_10;
                $this->m2bufmax[$i] = $m2b_10;
                $i++;
            }
        }
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
            
    function printCard(){
        $Dormitory = array("","Heartslabyul","Savanaclaw","Octavinelle","Scarabia","Pomefiore","Ignihyde","Diasomnia","Ramshackle");
        for($i = 0; $i < count($this->cdno); $i++){
            print '<div id="NO'.$this->cdno[$i].'" class="mcards">';
            print     '<img id="mcard'.$i.'" src="../img/Hobby_1/'.$Dormitory[(int)$this->chno[$i]/10].'/'.$this->img[$i].'" alt="'.$this->chno[$i].'" width="70.5" height="74.7" onclick="clickCloseModal(this)">';
//            print     '<img src="../img/Hobby_1/'.$Dormitory[(int)($this->chno[$i]/10)].'/'.(int)($this->chno[$i]/10).'.jpg" alt="'.$this->chno[$i].'" width="75" height="75" id="mcard'.$i.'" draggable="true" ondragstart="dragstart();" ondragover="dragover();">';
//            print     '<img src="../img/Hobby_1/'.$Dormitory[(int)($this->chno[$i]/10)].'/'.(int)($this->chno[$i]/10).'.jpg" alt="'.$this->chno[$i].'" width="75" height="75" id="mcard'.$i.'" onclick="clickCloseModal(this)">';
//            print     '<br><input type="text" readonly="readonly" id="mcard'.$i.'_lbl" value="'.$this->img[$i].'">';
            print     '<input id="mcard'.$i.'_cdno" type="hidden" value="'.$this->cdno[$i].'">';
            print     '<input id="mcard'.$i.'_chno" type="hidden" value="'.$this->chno[$i].'">';
            print     '<input id="mcard'.$i.'_lv" type="hidden" value="'.$this->lv[$i].'">';
            print     '<input id="mcard'.$i.'_hp" type="hidden" value="'.$this->hp[$i].'">';
            print     '<input id="mcard'.$i.'_atk" type="hidden" value="'.$this->atk[$i].'">';
            print     '<input id="mcard'.$i.'_m1_1" type="hidden" value="'.$this->m1_1[$i].'">';
            print     '<input id="mcard'.$i.'_m2_1" type="hidden" value="'.$this->m2_1[$i].'">';
            print     '<input id="mcard'.$i.'_m1_5" type="hidden" value="'.$this->m1_5[$i].'">';
            print     '<input id="mcard'.$i.'_m2_5" type="hidden" value="'.$this->m2_5[$i].'">';
            print     '<input id="mcard'.$i.'_m1_10" type="hidden" value="'.$this->m1_10[$i].'">';
            print     '<input id="mcard'.$i.'_m2_10" type="hidden" value="'.$this->m2_10[$i].'">';
            print     '<input id="mcard'.$i.'_m1buf_1" type="hidden" value="'.$this->m1buf_1[$i].'">';
            print     '<input id="mcard'.$i.'_m2buf_1" type="hidden" value="'.$this->m2buf_1[$i].'">';
            print     '<input id="mcard'.$i.'_m1buf_5" type="hidden" value="'.$this->m1buf_5[$i].'">';
            print     '<input id="mcard'.$i.'_m2buf_5" type="hidden" value="'.$this->m2buf_5[$i].'">';
            print     '<input id="mcard'.$i.'_m1buf_10" type="hidden" value="'.$this->m1buf_10[$i].'">';
            print     '<input id="mcard'.$i.'_m2buf_10" type="hidden" value="'.$this->m2buf_10[$i].'">';
            print     '<input id="mcard'.$i.'_m1lv" type="hidden" value="'.$this->m1lv[$i].'">';
            print     '<input id="mcard'.$i.'_m2lv" type="hidden" value="'.$this->m2lv[$i].'">';
            print     '<input id="mcard'.$i.'_b1" type="hidden" value="'.$this->b1[$i].'">';
            print     '<input id="mcard'.$i.'_b2" type="hidden" value="'.$this->b2[$i].'">';
            print     '<input id="mcard'.$i.'_b3" type="hidden" value="'.$this->b3[$i].'">';
            print     '<input id="mcard'.$i.'_b1type" type="hidden" value="'.$this->b1type[$i].'">';
            print     '<input id="mcard'.$i.'_b2type" type="hidden" value="'.$this->b2type[$i].'">';
            print     '<input id="mcard'.$i.'_b3type" type="hidden" value="'.$this->b3type[$i].'">';
            print     '<input id="mcard'.$i.'_b1lv" type="hidden" value="'.$this->b1lv[$i].'">';
            print     '<input id="mcard'.$i.'_b2lv" type="hidden" value="'.$this->b2lv[$i].'">';
            print     '<input id="mcard'.$i.'_b3lv" type="hidden" value="'.$this->b3lv[$i].'">';
            print     '<input id="mcard'.$i.'_hpmax" type="hidden" value="'.$this->hpmax[$i].'">';
            print     '<input id="mcard'.$i.'_atkmax" type="hidden" value="'.$this->atkmax[$i].'">';
            print     '<input id="mcard'.$i.'_m1max" type="hidden" value="'.$this->m1max[$i].'">';
            print     '<input id="mcard'.$i.'_m2max" type="hidden" value="'.$this->m2max[$i].'">';
            print     '<input id="mcard'.$i.'_m1bufmax" type="hidden" value="'.$this->m1bufmax[$i].'">';
            print     '<input id="mcard'.$i.'_m2bufmax" type="hidden" value="'.$this->m2bufmax[$i].'">';
            print '</div>';
        }
        print     '<input id="cardlen" type="hidden" value="'.count($this->cdno).'">';
    }
    
}