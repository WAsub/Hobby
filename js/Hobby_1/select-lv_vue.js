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
	  return {
		opCard: n['card'],
		opMagic: n['m'],
		opBuddy: n['b']
	  }
	}
  })