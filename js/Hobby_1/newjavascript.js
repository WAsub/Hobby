function dragstart(){
    event.dataTransfer.setData("text/plain", event.target.id);
}
function dragover(){
    event.preventDefault();
}
function drop(obj){
    event.preventDefault();
    var id = event.dataTransfer.getData("text/plain");
    
    apply(id, obj.id);
    
    changeValue();
    damage();
    totalD();
    
}
