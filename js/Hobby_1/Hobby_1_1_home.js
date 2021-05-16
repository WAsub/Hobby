//******************************************************************************
function getElByID(id){
    return document.getElementById(id);
}
//****************************************************************************//
function stop(){ event.stopPropagation();}
/** モーダルの開閉 */
function clickOpenModal(obj){
    getElByID("overlay").className = "";
    getElByID("modal").className = "";
    getElByID("target").value = obj.id;
}
function clickCloseModal(obj){
    getElByID("overlay").className = "hidden";
    getElByID("modal").className = "hidden";
    
    if(obj.id == "overlay"){
        return;
    }
    var id = getElByID("target").value;
    
    apply(obj.id, id);
    changeMbufty();
    changeValue();
    damage();
    totalD();
    totalHP();
}
/******************************************************************************/
/** カードをセットする */
function apply(fromId, toID){
    var Bimg = {
        11: '11.jpg', 12: '12.jpg', 13: '13.jpg', 14: '14.jpg', 15: '15.jpg',
        21: '21.jpg', 22: '22.jpg', 23: '23.jpg',
        31: '31.jpg', 32: '32.jpg', 33: '33.jpg',
        41: '41.jpg', 42: '42.jpg',
        51: '51.jpg', 52: '52.jpg', 53: '53.jpg',
        61: '61.jpg', 62: '62.jpg',
        71: '71.jpg', 72: '72.jpg', 73: '73.jpg', 74: '74.jpg',
        82: '82.jpg'
    };
    var Bty = {
        H: 'H', A: 'A',
        s: '(小)', m: '(中)',
        undefined: '**'
    };
    var Mcolor = ["#f8fbf8", "#ea5506", "#c3d825", "#0094c8"];
    //データ書き換え
    getElByID(toID).src = getElByID(fromId).src;   
    getElByID(toID + "_cdno").value = getElByID(fromId + "_cdno").value;
    getElByID(toID + "_chno").value = getElByID(fromId + "_chno").value;
    getElByID(toID + "_lv").value = getElByID(fromId + "_lv").value;
    getElByID(toID + "_hp").value = getElByID(fromId + "_hp").value;
    getElByID(toID + "_atk").value = getElByID(fromId + "_atk").value;
    getElByID(toID + "_m1_1").value = getElByID(fromId + "_m1_1").value;
    getElByID(toID + "_m2_1").value = getElByID(fromId + "_m2_1").value;
    getElByID(toID + "_m1_5").value = getElByID(fromId + "_m1_5").value;
    getElByID(toID + "_m2_5").value = getElByID(fromId + "_m2_5").value;
    getElByID(toID + "_m1_10").value = getElByID(fromId + "_m1_10").value;
    getElByID(toID + "_m2_10").value = getElByID(fromId + "_m2_10").value;
    getElByID(toID + "_m1buf_1").value = getElByID(fromId + "_m1buf_1").value;
    getElByID(toID + "_m2buf_1").value = getElByID(fromId + "_m2buf_1").value;
    getElByID(toID + "_m1buf_5").value = getElByID(fromId + "_m1buf_5").value;
    getElByID(toID + "_m2buf_5").value = getElByID(fromId + "_m2buf_5").value;
    getElByID(toID + "_m1buf_10").value = getElByID(fromId + "_m1buf_10").value;
    getElByID(toID + "_m2buf_10").value = getElByID(fromId + "_m2buf_10").value;
    getElByID(toID + "_m1lv").value = getElByID(fromId + "_m1lv").value;
    getElByID(toID + "_m2lv").value = getElByID(fromId + "_m2lv").value;
    getElByID(toID + "_TMagic1").style.backgroundColor = Mcolor[getElByID(fromId + "_m1_1").value[0]];
    getElByID(toID + "_TMagic2").style.backgroundColor = Mcolor[getElByID(fromId + "_m2_1").value[0]];
    getElByID(toID + "_b1").value = getElByID(fromId + "_b1").value;
    getElByID(toID + "_b2").value = getElByID(fromId + "_b2").value;
    getElByID(toID + "_b3").value = getElByID(fromId + "_b3").value;
    var Btype1 = getElByID(fromId + "_b1type").value;
    var Btype2 = getElByID(fromId + "_b2type").value;
    var Btype3 = getElByID(fromId + "_b3type").value;
    getElByID(toID + "_b1type").value = Btype1;
    getElByID(toID + "_b2type").value = Btype2;
    getElByID(toID + "_b3type").value = Btype3;
    getElByID(toID + "_b1ty").innerHTML = Bty[Btype1[0]]+Bty[Btype1[1]]+"<br>"+Bty[Btype1[2]]+Bty[Btype1[3]];
    getElByID(toID + "_b2ty").innerHTML = Bty[Btype2[0]]+Bty[Btype2[1]]+"<br>"+Bty[Btype2[2]]+Bty[Btype2[3]];
    getElByID(toID + "_b3ty").innerHTML = Bty[Btype3[0]]+Bty[Btype3[1]]+"<br>"+Bty[Btype3[2]]+Bty[Btype3[3]];
    getElByID(toID + "_b1lv").value = getElByID(fromId + "_b1lv").value;
    getElByID(toID + "_b2lv").value = getElByID(fromId + "_b2lv").value;
    getElByID(toID + "_b3lv").value = getElByID(fromId + "_b3lv").value;
    getElByID(toID + "_hpmiddle").value = getElByID(fromId + "_hpmiddle").value;
    getElByID(toID + "_atkmiddle").value = getElByID(fromId + "_atkmiddle").value;
    getElByID(toID + "_hpmax").value = getElByID(fromId + "_hpmax").value;
    getElByID(toID + "_atkmax").value = getElByID(fromId + "_atkmax").value;
    getElByID(toID + "_budy1").style.backgroundImage = 'url(../img/Hobby_1/Another/'+ Bimg[getElByID(fromId + "_b1").value] +')';
    getElByID(toID + "_budy2").style.backgroundImage = 'url(../img/Hobby_1/Another/'+ Bimg[getElByID(fromId + "_b2").value] +')';
    getElByID(toID + "_budy3").style.backgroundImage = 'url(../img/Hobby_1/Another/'+ Bimg[getElByID(fromId + "_b3").value] +')';
    getElByID(toID + "_budy1").src = '../img/Hobby_1/RED.png';
    getElByID(toID + "_budy2").src = '../img/Hobby_1/RED.png';
    getElByID(toID + "_budy3").src = '../img/Hobby_1/RED.png';
    
    // for(var i = 1; i <= 5; i++){//max
    //     if(getElByID("card"+i+"_max").checked){
    //         getElByID("card"+i+"_hp").value = getElByID("card"+i+"_hpmax").value;
    //         getElByID("card"+i+"_atk").value = getElByID("card"+i+"_atkmax").value;
    //         getElByID("card"+i+"_m1lv").value = 10;
    //         getElByID("card"+i+"_m2lv").value = 10;
    //         getElByID("card"+i+"_b1lv").value = 10;
    //         getElByID("card"+i+"_b2lv").value = 10;
    //         getElByID("card"+i+"_b3lv").value = 10;
    //     }
    // }
}
/******************************************************************************/
/** ソートモーダル開閉 */
function clickOpenSortModal(){
    getElByID("overlaySort").className = "";
    getElByID("modalSort").className = "";
}
function clickCloseSortModal(){
    getElByID("overlaySort").className = "hidden";
    getElByID("modalSort").className = "hidden";
}
/******************************************************************************/
/** チェックボックス"最大値" */
function clickMAX(obj){
        if(obj.className == "max"){
            getElByID(obj.value+"_hp").value = getElByID(obj.value+"_hpmax").value;
            getElByID(obj.value+"_atk").value = getElByID(obj.value+"_atkmax").value;
            getElByID(obj.value+"_m1lv").value = 10;
            getElByID(obj.value+"_m2lv").value = 10;
            getElByID(obj.value+"_b1lv").value = 10;
            getElByID(obj.value+"_b2lv").value = 10;
            getElByID(obj.value+"_b3lv").value = 10;
        }else{
            getElByID(obj.value+"_hp").value = getElByID(obj.value+"_hpmiddle").value;
            getElByID(obj.value+"_atk").value = getElByID(obj.value+"_atkmiddle").value;
            getElByID(obj.value+"_m1lv").value = 5;
            getElByID(obj.value+"_m2lv").value = 5;
            getElByID(obj.value+"_b1lv").value = 10;
            getElByID(obj.value+"_b2lv").value = 10;
            getElByID(obj.value+"_b3lv").value = 10;      
        }
    changeMbufty();
    changeValue();
    damage();
    totalD();
    totalHP();
}
/** MLv操作のプルダウンリスト */
function clickMLvChange(){
    // for(var i = 1; i <= 5; i++){//max
    //     if(getElByID("card"+i+"_max").checked){
    //         getElByID("card"+i+"_hp").value = getElByID("card"+i+"_hpmax").value;
    //         getElByID("card"+i+"_atk").value = getElByID("card"+i+"_atkmax").value;
    //         getElByID("card"+i+"_m1lv").value = 10;
    //         getElByID("card"+i+"_m2lv").value = 10;
    //         getElByID("card"+i+"_b1lv").value = 10;
    //         getElByID("card"+i+"_b2lv").value = 10;
    //         getElByID("card"+i+"_b3lv").value = 10;
    //     }
    // }
    changeMbufty();
    changeValue();
    damage();
    totalD();
    totalHP();
}
/** バフデバフのチェックボックス切り替え */
function clickChange(){
    // for(var i = 1; i <= 5; i++){//max
    //     if(getElByID("card"+i+"_max").checked){
    //         getElByID("card"+i+"_hp").value = getElByID("card"+i+"_hpmax").value;
    //         getElByID("card"+i+"_atk").value = getElByID("card"+i+"_atkmax").value;
    //         getElByID("card"+i+"_m1lv").value = 10;
    //         getElByID("card"+i+"_m2lv").value = 10;
    //         getElByID("card"+i+"_b1lv").value = 10;
    //         getElByID("card"+i+"_b2lv").value = 10;
    //         getElByID("card"+i+"_b3lv").value = 10;
    //     }
    // }
    changeValue();
    damage();
    totalD();
    totalHP();
}
/** ソート処理 */
function sort(obj){
    var len = getElByID("cardlen").value;
    var data = [];
    for(var i = 0; i < len; i++){
        data[i] = {
            img_src : getElByID("mcard"+i).src ,
            img_alt : getElByID("mcard"+i).alt ,
//            img_lbl : getElByID("mcard"+i+"_lbl").value ,
            cd_cdno : parseInt(getElByID("mcard"+i+"_cdno").value) ,
            cd_chno : getElByID("mcard"+i+"_chno").value ,
            cd_lv :  parseInt(getElByID("mcard"+i+"_lv").value) ,
            cd_hp : parseInt(getElByID("mcard"+i+"_hp").value) ,
            cd_atk : parseInt(getElByID("mcard"+i+"_atk").value) ,
            cd_m1_1 : getElByID("mcard"+i+"_m1_1").value ,
            cd_m2_1 : getElByID("mcard"+i+"_m2_1").value ,
            cd_m1_5 : getElByID("mcard"+i+"_m1_5").value ,
            cd_m2_5 : getElByID("mcard"+i+"_m2_5").value ,
            cd_m1_10 : getElByID("mcard"+i+"_m1_10").value ,
            cd_m2_10 : getElByID("mcard"+i+"_m2_10").value ,
            cd_m1buf_1 : getElByID("mcard"+i+"_m1buf_1").value ,
            cd_m2buf_1 : getElByID("mcard"+i+"_m2buf_1").value ,
            cd_m1buf_5 : getElByID("mcard"+i+"_m1buf_5").value ,
            cd_m2buf_5 : getElByID("mcard"+i+"_m2buf_5").value ,
            cd_m1buf_10 : getElByID("mcard"+i+"_m1buf_10").value ,
            cd_m2buf_10 : getElByID("mcard"+i+"_m2buf_10").value ,
            cd_m1lv : getElByID("mcard"+i+"_m1lv").value ,
            cd_m2lv : getElByID("mcard"+i+"_m2lv").value ,
            cd_b1 : getElByID("mcard"+i+"_b1").value ,
            cd_b2 : getElByID("mcard"+i+"_b2").value ,
            cd_b3 : getElByID("mcard"+i+"_b3").value ,
            cd_b1type : getElByID("mcard"+i+"_b1type").value ,
            cd_b2type : getElByID("mcard"+i+"_b2type").value ,
            cd_b3type : getElByID("mcard"+i+"_b3type").value ,
            cd_b1lv : getElByID("mcard"+i+"_b1lv").value ,
            cd_b2lv : getElByID("mcard"+i+"_b2lv").value ,
            cd_b3lv : getElByID("mcard"+i+"_b3lv").value ,
            cd_hpmiddle : parseInt(getElByID("mcard"+i+"_hpmiddle").value) ,
            cd_atkmiddle : parseInt(getElByID("mcard"+i+"_atkmiddle").value) ,
            cd_hpmax : parseInt(getElByID("mcard"+i+"_hpmax").value) ,
            cd_atkmax : parseInt(getElByID("mcard"+i+"_atkmax").value) ,
            cd_m1max : getElByID("mcard"+i+"_m1max").value ,
            cd_m2max : getElByID("mcard"+i+"_m2max").value ,
            cd_m1bufmax : getElByID("mcard"+i+"_m1bufmax").value ,
            cd_m2bufmax : getElByID("mcard"+i+"_m2bufmax").value ,
            cd_class : "mcardsHidden"
        };
    }
    
    data = sortprocess(obj,data);
    
    for(var i = 0; i < len; i++){
        getElByID("mcard"+i).src = data[i]["img_src"];
        getElByID("mcard"+i).alt = data[i]["img_alt"];
//        getElByID("mcard"+i+"_lbl").value = data[i]["img_lbl"];
        getElByID("mcard"+i+"_cdno").value = data[i]["cd_cdno"];
        getElByID("mcard"+i+"_chno").value = data[i]["cd_chno"];
        getElByID("mcard"+i+"_lv").value = data[i]["cd_lv"];
        getElByID("mcard"+i+"_hp").value = data[i]["cd_hp"];
        getElByID("mcard"+i+"_atk").value = data[i]["cd_atk"];
        getElByID("mcard"+i+"_m1_1").value = data[i]["cd_m1_1"];
        getElByID("mcard"+i+"_m2_1").value = data[i]["cd_m2_1"];
        getElByID("mcard"+i+"_m1_5").value = data[i]["cd_m1_5"];
        getElByID("mcard"+i+"_m2_5").value = data[i]["cd_m2_5"];
        getElByID("mcard"+i+"_m1_10").value = data[i]["cd_m1_10"];
        getElByID("mcard"+i+"_m2_10").value = data[i]["cd_m2_10"];
        getElByID("mcard"+i+"_m1buf_1").value = data[i]["cd_m1buf_1"];
        getElByID("mcard"+i+"_m2buf_1").value = data[i]["cd_m2buf_1"];
        getElByID("mcard"+i+"_m1buf_5").value = data[i]["cd_m1buf_5"];
        getElByID("mcard"+i+"_m2buf_5").value = data[i]["cd_m2buf_5"];
        getElByID("mcard"+i+"_m1buf_10").value = data[i]["cd_m1buf_10"];
        getElByID("mcard"+i+"_m2buf_10").value = data[i]["cd_m2buf_10"];
        getElByID("mcard"+i+"_m1lv").value = data[i]["cd_m1lv"];
        getElByID("mcard"+i+"_m2lv").value = data[i]["cd_m2lv"];
        getElByID("mcard"+i+"_b1").value = data[i]["cd_b1"];
        getElByID("mcard"+i+"_b2").value = data[i]["cd_b2"];
        getElByID("mcard"+i+"_b3").value = data[i]["cd_b3"];
        getElByID("mcard"+i+"_b1type").value = data[i]["cd_b1type"]; 
        getElByID("mcard"+i+"_b2type").value = data[i]["cd_b2type"]; 
        getElByID("mcard"+i+"_b3type").value = data[i]["cd_b3type"]; 
        getElByID("mcard"+i+"_b1lv").value = data[i]["cd_b1lv"];
        getElByID("mcard"+i+"_b2lv").value = data[i]["cd_b2lv"];
        getElByID("mcard"+i+"_b3lv").value = data[i]["cd_b3lv"];
        getElByID("mcard"+i+"_hpmiddle").value = data[i]["cd_hpmiddle"];
        getElByID("mcard"+i+"_atkmiddle").value = data[i]["cd_atkmiddle"];
        getElByID("mcard"+i+"_hpmax").value = data[i]["cd_hpmax"];
        getElByID("mcard"+i+"_atkmax").value = data[i]["cd_atkmax"];
        getElByID("mcard"+i+"_m1max").value = data[i]["cd_m1max"];
        getElByID("mcard"+i+"_m2max").value = data[i]["cd_m2max"];
        getElByID("mcard"+i+"_m1bufmax").value = data[i]["cd_m1bufmax"];
        getElByID("mcard"+i+"_m2bufmax").value = data[i]["cd_m2bufmax"];
        getElByID("mcard"+i).parentNode.className = data[i]["cd_class"];
        getElByID("mcard"+i).parentNode.id = 'NO'+data[i]["cd_cdno"];
    }
}

