<template>
  	<select v-model="selected" :disabled="isDisabled">
		<option v-for="option in options[this.op]" :key="option.value" v-bind:value="option.value">
			{{ option.key }}
		</option>
	</select>
</template>
 
<script>
module.exports = {
	props: {
		initial: {default:()=>[]},
		op: String,
		disabled: {default: false}
	},
	data: function () {
		var n = {card:[], lv:[], addC: [{key: 1, value: 1}], addM_t:[]};
		for(var i = 0; i <= 100; i++){ n['card'][i] = {key: i, value: i};}
		for(var i = 1; i <= 10; i++){ n['lv'][i-1] = {key: i, value: i};}
		for(var i = 2; i <= 5; i++){ n['addC'][i-1] = {key: i*20, value: i*20};}
		for(var i = 1; i <= 2; i++){ n['addM_t'][i-1] = {key: i+"連", value: i};}
		return {
			selected: this.initial,
			isDisabled: this.disabled,
			options:{
				opCard: n['card'],
				opLv: n['lv'],
				opAddCard: n['addC'],
				opAddM_timas: n['addM_t'],
				opAddM_power: [{key: "弱", value: "S"}, {key: "強", value: "L"}],
				opAddM_effect1: [
					{key: "なし", value: "nN"},
					{key: "ATK UP", value: "au"}, {key: "ﾀﾞﾒｰｼﾞ UP", value: "du"}, {key: "ATK DOWN", value: "ad"}, {key: "ﾀﾞﾒｰｼﾞ DOWN", value: "dd"},
					{key: "HP回復", value: "re"},　{key: "HP継続回復", value: "cr"}, {key: "被ﾀﾞﾒｰｼﾞ DOWN", value: "td"}, 
					{key: "火ﾀﾞﾒｰｼﾞ UP", value: "fu"}, {key: "木ﾀﾞﾒｰｼﾞ UP", value: "tu"}, {key: "水ﾀﾞﾒｰｼﾞ UP", value: "wu"}, {key: "無ﾀﾞﾒｰｼﾞ UP", value: "nu"},
					{key: "回避", value: "ev"}, {key: "呪い", value: "cu"}, {key: "デュオ魔法", value: "DUO"}
				],
				opAddM_effect2: [{key: "**", value: ""},{key: "極小", value: "s"}, {key: "小", value: "S"}, {key: "中", value: "M"}, {key: "大", value: "L"}],
				opAddM_effect3: [{key: "**", value: ""},{key: "1T", value: "1"}, {key: "2T", value: "2"}, {key: "3T", value: "3"}],
				opAddB:[{key: "***", value: ""},{key: "ATK UP(中)", value: "Am"}, {key: "ATK UP(小)", value: "As"}, {key: "HP UP(中)", value: "Hm"}, {key: "HP UP(小)", value: "Hs"}]
			}
		}
	},
	methods:{
		chengeDisabled(value){
			this.isDisabled = value;
		},
	}
}
// export default { Node.jsじゃないから、これだとダメだった。 }
</script>
 
<style scoped>
</style>