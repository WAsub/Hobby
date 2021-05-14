<template>
	<div>
		<select :id="id_name[0]" :name="id_name[0]" v-model="selected" @change="restriction('opAddM_effect1', $event)">
			<option v-for="option in options['opAddM_effect1']" 
				:key="option.value" 
				:value="option.value">
				{{ option.key }}
			</option>
		</select><br>
        <select-own :id="id_name[1]" :name="id_name[1]" 
            :op="'opAddM_effect2'" 
			:disabled="true" 
			ref="ef2"></select-own>
        <select-own :id="id_name[2]" :name="id_name[2]" 
            :op="'opAddM_effect3'" 
			:disabled="true" 
			ref="ef3"></select-own>
	</div>
</template>
 
<script>
module.exports = {
	components: {
		'select-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-own.vue'),
		'img-select': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/img-select.vue'),
  	},
	props: {
		id_name: {default:()=>[]},
	},
	data: function () {
		return {
			selected: "",
			options:{
				opAddM_effect1: [
					{key: "なし", value: ""},
					{key: "ATK UP", value: "au"}, {key: "ﾀﾞﾒｰｼﾞ UP", value: "du"}, {key: "ATK DOWN", value: "ad"}, {key: "ﾀﾞﾒｰｼﾞ DOWN", value: "dd"},
					{key: "HP回復", value: "re"},　{key: "HP継続回復", value: "cr"}, {key: "被ﾀﾞﾒｰｼﾞ DOWN", value: "td"}, 
					{key: "火ﾀﾞﾒｰｼﾞ UP", value: "fu"}, {key: "木ﾀﾞﾒｰｼﾞ UP", value: "tu"}, {key: "水ﾀﾞﾒｰｼﾞ UP", value: "wu"}, {key: "無ﾀﾞﾒｰｼﾞ UP", value: "nu"},
					{key: "回避", value: "ev"}, {key: "呪い", value: "cu"}
				],
			}
		}
	},
	methods:{
		restriction(op, event){
			var value = event.target.value;
			switch(op){
				case "opAddM_effect1":
					switch(value){
						case "":
							this.$refs.ef2.chengeDisabled(true);
							this.$refs.ef3.chengeDisabled(true);
							break;
						default:
							this.$refs.ef2.chengeDisabled(false);
							this.$refs.ef3.chengeDisabled(false);
					}
					break;
				default:
			}
		}
	}
}
// export default { Node.jsじゃないから、これだとダメだった。 }
</script>
 
<style scoped>
	.duoimg{
		position: relative;
		height: 30px;
		width: 30px;
	}
	.hide{
		position: absolute;
		top: 5px;
		left: 5px;
		height: 33px;
		width: 33px;
		z-index: 2;
		background-color: rgba(0, 0, 0, 0.4);
	}
	.show{
		display: none;
	}
</style>