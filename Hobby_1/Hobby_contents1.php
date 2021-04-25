
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>modalをcomponentで作る</title>
</head>
<body>
  <div id="app">
    <!-- <div>
    <my-sel :value="name['a1']"></my-sel>
    <my-sels 
    :value="name['a3']"
    :op="num2"
    ></my-sels>
    </div>
    

    <p>selectsampleの値は「{{ name['a1'] }}」です。</p>
    <input id="js-name1" type="hidden" value="hoge">
    <input id="js-name2" type="hidden" value="fuga">
    <input id="js-name3" type="hidden" value="3"> -->

    <div id="con">
    <input type="hidden" id="cardlen" value="1">
    <select-lv id="mcard0_lv" name="mcard0_lv" :seled="8" :op="opCard"></select-lv>
    <input id="mcard0_lvH" type="hidden" value="5">
    </div>
  </div>
  <script src="../lib/vue.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
  <script src="../js/Hobby_1/selectCardLv_vue.js"></script>
  <script>
    // Vue.component('my-sel',{
    //   props: ['value'],
    //   template : `
    //     <select v-model="value">
    //     <option value="hoge">hoge</option>
    //     <option value="fuga">fuga</option>
    //     <option value="piyo">piyo</option>
    //     </select>
    //     `
    // });
    // Vue.component('my-sels',{
    //   props: {
    //     value: String,
    //     op: Array
    //   },
    //   template : `
    //     <select v-model="value">
    //       <option v-for="option in op" v-bind:value="option">
    //         {{ option }}
    //       </option>
    //     </select>
    //     `
    // });
    // new Vue({
    //   el: '#app',
    //   data: function () {
    //     var n = [];
    //     var n2 = [];
    //     for(var i = 0; i <= 10; i++){
    //       n[i] = i;
    //       n2[i] = i+1;
    //     }
    //     var w = {};
    //     for(var i = 1; i <= 3; i++){
    //       w['a'+i] = document.getElementById('js-name'+i).value;
    //     }
    //     return {
    //       name: w,
    //       num: n,
    //       num2: n2
    //     }
    //   }
    // })


  </script>
</body>
</html>