/** バフデバフのラベル変更 */
function changeMbufty(){
    var Mbufty = {
        au: 'ATK UP', du: 'ﾀﾞﾒｰｼﾞ UP', ad: 'ATK DOWN', dd: 'ﾀﾞﾒｰｼﾞ DOWN', re: 'HP回復', td: '被ﾀﾞﾒ DOWN',
        fu: '火ﾀﾞﾒ UP', tu: '木ﾀﾞﾒ UP', wu: '水ﾀﾞﾒ UP', nu: '無ﾀﾞﾒ UP', ev: '回避', cu: '呪い',
        s: '(極小)', S: '(小)', M: '(中)', L: '(大)',
        1: '(1T)', 2: '(2T)', 3: '(3T)',
        DU: 'デュオ魔法', nN: 'なし', undefined: '', '0undefined': '', NaN: '***'
    };
    var lv = ["1","5","10"];
    var ATT = [ [[],[]], [[],[]], [[],[]], [[],[]] ];
    for(var i = 1; i <= 5; i++){
        var M1lv =  getElByID("card"+i+"_m1lv").value;
        var M2lv =  getElByID("card"+i+"_m2lv").value;
        var M1buf = getElByID("card"+i+"_m1buf_"+lv[parseInt(parseInt(M1lv) / 5)]).value;
        var M2buf = getElByID("card"+i+"_m2buf_"+lv[parseInt(parseInt(M1lv) / 5)]).value;
        // 0以外の数値ならデュオ魔法
        if(isFinite(M1buf) && M1buf != 0) M1buf = 'DU';
        if(isFinite(M2buf) && M2buf != 0) M2buf = 'DU';
        //一旦中身を消す
        getElByID("card"+i+"_buf1_1Name").innerHTML = "";
        getElByID("card"+i+"_buf1_2Name").innerHTML = "";
        getElByID("card"+i+"_buf2_1Name").innerHTML = "";
        getElByID("card"+i+"_buf2_2Name").innerHTML = "";
        // 表示しない奴の処理用
        function BUF(terms, bufNameNode, buf, bufName){
            switch(terms){
                case 're': case 'ev': case 'cu': case 'DU':
                    getElByID(bufNameNode).innerHTML += '***<br>';
                    break;
                // 属性ダメージUPはあとで処理があるので内容を記録
                case 'fu':
                    getElByID(bufNameNode).innerHTML += '***<br>';
                    ATT[1][0].push(buf);
                    ATT[1][1].push(bufName);
                    break;
                case 'tu':
                    getElByID(bufNameNode).innerHTML += '***<br>';
                    ATT[2][0].push(buf);
                    ATT[2][1].push(bufName);
                    break;
                case 'wu':
                    getElByID(bufNameNode).innerHTML += '***<br>';
                    ATT[3][0].push(buf);
                    ATT[3][1].push(bufName);
                    break;
                case 'nu':
                    getElByID(bufNameNode).innerHTML += '***<br>';
                    ATT[0][0].push(buf);
                    ATT[0][1].push(bufName);
                    break;
                default:
                    getElByID(bufNameNode).innerHTML += bufName + "<br>";
            }
        }
        // その魔法のバフデバフはそのまま文字に変換
        getElByID("card"+i+"_buf1_1Name").innerHTML = Mbufty[M1buf[0]+M1buf[1]]+Mbufty[M1buf[2]]+Mbufty[M1buf[3]]
                                                         + "<br>" + Mbufty[M1buf[4]+M1buf[5]]+Mbufty[M1buf[6]]+Mbufty[M1buf[7]];
        // もう一つの魔法のバフデバフは場合によっては表示しない                                   
        BUF(M2buf[0]+M2buf[1], "card"+i+"_buf1_2Name", M2buf.substr(0,3), Mbufty[M2buf[0]+M2buf[1]]+Mbufty[M2buf[2]]+Mbufty[M2buf[3]]);
        BUF(M2buf[4]+M2buf[5], "card"+i+"_buf1_2Name", M2buf.substr(4,7), Mbufty[M2buf[4]+M2buf[5]]+Mbufty[M2buf[6]]+Mbufty[M2buf[7]]);
        BUF(M1buf[0]+M1buf[1], "card"+i+"_buf2_1Name", M1buf.substr(0,3), Mbufty[M1buf[0]+M1buf[1]]+Mbufty[M1buf[2]]+Mbufty[M1buf[3]]);
        BUF(M1buf[4]+M1buf[5], "card"+i+"_buf2_1Name", M1buf.substr(4,7), Mbufty[M1buf[4]+M1buf[5]]+Mbufty[M1buf[6]]+Mbufty[M1buf[7]]);
        // その魔法のバフデバフはそのまま文字に変換
        getElByID("card"+i+"_buf2_2Name").innerHTML = Mbufty[M2buf[0]+M2buf[1]]+Mbufty[M2buf[2]]+Mbufty[M2buf[3]]
                                                         + "<br>" + Mbufty[M2buf[4]+M2buf[5]]+Mbufty[M2buf[6]]+Mbufty[M2buf[7]];
    }
    
    /** ここから属性ダメージUPのチェックボックスを作る */
    // 一旦前の奴を全部消す
    for(var i = 1; i <= 5; i++){
        var parNode1 = getElByID("card"+i+"_bufA1");
        var parNode2 = getElByID("card"+i+"_bufA2");
        while (parNode1.firstChild) {
            parNode1.removeChild(parNode1.firstChild);
        }
        while (parNode2.firstChild) {
            parNode2.removeChild(parNode2.firstChild);
        }
    }
    // チェックボックス作成用
    function BUFcheck(id, value){
        var input = document.createElement('input');
        input.setAttribute('type', 'checkbox');
        input.setAttribute('id', id);
        input.setAttribute('value', value);
        input.setAttribute('onclick', 'clickChange()');
        
        return input;
    }
    // ラベル作成用
    function BUFlabel(id, text){
        var label = document.createElement('label');
        label.htmlFor = id;
        label.appendChild(document.createTextNode(text));
        
        return label;
    }
    // 該当するものにチェックボックスを追加していく
    for(var att = 0; att <= 3; att++){
        for(var i = 1; i <= 5; i++){
            if(att == getElByID("card"+i+"_m1_1").value[0]){
                for(var k = 0; k < ATT[att][0].length; k++){
                    var Input = BUFcheck('card'+i+'_bufA1_'+k, ATT[att][0][k]);
                    var Label = BUFlabel('card'+i+'_bufA1_'+k, ATT[att][1][k]);
                    
                    var parNode = getElByID("card"+i+"_bufA1");
                    parNode.appendChild(Input);
                    parNode.appendChild(Label);
                    parNode.appendChild(document.createElement('br'));
                }
            }
            if(att == getElByID("card"+i+"_m2_1").value[0]){
                for(var k = 0; k < ATT[att][0].length; k++){
                    var Input = BUFcheck('card'+i+'_bufA2_'+k, ATT[att][0][k]);
                    var Label = BUFlabel('card'+i+'_bufA2_'+k, ATT[att][1][k]);
                    
                    var parNode = getElByID("card"+i+"_bufA2");
                    parNode.appendChild(Input);
                    parNode.appendChild(Label);
                    parNode.appendChild(document.createElement('br'));
                }
            }
        }
    }
//    console.log(ATT);
}
/******************************************************************************/
/** HPとATKのバディボーナス計算 */
function changeValue(){
    var BuddyLv = {
        As : [0.11, 0.12, 0.13, 0.14, 0.15, 0.16, 0.17, 0.18, 0.19, 0.2] ,
        Am : [0.215, 0.23, 0.245, 0.26, 0.275, 0.29, 0.305, 0.32, 0.335, 0.35] ,
        Hs : [0.11, 0.12, 0.13, 0.14, 0.15, 0.16, 0.17, 0.18, 0.19, 0.2] ,
        Hm : [0.21, 0.22, 0.23, 0.24, 0.25, 0.26, 0.27, 0.28, 0.29, 0.3]
    };
    
    var data = {};
    
    for(var i = 1; i <= 5; i++){ //データ抽出        
        data[i] = {
            cd_cdno : getElByID("card"+i+"_cdno").value ,
            cd_chno : getElByID("card"+i+"_chno").value ,
            cd_hp : getElByID("card"+i+"_hp").value ,
            cd_atk : getElByID("card"+i+"_atk").value ,
            cd_b1 : getElByID("card"+i+"_b1").value ,
            cd_b2 : getElByID("card"+i+"_b2").value ,
            cd_b3 : getElByID("card"+i+"_b3").value ,
            cd_b1type : getElByID("card"+i+"_b1type").value ,
            cd_b2type : getElByID("card"+i+"_b2type").value ,
            cd_b3type : getElByID("card"+i+"_b3type").value ,
            cd_b1lv : getElByID("card"+i+"_b1lv").value ,
            cd_b2lv : getElByID("card"+i+"_b2lv").value ,
            cd_b3lv : getElByID("card"+i+"_b3lv").value
        };
    }
    
    var mag = {};
    var appB = {};
    
    function bPlus(B, Btype, Blv, chno, appBarg){ //ボーナス補正に使う用
        if(B == chno && !appB[appBarg]){
            if(Btype.length == 4){
                mag[Btype[0]] += BuddyLv[Btype[0]+Btype[1]][Blv - 1];
                mag[Btype[2]] += BuddyLv[Btype[2]+Btype[3]][Blv - 1];
                appB[appBarg] = true;
            }else{
                mag[Btype[0]] += BuddyLv[Btype[0]+Btype[1]][Blv - 1];
                appB[appBarg] = true;
            }
        }
    }
    
    for(var i = 1; i <= 5; i++){ //ボーナス補正
        mag = {
            A : 0 ,
            H : 0
        }; //倍率初期化
        appB = {
            B1 : false ,
            B2 : false ,
            B3 : false
        };
        for(var j = 1; j <= 5; j++){ //倍率の設定
            bPlus(data[i]['cd_b1'], data[i]['cd_b1type'], data[i]['cd_b1lv'], data[j]['cd_chno'], 'B1');
            bPlus(data[i]['cd_b2'], data[i]['cd_b2type'], data[i]['cd_b2lv'], data[j]['cd_chno'], 'B2');
            bPlus(data[i]['cd_b3'], data[i]['cd_b3type'], data[i]['cd_b3lv'], data[j]['cd_chno'], 'B3');
        }
        //データを修正
        getElByID("card"+i+"_hpbuf").value = data[i]['cd_hp'] * (mag['H'] + 1);
        getElByID("card"+i+"_atkbuf").value = data[i]['cd_atk'] * (mag['A'] + 1);
        if(appB.B1){
            getElByID("card"+i+"_budy1").src = '../img/Hobby_1/app.png';
        }else{
            getElByID("card"+i+"_budy1").src = '../img/Hobby_1/off.png';
        }
        if(appB.B2){
            getElByID("card"+i+"_budy2").src = '../img/Hobby_1/app.png';
        }else{
            getElByID("card"+i+"_budy2").src = '../img/Hobby_1/off.png';
        }
        if(appB.B3){
            getElByID("card"+i+"_budy3").src = '../img/Hobby_1/app.png';
        }else{
            getElByID("card"+i+"_budy3").src = '../img/Hobby_1/off.png';
        }
        
    }
}
/** 各魔法の想定ダメージ計算 */
function damage(){
    var data = {}; // 必要なデータ抽出用
    /** データ抽出 */
    for(var i = 1; i <= 5; i++){
        data[i] = {
            cd_atk : getElByID("card"+i+"_atk").value , // ATK基礎値
            cd_atkbuf : getElByID("card"+i+"_atkbuf").value , // バディボーナス補正済みATK
            cd_m1 : "" , // M1コード
            cd_m2 : "" , // M2コード
            cd_m1buf : "" , // M1バフデバフ種類コード
            cd_m2buf : "" , // M2バフデバフ種類コード
            cd_m1bufA : getElByID("card"+i+"_bufA1").childNodes , // M1属性ダメージUP(配列)
            cd_m2bufA : getElByID("card"+i+"_bufA2").childNodes , // M2属性ダメージUP(配列)
            cd_m1lv : getElByID("card"+i+"_m1lv").value , // M1Lv
            cd_m2lv : getElByID("card"+i+"_m2lv").value , // M2Lv
            cd_chno : getElByID("card"+i+"_chno").value // キャラクターNo
        };
        // 魔法Lvに合わせてバフデバフを抽出する
        for(var j = 1; j <= 2; j++){
            switch(data[i]['cd_m'+j+'lv']){
                case "1": case "2": case "3": case "4":
                    data[i]['cd_m'+j] = getElByID('card'+i+'_m'+j+'_1').value;
                    data[i]['cd_m'+j+'buf'] = getElByID('card'+i+'_m'+j+'buf_1').value;
                    break;
                case "5": case "6": case "7": case "8": case "9": 
                    data[i]['cd_m'+j] = getElByID('card'+i+'_m'+j+'_5').value;
                    data[i]['cd_m'+j+'buf'] = getElByID('card'+i+'_m'+j+'buf_5').value;
                    break;
                case "10": 
                    data[i]['cd_m'+j] = getElByID('card'+i+'_m'+j+'_10').value;
                    data[i]['cd_m'+j+'buf'] = getElByID('card'+i+'_m'+j+'buf_10').value;
                    break;
            }
        }
    }
    
    var calc = {};
    /** 計算開始 */
    for(var i = 1; i <= 5; i++){
        // 初期化
        calc = {
            D1 : 0, ATK1 : data[i]['cd_atkbuf'], Dmag1 : 0, cor1 : 0, att1 : 0, ram1 : 0,
            D2 : 0, ATK2 : data[i]['cd_atkbuf'], Dmag2 : 0, cor2 : 0, att2 : 0, ram2 : 0
        }
////////////////////////////////////////////////////////////////////////////////
        // ATKバフをATKに加算する用
        function aBuf(
            cd_mbuf, // バフコード
            ATK, // 'ATK1'か'ATK2'(連想引数)
            lv, // 魔法Lv
            ATKsub, // ATKじゃない方(連想引数)
            mChecked, // メインの方にバフをかけるか
            mSubChecked // サブの方にバフをかけるか
        ){
            if(cd_mbuf[0] == "a" && cd_mbuf[1] == "u"){ //ATK UPか判断
                switch(cd_mbuf[2]){
                    case "s" :
                        if(mChecked)
                            calc[ATK] = parseFloat(calc[ATK],10) + data[i]['cd_atk'] * ((5 + 0.5 * lv) / 100);
                        if(mSubChecked)
                            calc[ATKsub] = parseFloat(calc[ATKsub],10) + data[i]['cd_atk'] * ((5 + 0.5 * lv) / 100);                                       
                        break;
                    case "S" :
                        if(mChecked)
                            calc[ATK] = parseFloat(calc[ATK],10) + data[i]['cd_atk'] * ((10 + 1 * lv) / 100);
                        if(mSubChecked)
                            calc[ATKsub] = parseFloat(calc[ATKsub],10) + data[i]['cd_atk'] * ((10 + 1 * lv) / 100);
                        break;
                    case "M" :
                        if(mChecked)
                            calc[ATK] = parseFloat(calc[ATK],10) + data[i]['cd_atk'] * ((20 + 1.5 * lv) / 100);
                        if(mSubChecked)
                            calc[ATKsub] = parseFloat(calc[ATKsub],10) + data[i]['cd_atk'] * ((20 + 1.5 * lv) / 100);
                        break;
                    case "L" :
                        if(mChecked)
                            calc[ATK] = parseFloat(calc[ATK],10) + data[i]['cd_atk'] * ((30 + 2 * lv) / 100);
                        if(mSubChecked)
                            calc[ATKsub] = parseFloat(calc[ATKsub],10) + data[i]['cd_atk'] * ((30 + 2 * lv) / 100);
                        break;
                }            
            }
        }
        // ATKバフをATKに加算
        aBuf(data[i]['cd_m1buf'], 'ATK1', data[i]['cd_m1lv'], 'ATK2',
            getElByID("card"+i+"_buf1_1").checked,
            getElByID("card"+i+"_buf2_1").checked);
        aBuf(data[i]['cd_m2buf'], 'ATK2', data[i]['cd_m2lv'], 'ATK1',
            getElByID("card"+i+"_buf2_2").checked,
            getElByID("card"+i+"_buf1_2").checked);
////////////////////////////////////////////////////////////////////////////////
        // 攻撃倍率算出用
        function aMag(
            cd_m, // 魔法コード
            Dmag, // 'Dmag1'か'Dmag2'(連想引数)
            lv // 魔法Lv
        ){
            switch(cd_m.charAt(1)){
                case "S" :
                    calc[Dmag] += (50 + 2.5 * lv) / 100;
                    break;
                case "L" :
                    // calc[Dmag] += (62.5 + 3.75 * lv) / 100;
                    calc[Dmag] += (60 + 4 * lv) / 100; // 参考文献によって少し違う
                    break;
            }
        }
        // 攻撃倍率をDmagに加算
        aMag(data[i]['cd_m1'], 'Dmag1', data[i]['cd_m1lv']);
        aMag(data[i]['cd_m2'], 'Dmag2', data[i]['cd_m2lv']);
////////////////////////////////////////////////////////////////////////////////
        // 無属性補正用
        function Ncor(
            cd_m, // 魔法コード
            Dmag // 'Dmag1'か'Dmag2'(連想引数)
        ){
            if(cd_m.charAt(0) == 0){ // 無属性なら攻撃倍率を補正する
                calc[Dmag] *= 1.1;
            }
        }
        // 攻撃倍率に無属性補正をかける
        Ncor(data[i]['cd_m1'], 'Dmag1');
        Ncor(data[i]['cd_m2'], 'Dmag2');
////////////////////////////////////////////////////////////////////////////////
        // ダメージバフ算出用
        function dBuf(
            cd_mbuf, // バフコード
            Dmag, // 'Dmag1'か'Dmag2'(連想引数)
            lv, // 魔法Lv
            Dmagsub, // Dmagじゃない方(連想引数)
            mChecked, // メインの方にバフをかけるか
            mSubChecked // サブの方にバフをかけるか
        ){
            if(cd_mbuf[0] == "d" && cd_mbuf[1] == "u"){ // ダメージUPか判断
                switch(cd_mbuf[2]){
                    case "s" :
                        if(mChecked)
                            calc[Dmag] = parseFloat(calc[Dmag],10) + ((1.25 + 0.125 * lv) / 100);
                        if(mSubChecked)
                            calc[Dmagsub] = parseFloat(calc[Dmagsub],10) + ((1.25 + 0.125 * lv) / 100);
                        break;
                    case "S" :
                        if(mChecked)
                            calc[Dmag] = parseFloat(calc[Dmag],10) + ((2.5 + 0.25 * lv) / 100);
                        if(mSubChecked)
                            calc[Dmagsub] = parseFloat(calc[Dmagsub],10) + ((1.25 + 0.125 * lv) / 100);
                        break;
                    case "M" :
                        if(mChecked)
                            calc[Dmag] = parseFloat(calc[Dmag],10) + ((5 + 0.375 * lv) / 100);
                        if(mSubChecked)
                            calc[Dmagsub] = parseFloat(calc[Dmagsub],10) + ((5 + 0.375 * lv) / 100);
                        break;
                    case "L" :
                        if(mChecked)
                            calc[Dmag] = parseFloat(calc[Dmag],10) + ((7.5 + 0.5 * lv) / 100);
                        if(mSubChecked)
                            calc[Dmagsub] = parseFloat(calc[Dmagsub],10) + ((7.5 + 0.5 * lv) / 100);
                        break;
                }            
            }
        }
        // ダメージバフをDmagに加算
        dBuf(data[i]['cd_m1buf'], 'Dmag1', data[i]['cd_m1lv'], 'Dmag2',
            getElByID("card"+i+"_buf1_1").checked,
            getElByID("card"+i+"_buf2_1").checked);
        dBuf(data[i]['cd_m2buf'], 'Dmag2', data[i]['cd_m2lv'], 'Dmag1',
            getElByID("card"+i+"_buf2_2").checked,
            getElByID("card"+i+"_buf1_2").checked);
////////////////////////////////////////////////////////////////////////////////
        // 属性ダメージUP補正用
        function attribute(
            cd_mbufA, // 属性ダメージバフ(配列)
            Dmag, // 'Dmag1'か'Dmag2'(連想引数)
            lv // 魔法Lv
        ){
            for(var i = 0; i < cd_mbufA.length/3; i++){
                if(cd_mbufA[i*3].checked){
                    var BUF = cd_mbufA[i*3].value;
                    switch(BUF[2]){
                        case "s" :
                            calc[Dmag] = parseFloat(calc[Dmag]) + ((1.5 + 0.15 * lv) / 100);
                            break;
                        case "S" :
                            calc[Dmag] = parseFloat(calc[Dmag]) + ((3 + 0.3 * lv) / 100);
                            break;
                        case "M" :
                            calc[Dmag] = parseFloat(calc[Dmag]) + ((6 + 0.45 * lv) / 100);
                            break;
                        case "L" :
                            calc[Dmag] = parseFloat(calc[Dmag]) + ((9 + 0.6 * lv) / 100);
                            break;
                    }            
                }
            }
        }
        // 属性ダメージUPをDmagに加算
        attribute(data[i]['cd_m1bufA'], 'Dmag1', data[i]['cd_m1lv']);
        attribute(data[i]['cd_m2bufA'], 'Dmag2', data[i]['cd_m2lv']);
////////////////////////////////////////////////////////////////////////////////
        // 連撃補正を加えて想定ダメージを算出する用
        function Cor(
            cd_m, // 魔法コード
            cd_mbuf, // バフコード
            D, // 'D1'か'D2'(連想引数)
            ATK, // 'ATK1'か'ATK2'(連想引数)
            Dmag, // 'Dmag1'か'Dmag2'(連想引数)
            mChecked // DUO魔法とするか判定用
        ){
            switch(cd_m.charAt(2)){
                case "1" :
                    calc[D] += calc[ATK] * calc[Dmag];
                    break;
                case "2" : //3連について修正する
                    if(/^[0-9]+$/.test(cd_mbuf)){//DUOならこちらで判定
                        var flg = false;
                        for(var i = 1; i <= 5; i++){//相方がいるかつバフがtrueか
                            if(data[i]['cd_chno'] == cd_mbuf && mChecked){
                                flg = true;
                            }
                        }
                        if(flg){ // 居たら3連
                            calc[D] += (calc[ATK] * calc[Dmag] * 0.8) * 3;
                        }else{ // 居ないまたはバフがfalseなら2連
                            calc[D] += (calc[ATK] * calc[Dmag] * 0.9) * 2;
                        }                       
                        
                    }else{//DUOじゃないなら普通に2連
                        calc[D] += (calc[ATK] * calc[Dmag] * 0.9) * 2;
                    }
                    break;
            }
        }
        // 想定ダメージをDに算出
        Cor(data[i]['cd_m1'], data[i]['cd_m1buf'], 'D1', 'ATK1', 'Dmag1',
            getElByID("card"+i+"_buf1_1").checked);
        Cor(data[i]['cd_m2'], data[i]['cd_m2buf'], 'D2', 'ATK2', 'Dmag2',
            getElByID("card"+i+"_buf2_2").checked);
////////////////////////////////////////////////////////////////////////////////
        // 出力
        getElByID("card"+i+"_d1").value = calc['D1'];
        getElByID("card"+i+"_d2").value = calc['D2'];
    }
}
/** トータルダメージ算出及び、有利不利ダメージ算出 */
function totalD(){
    var total = {N:    0, F:    0, T:    0,W:    0,
                 Nsel: 0, Fsel: 0, Tsel: 0,Wsel: 0};
    var M = {M1: "", M2: ""};
    // トータルダメージ算出用
    function totals(
        terms, // 属性コード
        dNode, // 基礎想定ダメージ
        Dchecked // 選択トータルダメージに含めるか
    ){
        switch(terms){
            case "0":
                total.N += parseInt(dNode.value);
                total.T += parseInt(dNode.value);
                total.W += parseInt(dNode.value);
                total.F += parseInt(dNode.value);
                if(Dchecked){
                    total.Nsel += parseInt(dNode.value);
                    total.Tsel += parseInt(dNode.value);
                    total.Wsel += parseInt(dNode.value);
                    total.Fsel += parseInt(dNode.value);
                }
                break;
            case "1":
                total.N += parseInt(dNode.value);
                total.T += parseInt(parseInt(dNode.value) * 1.5);
                total.W += parseInt(parseInt(dNode.value) * 0.5);
                total.F += parseInt(dNode.value);
                if(Dchecked){
                    total.Nsel += parseInt(dNode.value);
                    total.Tsel += parseInt(parseInt(dNode.value) * 1.5);
                    total.Wsel += parseInt(parseInt(dNode.value) * 0.5);
                    total.Fsel += parseInt(dNode.value);
                }
                break;                
            case "2":
                total.N += parseInt(dNode.value);
                total.T += parseInt(dNode.value);
                total.W += parseInt(parseInt(dNode.value) * 1.5);
                total.F += parseInt(parseInt(dNode.value) * 0.5);
                if(Dchecked){
                    total.Nsel += parseInt(dNode.value);
                    total.Tsel += parseInt(dNode.value);
                    total.Wsel += parseInt(parseInt(dNode.value) * 1.5);
                    total.Fsel += parseInt(parseInt(dNode.value) * 0.5);
                }
                break;
            case "3":
                total.N += parseInt(dNode.value);
                total.T += parseInt(parseInt(dNode.value) * 0.5);
                total.W += parseInt(dNode.value);
                total.F += parseInt(parseInt(dNode.value) * 1.5);
                if(Dchecked){
                    total.Nsel += parseInt(dNode.value);
                    total.Tsel += parseInt(parseInt(dNode.value) * 0.5);
                    total.Wsel += parseInt(dNode.value);
                    total.Fsel += parseInt(parseInt(dNode.value) * 1.5);
                }
                break;
        }
    }
    // 想定ダメージを抽出してトータルダメージを算出する
    for(var i = 1; i <= 5; i++){
        // 想定ダメージを抽出
        M.M1 = getElByID("card"+i+"_m1_1").value;
        M.M2 = getElByID("card"+i+"_m2_1").value;
        // それぞれの有利不利想定ダメージに出力
        getElByID('card'+i+'_ADd1').value = parseInt(parseInt(getElByID("card"+i+"_d1").value) * 1.5);
        getElByID('card'+i+'_DISd1').value = parseInt(parseInt(getElByID("card"+i+"_d1").value) * 0.5);
        getElByID('card'+i+'_ADd2').value = parseInt(parseInt(getElByID("card"+i+"_d2").value) * 1.5);
        getElByID('card'+i+'_DISd2').value = parseInt(parseInt(getElByID("card"+i+"_d2").value) * 0.5);
        // totalに加算していく
        totals(M.M1.charAt(0), getElByID("card"+i+"_d1"), getElByID("card"+i+"_MtORf1").checked);
        totals(M.M2.charAt(0), getElByID("card"+i+"_d2"), getElByID("card"+i+"_MtORf2").checked);
    }
    // トータルダメージを出力
    getElByID("DtotalN").value = total.N;
    getElByID("DtotalT").value = total.T;
    getElByID("DtotalW").value = total.W;
    getElByID("DtotalF").value = total.F;
    getElByID("DtotalNsel").value = total.Nsel;
    getElByID("DtotalTsel").value = total.Tsel;
    getElByID("DtotalWsel").value = total.Wsel;
    getElByID("DtotalFsel").value = total.Fsel;  
}
/** 合計HP算出 */
function totalHP(){
    var lv = ["1","5","10"];
    var total = 0; // 合計HP
    var totalre = 0; // 回復込みの合計HP
    // 回復量算出用
    function HPre(
        BUF, // バフコード
        ATK, // 基礎ATK
        LV, // 魔法Lv
        checked //　バフがtrueか
    ){
        if(BUF[0] == "r" && BUF[1] == "e"){
            switch(BUF[2]){
                case "s" :
                    if(checked)
                        totalre += parseInt(ATK) * (0.5 + 0.01 * LV);
                    break;
                case "S" :
                    if(checked)
                        totalre += parseInt(ATK) * (0.9 + 0.02 * LV);
                    break;
                case "M" :
                    if(checked)
                        totalre += parseInt(ATK) * (1.3 + 0.04 * LV);
                    break;
            }            
        }
    }
    // 合計HPを算出していく
    for(var i = 1; i <= 5; i++){
        var HP = getElByID("card"+i+"_hpbuf").value;
        // HPを加算
        total += parseInt(HP);
        totalre += parseInt(HP);
        // 回復量算出に必要なデータを抽出
        var M1lv =  getElByID("card"+i+"_m1lv").value;
        var M2lv =  getElByID("card"+i+"_m2lv").value;
        var M1buf = getElByID("card"+i+"_m1buf_"+lv[parseInt(parseInt(M1lv) / 5)]).value;
        var M2buf = getElByID("card"+i+"_m2buf_"+lv[parseInt(parseInt(M1lv) / 5)]).value;
        var Atk = getElByID("card"+i+"_atk").value;
        //　回復を合計に加算
        HPre(M1buf, Atk, M1lv, getElByID("card"+i+"_buf1_1").checked);
        HPre(M1buf.substr(4), Atk, M1lv, getElByID("card"+i+"_buf1_1").checked);
        HPre(M2buf, Atk, M2lv, getElByID("card"+i+"_buf2_2").checked);        
        HPre(M2buf.substr(4), Atk, M2lv, getElByID("card"+i+"_buf2_2").checked);           
    }
    // 出力
    getElByID("DtotalHP").value = total;
    getElByID("DtotalHPrec").value = totalre;
}