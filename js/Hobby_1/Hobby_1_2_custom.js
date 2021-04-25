function stop(){
    event.stopPropagation();
}
function clickOpenSortModal(){
    console.log("OK");
    document.getElementById("overlaySort").className = "";
    document.getElementById("modalSort").className = "";
}
function clickCloseSortModal(){
    console.log("OK");
    document.getElementById("overlaySort").className = "hidden";
    document.getElementById("modalSort").className = "hidden";
}

function sort(obj){
    console.log("OK");
    var len = document.getElementById("cardlen").value;
    var magic = {
        N:"0",F:"1",T:"2",W:"3",
        0:"Nomal.jpg",1:"Fire.jpg",2:"Tree.jpg",3:"Water.jpg"
    };
    var data = [];
    for(var i = 0; i < len; i++){
        var m1 = document.getElementById("mcard"+i+"_m1").src.split('/');
        var m2 = document.getElementById("mcard"+i+"_m2").src.split('/');
        data[i] = {
            img_src : document.getElementById("mcard"+i).src ,
            img_alt : document.getElementById("mcard"+i).alt ,
            cd_cdno : parseInt(document.getElementById("mcard"+i+"_cdno").value) ,
            cd_chno : document.getElementById("mcard"+i+"_chno").value ,
            cd_lv :  parseInt(document.getElementById("mcard"+i+"_lv").value) ,
            cd_hp : parseInt(document.getElementById("mcard"+i+"_hp").value) ,
            cd_atk : parseInt(document.getElementById("mcard"+i+"_atk").value) ,
            cd_m1 : magic[m1[m1.length-1][0]] ,
            cd_m2 : magic[m2[m2.length-1][0]] ,
            cd_m1lv : document.getElementById("mcard"+i+"_m1lv").value ,
            cd_m2lv : document.getElementById("mcard"+i+"_m2lv").value ,
            cd_b1 : document.getElementById("mcard"+i+"_b1").src ,
            cd_b2 : document.getElementById("mcard"+i+"_b2").src ,
            cd_b3 : document.getElementById("mcard"+i+"_b3").src ,
            cd_b1lv : document.getElementById("mcard"+i+"_b1lv").value ,
            cd_b2lv : document.getElementById("mcard"+i+"_b2lv").value ,
            cd_b3lv : document.getElementById("mcard"+i+"_b3lv").value ,
            cd_class : "mcardsHidden"
        };
    }
    console.log(data);
    
    data = sortprocess(obj,data);
    console.log(data);
    for(var i = 0; i < len; i++){
        document.getElementById("mcard"+i).src = data[i]["img_src"];
        document.getElementById("mcard"+i).alt = data[i]["img_alt"];
        document.getElementById("mcard"+i+"_cdno").value = data[i]["cd_cdno"];
        document.getElementById("mcard"+i+"_chno").value = data[i]["cd_chno"];
        document.getElementById("mcard"+i+"_lv").value = data[i]["cd_lv"];
        document.getElementById("mcard"+i+"_hp").value = data[i]["cd_hp"];
        document.getElementById("mcard"+i+"_atk").value = data[i]["cd_atk"];
        document.getElementById("mcard"+i+"_m1").src = "../img/Hobby_1/Element/"+magic[data[i]["cd_m1"]];
        document.getElementById("mcard"+i+"_m2").src = "../img/Hobby_1/Element/"+magic[data[i]["cd_m2"]];
        document.getElementById("mcard"+i+"_m1lv").value = data[i]["cd_m1lv"];
        document.getElementById("mcard"+i+"_m2lv").value = data[i]["cd_m2lv"];
        document.getElementById("mcard"+i+"_b1").src = data[i]["cd_b1"];
        document.getElementById("mcard"+i+"_b2").src = data[i]["cd_b2"];
        document.getElementById("mcard"+i+"_b3").src = data[i]["cd_b3"];
        document.getElementById("mcard"+i+"_b1lv").value = data[i]["cd_b1lv"];
        document.getElementById("mcard"+i+"_b2lv").value = data[i]["cd_b2lv"];
        document.getElementById("mcard"+i+"_b3lv").value = data[i]["cd_b3lv"];
        document.getElementById("mcard"+i).parentNode.className = data[i]["cd_class"];
        
        if(data[i]["cd_b3lv"] != 0){
            document.getElementById("mcard"+i+"_b3").className = "";
            document.getElementById("mcard"+i+"_b3lv").parentNode.className = "";
        }else{
            document.getElementById("mcard"+i+"_b3").className = "hidden";
            document.getElementById("mcard"+i+"_b3lv").parentNode.className = "hidden";
        }
        if(data[i]["cd_b2lv"] != 0){
            document.getElementById("mcard"+i+"_b2").className = "";
            document.getElementById("mcard"+i+"_b2lv").parentNode.className = "";
        }else{
            document.getElementById("mcard"+i+"_b2").className = "hidden";
            document.getElementById("mcard"+i+"_b2lv").parentNode.className = "hidden";
        }
    }
    
}