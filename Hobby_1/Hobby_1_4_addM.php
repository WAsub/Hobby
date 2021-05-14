<?php
//データベース定義
define('HOST', 'mysql1.php.xdomain.ne.jp');
define('USR', 'haveabook_user1');
define('PASS', 'waka7ari');
define('DB', 'haveabook_db');
		
class Hobby_1_4_addM{
    private $addData = array();

    function login(){ // ログイン状況を把握
        if($_SESSION['userID'] != "" && $_SESSION['myTB'] != ""){ // ユーザーがログインしていたらそのままユーザー名を返す
            return 'ユーザーID:'.$_SESSION['userID'];
        }
        // 誰もログインしていなかったらMAXデータを設定してユーザー名を返す
        $_SESSION['myTB'] = "H1_2_DefaultDataMax";
        return 'ユーザーID:'.$_SESSION['userID'];
    }
    function DataPOST(){ // 更新データを配列に入れる
        if(isset($_POST["submit"]) && $_POST["submit"] == "更新") {
            // /** リクエストボディを直接参照 
            //  *  △△△△=○○○○&△△△△=○○○○&△△△△=○○○○&△△△△=○○○○ */
            // $input = file_get_contents('php://input');
            // /** &で分割
            //  *  △△△△=○○○○ △△△△=○○○○ △△△△=○○○○ △△△△=○○○○ */
            // foreach(explode('&', trim($input)) as $value){
            //     /** =で分割
            //      *  △△△△ ○○○○ */
            //     $DATA = explode('=', trim($value));
            //     /** 一番最初の更新ボタンのデータはスキップ */
            //     if($DATA[0] == "submit"){ continue;}
            //     /** nameを引数に、データを格納 */
            //     $this->addData[$DATA[0]] = $DATA[1];
            // }
            foreach($_POST as $key => $value){
                $this->addData[$key] = $value;
            }
            foreach($_FILES as $key => $value){
                $this->addData[$key] = $value["name"];
            }

            return $this->addData;
        }         
    }
    function getMaxCdno(){
        $max = 0;
        //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
        }
        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');
        //SQL文の作成
        $sql = "SELECT MAX(cdno) FROM H1_1_CardData";
        //ステートメントン実行準備
        $stmt = mysqli_prepare($conn, $sql);
        //SQLステートメントの実行
        mysqli_stmt_execute($stmt); 
        mysqli_stmt_store_result($stmt);
        $num = mysqli_stmt_num_rows($stmt);            
        if($num > 0){
            //データの取得
            //取り出した値を変数に入れる
            mysqli_stmt_bind_result($stmt, $maxno);
            mysqli_stmt_fetch($stmt);
            $max = $maxno;
        }
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        return $max;
    }
    function DBinsert(){ // ユーザデータ更新
        if(isset($_POST["submit"]) && $_POST["submit"] == "更新") {  
            $msg = array();
            // データをaddDataに格納
            $this->DataPOST();
            $maxno = $this->getMaxCdno();
            $maxno++;
            $Dormitory = array("","Heartslabyul","Savanaclaw","Octavinelle","Scarabia","Pomefiore","Ignihyde","Diasomnia","Ramshackle");
            for($i = 0; $i < 4; $i++){
                if($this->addData['mcard'.$i.'_cdno'] == ""){
                    $this->addData['mcard'.$i.'_cdno'] = $maxno;
                    $maxno++;
                }
                $tempfile = $_FILES['mcard'.$i]['tmp_name'];
                $filename = '../img/Hobby_1/'.$Dormitory[(int)$this->addData['mcard'.$i.'_chno']/10].'/' . $_FILES['mcard'.$i]['name'];
                if (is_uploaded_file($tempfile)) {
                    if ( move_uploaded_file($tempfile , $filename )) {
                        $msg["file".$i] = $filename . "をアップロードしました。";
                    } else {
                        $msg["file".$i] = "ファイルをアップロードできません。";
                    }
                } else {
                    $msg["file".$i] = "ファイルが選択されていません。";
                } 
            }
            
            //データベースサーバに接続
            if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
                die('データベースに接続できません');
            }
            //クエリの文字コードを設定
            mysqli_set_charset($conn, 'utf8');
            //SQL文の作成
            $sql[0] = "INSERT INTO H1_1_CardData VALUE (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $sql[1] = "INSERT INTO H1_2_DefaultData VALUE (?,?,?,?,?,?,?,?,?)";
            $sql[2] = "INSERT INTO H1_2_DefaultDataMiddle VALUE (?,?,?,?,?,?,?,?,?)";
            $sql[3] = "INSERT INTO H1_2_DefaultDataMax VALUE (?,?,?,?,?,?,?,?,?)";

            for($i = 0; $i < 4; $i++){
                if($this->addData['mcard'.$i.'_chno'] == ""){
                    continue;
                }
                for($j = 0; $j < 5; $j++){
                    switch($j){
                        case 0:
                            $m1_1 = $this->addData['mcard'.$i.'_m1_element'].$this->addData['mcard'.$i.'_m1_power_one'].$this->addData['mcard'.$i.'_m1_times_one'];
                            $m1buf_1 = $this->addData['mcard'.$i.'_m1_ef1_1_one'].$this->addData['mcard'.$i.'_m1_ef2_1_one'].$this->addData['mcard'.$i.'_m1_ef3_1_one'].$this->addData['mcard'.$i.'_m1_duo_one'].$this->addData['mcard'.$i.'_m1_ef1_2_one'].$this->addData['mcard'.$i.'_m1_ef2_2_one'].$this->addData['mcard'.$i.'_m1_ef3_2_one'];
                            $m2_1 = $this->addData['mcard'.$i.'_m2_element'].$this->addData['mcard'.$i.'_m2_power_one'].$this->addData['mcard'.$i.'_m2_times_one'];
                            $m2buf_1 = $this->addData['mcard'.$i.'_m2_ef1_1_one'].$this->addData['mcard'.$i.'_m2_ef2_1_one'].$this->addData['mcard'.$i.'_m2_ef3_1_one'].$this->addData['mcard'.$i.'_m2_duo_one'].$this->addData['mcard'.$i.'_m2_ef1_2_one'].$this->addData['mcard'.$i.'_m2_ef2_2_one'].$this->addData['mcard'.$i.'_m2_ef3_2_one'];
                            
                            $m1_5 = $this->addData['mcard'.$i.'_m1_element'].$this->addData['mcard'.$i.'_m1_power_five'].$this->addData['mcard'.$i.'_m1_times_five'];
                            $m1buf_5 = $this->addData['mcard'.$i.'_m1_ef1_1_five'].$this->addData['mcard'.$i.'_m1_ef2_1_five'].$this->addData['mcard'.$i.'_m1_ef3_1_five'].$this->addData['mcard'.$i.'_m1_duo_five'].$this->addData['mcard'.$i.'_m1_ef1_2_five'].$this->addData['mcard'.$i.'_m1_ef2_2_five'].$this->addData['mcard'.$i.'_m1_ef3_2_five'];
                            $m2_5 = $this->addData['mcard'.$i.'_m2_element'].$this->addData['mcard'.$i.'_m2_power_five'].$this->addData['mcard'.$i.'_m2_times_five'];
                            $m2buf_5 = $this->addData['mcard'.$i.'_m2_ef1_1_five'].$this->addData['mcard'.$i.'_m2_ef2_1_five'].$this->addData['mcard'.$i.'_m2_ef3_1_five'].$this->addData['mcard'.$i.'_m2_duo_five'].$this->addData['mcard'.$i.'_m2_ef1_2_five'].$this->addData['mcard'.$i.'_m2_ef2_2_five'].$this->addData['mcard'.$i.'_m2_ef3_2_five'];
                            
                            $m1_10 = $this->addData['mcard'.$i.'_m1_element'].$this->addData['mcard'.$i.'_m1_power_ten'].$this->addData['mcard'.$i.'_m1_times_ten'];
                            $m1buf_10 = $this->addData['mcard'.$i.'_m1_ef1_1_ten'].$this->addData['mcard'.$i.'_m1_ef2_1_ten'].$this->addData['mcard'.$i.'_m1_ef3_1_ten'].$this->addData['mcard'.$i.'_m1_duo_ten'].$this->addData['mcard'.$i.'_m1_ef1_2_ten'].$this->addData['mcard'.$i.'_m1_ef2_2_ten'].$this->addData['mcard'.$i.'_m1_ef3_2_ten'];
                            $m2_10 = $this->addData['mcard'.$i.'_m2_element'].$this->addData['mcard'.$i.'_m2_power_ten'].$this->addData['mcard'.$i.'_m2_times_ten'];
                            $m2buf_10 = $this->addData['mcard'.$i.'_m2_ef1_1_ten'].$this->addData['mcard'.$i.'_m2_ef2_1_ten'].$this->addData['mcard'.$i.'_m2_ef3_1_ten'].$this->addData['mcard'.$i.'_m2_duo_ten'].$this->addData['mcard'.$i.'_m2_ef1_2_ten'].$this->addData['mcard'.$i.'_m2_ef2_2_ten'].$this->addData['mcard'.$i.'_m2_ef3_2_ten'];

                            $b1type = $this->addData['mcard'.$i.'_b1_1'].$this->addData['mcard'.$i.'_b1_2'];
                            $b2type = $this->addData['mcard'.$i.'_b2_1'].$this->addData['mcard'.$i.'_b2_2'];
                            $b3type = $this->addData['mcard'.$i.'_b3_1'].$this->addData['mcard'.$i.'_b3_2'];

                            $stmt = mysqli_prepare($conn, $sql[$j]);
                            mysqli_stmt_bind_param($stmt, 'iisssssssssssssisisis', 
                                $this->addData['mcard'.$i.'_cdno'], $this->addData['mcard'.$i.'_chno'], $this->addData['mcard'.$i], 
                                $m1_1, $m1buf_1, $m2_1, $m2buf_1,  $m1_5, $m1buf_5, $m2_5, $m2buf_5,  $m1_10, $m1buf_10, $m2_10, $m2buf_10,
                                $this->addData['mcard'.$i.'_b1'], $b1type,  $this->addData['mcard'.$i.'_b2'], $b2type,  $this->addData['mcard'.$i.'_b3'], $b3type
                            );
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) > 0){
                                $msg['cardData'.$i] = "完了しました。";	
                            }
                            break;
                        case 1:
                            $mlv = 1; $b1lv = 1;
                            $b2lv = $this->addData['mcard'.$i.'_b2'] == "" ? 0 : 1;
                            $b3lv = $this->addData['mcard'.$i.'_b3'] == "" ? 0 : 1;
                            $stmt = mysqli_prepare($conn, $sql[$j]);
                            mysqli_stmt_bind_param($stmt, 'iiiiiiiii', 
                                $this->addData['mcard'.$i.'_cdno'], $this->addData['mcard'.$i.'_lv_one'], $this->addData['mcard'.$i.'_hp_one'], $this->addData['mcard'.$i.'_atk_one'],
                                $mlv, $mlv, $b1lv, $b2lv, $b3lv
                            );
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) > 0){
                                $msg['default'.$i] = "完了しました。";		
                            }
                            break;
                        case 2:
                            $mlv = 5; $b1lv = 5;
                            $b2lv = $this->addData['mcard'.$i.'_b2'] == "" ? 0 : 5;
                            $b3lv = $this->addData['mcard'.$i.'_b3'] == "" ? 0 : 5;
                            $stmt = mysqli_prepare($conn, $sql[$j]);
                            mysqli_stmt_bind_param($stmt, 'iiiiiiiii', 
                                $this->addData['mcard'.$i.'_cdno'], $this->addData['mcard'.$i.'_lv_middle'], $this->addData['mcard'.$i.'_hp_middle'], $this->addData['mcard'.$i.'_atk_middle'],
                                $mlv, $mlv, $b1lv, $b2lv, $b3lv
                            );
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) > 0){
                                $msg['defaultmiddle'.$i] = "完了しました。";
                            }
                            break;
                        case 3:
                            $mlv = 10; $b1lv = 10;
                            $b2lv = $this->addData['mcard'.$i.'_b2'] == "" ? 0 : 10;
                            $b3lv = $this->addData['mcard'.$i.'_b3'] == "" ? 0 : 10;
                            $stmt = mysqli_prepare($conn, $sql[$j]);
                            mysqli_stmt_bind_param($stmt, 'iiiiiiiii', 
                                $this->addData['mcard'.$i.'_cdno'], $this->addData['mcard'.$i.'_lv_max'], $this->addData['mcard'.$i.'_hp_max'], $this->addData['mcard'.$i.'_atk_max'],
                                $mlv, $mlv, $b1lv, $b2lv, $b3lv
                            );
                            mysqli_stmt_execute($stmt);
                            if(mysqli_stmt_affected_rows($stmt) > 0){
                                $msg['defaultmax'.$i] = "完了しました。";	
                            }
                            break;
                        case 4:
                            $userbase = $this->getUserTableName();
                            $lv = 0;
                            $mlv = 1; $b1lv = 1;
                            $b2lv = $this->addData['mcard'.$i.'_b2'] == "" ? 0 : 1;
                            $b3lv = $this->addData['mcard'.$i.'_b3'] == "" ? 0 : 1;
                            for($k = 0; $k < count($userbase); $k++){
                                $table = $userbase[$k];
                                $usersql = "INSERT INTO $table VALUE (?,?,?,?,?,?,?,?,?)";
                                $stmt = mysqli_prepare($conn, $usersql);
                                mysqli_stmt_bind_param($stmt, 'iiiiiiiii', 
                                    $this->addData['mcard'.$i.'_cdno'], $lv, $this->addData['mcard'.$i.'_hp_one'], $this->addData['mcard'.$i.'_atk_one'],
                                    $mlv, $mlv, $b1lv, $b2lv, $b3lv
                                );
                                mysqli_stmt_execute($stmt);
                                if(mysqli_stmt_affected_rows($stmt) > 0){
                                    $msg['user'.$k.$i] = "完了しました。";	
                                }
                            }
                            break;
                    }
                }
            }
            //データベースの接続を閉じる
            mysqli_stmt_free_result($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        return $msg;
    }
    function getUserTableName(){
        $item = array();
        //データベースサーバに接続
        if (!$conn = mysqli_connect(HOST, USR, PASS, DB)) {
            die('データベースに接続できません');
        }
        //クエリの文字コードを設定
        mysqli_set_charset($conn, 'utf8');
        //SQL文の作成
        $sql = "SELECT CONCAT(mybase, Dno) FROM H1_4_Users";
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
            mysqli_stmt_bind_result($stmt, $mybase);
            while(mysqli_stmt_fetch($stmt)){
                $item[$i] = $mybase;
                $i++;
            }
        }
        //データベースの接続を閉じる
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $item;
    }
    function addCard(){ // カードデータを表示
        $Dormitory = array("","Heartslabyul","Savanaclaw","Octavinelle","Scarabia","Pomefiore","Ignihyde","Diasomnia");
        $Lv = array(80,60,60,40);        
            for($i = 0; $i < 4; $i++){
                print '<div class="mcards">';
                /** 写真ファイルアップロード用 */
                print     '<div class="file">';
                print     '<input-file-own :id="\'mcard'.$i.'\'" :name="\'mcard'.$i.'\'"></input-file-own>';
                print     '<span class="no">';
                print     'カードNo<input type="text" name="mcard'.$i.'_cdno" id="mcard'.$i.'_cdno" value="" maxlength="4">';
                print     '<span class="Bimg"><img-select :id_name="\'mcard'.$i.'_chno\'"></img-select></span>';
                print     '</span></div>';
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
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_one" id="mcard'.$i.'_hp_one" value="" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_middle" id="mcard'.$i.'_hp_middle" value="" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_hp_max" id="mcard'.$i.'_hp_max" value="" maxlength="5"></td>'
            . '</tr>'
            . '<tr>'
                . '<th>ATK</th>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_one" id="mcard'.$i.'_atk_one" value="" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_middle" id="mcard'.$i.'_atk_middle" value="" maxlength="5"></td>'
                . '<td><input type="text" class="mdata" name="mcard'.$i.'_atk_max" id="mcard'.$i.'_atk_max" value="" maxlength="5"></td>'
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
                . '<th rowspan="2"><p>追加効果</p></th>'
                . '<td class="effect">'
                . '<select-effect 
                    :id_name="[
                        \'mcard'.$i.'_m'.$M.'_ef1_1_one\',
                        \'mcard'.$i.'_m'.$M.'_ef2_1_one\',
                        \'mcard'.$i.'_m'.$M.'_ef3_1_one\',
                        \'mcard'.$i.'_m'.$M.'_duo_one\'
                    ]"></select-effect>'
                . '</td>'
                . '<td class="effect">'
                . '<select-effect 
                    :id_name="[
                        \'mcard'.$i.'_m'.$M.'_ef1_1_five\',
                        \'mcard'.$i.'_m'.$M.'_ef2_1_five\',
                        \'mcard'.$i.'_m'.$M.'_ef3_1_five\',
                        \'mcard'.$i.'_m'.$M.'_duo_five\'
                    ]"></select-effect>'
                . '</td>'
                . '<td class="effect">'
                . '<select-effect 
                    :id_name="[
                        \'mcard'.$i.'_m'.$M.'_ef1_1_ten\',
                        \'mcard'.$i.'_m'.$M.'_ef2_1_ten\',
                        \'mcard'.$i.'_m'.$M.'_ef3_1_ten\',
                        \'mcard'.$i.'_m'.$M.'_duo_ten\'
                    ]"></select-effect>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td class="effect">'
                . '<select-effect2 
                    :id_name="[
                        \'mcard'.$i.'_m'.$M.'_ef1_2_one\',
                        \'mcard'.$i.'_m'.$M.'_ef2_2_one\',
                        \'mcard'.$i.'_m'.$M.'_ef3_2_one\'
                    ]"></select-effect>'
                . '</td>'
                . '<td class="effect">'
                . '<select-effect2 
                    :id_name="[
                        \'mcard'.$i.'_m'.$M.'_ef1_2_five\',
                        \'mcard'.$i.'_m'.$M.'_ef2_2_five\',
                        \'mcard'.$i.'_m'.$M.'_ef3_2_five\'
                    ]"></select-effect>'
                . '</td>'
                . '<td class="effect">'
                . '<select-effect2 
                    :id_name="[
                        \'mcard'.$i.'_m'.$M.'_ef1_2_ten\',
                        \'mcard'.$i.'_m'.$M.'_ef2_2_ten\',
                        \'mcard'.$i.'_m'.$M.'_ef3_2_ten\'
                    ]"></select-effect>'
                . '</td>'
            . '</tr>'
            . '</table>';
    }
    function statusBuddy($i){
        print '<table border="0">'
            . '<tr>'
                . '<td class="Bimg"><img-select :id_name="\'mcard'.$i.'_b1\'"></img-select></td>'
                . '<td class="Bimg"><img-select :id_name="\'mcard'.$i.'_b2\'"></img-select></td>'
                . '<td class="Bimg"><img-select :id_name="\'mcard'.$i.'_b3\'"></img-select></td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b1_1" name="mcard'.$i.'_b1_1" 
                    :initial="\'\'" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_1" name="mcard'.$i.'_b2_1" 
                    :initial="\'\'" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b3_1" name="mcard'.$i.'_b3_1" 
                    :initial="\'\'" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
            . '</tr>'
            . '<tr>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b1_2" name="mcard'.$i.'_b1_2" 
                    :initial="\'\'" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_2" name="mcard'.$i.'_b2_2" 
                    :initial="\'\'" 
                    :op="\'opAddB\'"></select-own>'
                . '</td>'
                . '<td>'
                . '<select-own id="mcard'.$i.'_b2_3" name="mcard'.$i.'_b2_3" 
                    :initial="\'\'" 
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