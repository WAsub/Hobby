Vue.component('select-own',{
	props: {
	  seled: null,
	  op: null
	},
	template : `
	  <select v-model="seled">
		<option v-for="option in op" v-bind:value="option.value">
		  {{ option.key }}
		</option>
	  </select>
	  `
  });
  new Vue({
	el: '#con',
	data: function () {
	  var n = {card:[], m:[], b:[]};
	  for(var i = 0; i <= 100; i++){ n['card'][i] = {key: i, value: i};}
	  for(var i = 1; i <= 10; i++){ n['m'][i-1] = {key: i, value: i};}
	  for(var i = 0; i <= 10; i++){ n['b'][i] = {key: i, value: i};}
	  return {
		opCard: n['card'],
		opMagic: n['m'],
		opBuddy: n['b']
	  }
	}
  })