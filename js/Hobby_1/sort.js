function UD(obj){
    if(document.getElementById("ud").alt == "asc"){
        document.getElementById("ud").src = "../img/Hobby_1/desc.jpg";
        document.getElementById("ud").alt = "desc";
    }else{
        document.getElementById("ud").src = "../img/Hobby_1/asc.jpg";
        document.getElementById("ud").alt = "asc";
    }
    
    sort(obj);
}

function sortprocess(obj,data){
//    console.log(data);
    var len = document.getElementById("cardlen").value;
    var sorts = document.getElementsByName("sorts");
    var sort = "";
    for(var i = 0; i < sorts.length; i++){
        if(sorts[i].checked){
            sort = sorts[i].value;
            break;
        }
    }
    
    function dataSort(key, R1, R2){
        data.sort(function(a, b){
            if(a[key] < b[key]) return R1;
            if(a[key] > b[key]) return R2;
            return 0;
        });
    }
//    console.log(data);
    var r = [1,-1];
    if(document.getElementById("ud").alt == "asc"){
        r[0] = -1;
        r[1] = 1;
    }
    switch(sort){
        case "default":
            dataSort("cd_cdno", r[0], r[1]);
            break;
        case "Lv":
            dataSort("cd_chno", r[0], r[1]);
            dataSort("cd_lv", r[0], r[1]);
            break;
        case "HP":
            dataSort("cd_chno", r[0], r[1]);
            dataSort("cd_hp", r[0], r[1]);
            break;
        case "ATK":
            dataSort("cd_chno", r[0], r[1]);
            dataSort("cd_atk", r[0], r[1]);
            break;
        case "chNo":
            dataSort("cd_chno", r[0], r[1]);
            break;
    }
    
    
    var filter1 = document.getElementsByClassName("filter1");
    var filter2 = document.getElementsByClassName("filter2");
    var filter3 = document.getElementsByClassName("filter3");
    
    if(obj.className == "filter1" && obj.value == "0"){
        for(var i = 1; i < filter1.length; i++){
            filter1[i].checked = false;
        }        
    }else if(obj.className == "filter1" && obj.value != "0"){
        filter1[0].checked = false;
    }
    
    for(var i = 0; i < filter1.length; i++){
        if(filter1[i].value == "0" && filter1[i].checked){
            for(var j = 0; j < len; j++){                
                data[j]['cd_class'] = "mcards";        
            }
            break;
        }
//        console.log(filter1[i].checked);
        if(filter1[i].value != "0" && filter1[i].checked){
            for(var j = 0; j < len; j++){
                if(data[j]['cd_chno'].charAt(0) == filter1[i].value){
                    data[j]['cd_class'] = "mcards";
                }
            }
        }
    }
    for(var i = 0; i < filter2.length; i++){
        if(filter2[i].checked){
            for(var j = 0; j < len; j++){
                if(data[j]['cd_m1_1'].charAt(0) == filter2[i].value || data[j]['cd_m2_1'].charAt(0) == filter2[i].value){
                }else{
                    data[j]['cd_class'] = "mcardsHidden";
                }
            }
        }
    }
    for(var i = 0; i < filter3.length; i++){
        if(filter3[i].checked){
            for(var j = 0; j < len; j++){
                if(data[j]['cd_lv'] != filter3[i].value){
                }else{
                    data[j]['cd_class'] = "mcardsHidden";
                }
            }
        }
    }
    console.log(data);
    return data;
}