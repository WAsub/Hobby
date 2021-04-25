Vue.component('select-lv',{
  props: {
    seled: null,
    op: Array
  },
  template : `
    <select v-model="seled">
      <option v-for="option in op" v-bind:value="option">
        {{ option }}
      </option>
    </select>
    `
});
new Vue({
  el: '#con',
  data: function () {
    var n = {card:[], m:[], b:[]};
    for(var i = 0; i <= 100; i++){ n['card'][i] = i;}
    for(var i = 1; i <= 10; i++){ n['m'][i] = i;}
    for(var i = 0; i <= 10; i++){ n['b'][i] = i;}
    // var len = document.getElementById("cardlen").value;
    // var lv = {card:[], m1:[], m2:[], b1:[], b2:[], b3:[]};
    // for(var i = 0; i < len; i++){
    //     lv['card'][i] = document.getElementById("mcard"+i+"_lvH").value;
    //     // lv['m1'][i] = document.getElementById("mcard"+i+"_m1lvH").value;
    //     // lv['m2'][i] = document.getElementById("mcard"+i+"_m2lvH").value;
    //     // lv['b1'][i] = document.getElementById("mcard"+i+"_b1lvH").value;
    //     // lv['b2'][i] = document.getElementById("mcard"+i+"_b2lvH").value;
    //     // lv['b3'][i] = document.getElementById("mcard"+i+"_b3lvH").value;
    // }
    return {
      opCard: n['card'],
      opMagic: n['m'],
      opBuddy: n['b'],

      // cardLv: lv['card'],
      // m1Lv: lv['m1'],
      // m2Lv: lv['m2'],
      // b1Lv: lv['b1'],
      // b2Lv: lv['b2'],
      // b3Lv: lv['b3']
    }
  }
})