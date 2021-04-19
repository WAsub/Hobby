
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>modalをcomponentで作</title>
</head>

<style>
#content{
  z-index:10;
  width:50%;
  padding: 1em;
  background:#fff;
}

#overlay{
  /*　要素を重ねた時の順番　*/

  z-index:1;

  /*　画面全体を覆う設定　*/
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:rgba(0,0,0,0.5);

  /*　画面の中央に要素を表示させる設定　*/
  display: flex;
  align-items: center;
  justify-content: center;

}
</style>

<body onload="load()">
  <div id="app" class="rr">

    <!--<button v-on:click="openModal">Click</button>-->

    <select-lv id="a1"></select-lv>
    
    

  </div>

<!--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>-->
    <script>
        function load(){
        document.getElementById("a1").value = "3";
        console.log(document.getElementById("a1").value);
    }
    </script>
<script src="../lib/vue.js"></script> 
<script>
Vue.component('select-lv',{
  template : `
    <select>
        <option value="1">1</option><option value="2">2</option>
        <option value="3">3</option><option value="4">4</option>
        <option value="5">5</option><option value="6">6</option>
        <option value="7">7</option><option value="8">8</option>
        <option value="9">9</option><option value="10">10</option>
    </select>
    `
});
new Vue({
  el: '#app'
  
});
</script> 
</body>
</html>