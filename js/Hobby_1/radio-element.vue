<template>
	<div>
		<span v-for="item in items" :key="item.key">
			<input type="radio" :id="id+'_'+item.value" :name="name" :value="item.value">
			<label :for="id+'_'+item.value">
				<img :src="'../img/Hobby_1/Element/'+item.key" width="30" height="30">
			</label>
		</span>
	</div>
</template>
 
<script>
module.exports = {
	props: {
		id: {default:"radio", required:true},
		name: {default:"radio", required:true}
	},
	data: function () {
		return {
			items: [{key: "Nomal.jpg", value: "0"},{key: "Fire.jpg", value: "1"},{key: "Tree.jpg", value: "2"},{key: "Water.jpg", value: "3"},],
		}
	},
}
// export default { Node.jsじゃないから、これだとダメだった。 }
</script>
 
<style scoped>
    input[type=radio] {
    	display:none; 
    }
    label {
		display: inline-block;
		width: 30px;
		height: 30px;
    }
	span{
		display: inline-flex;
		justify-content: center;
		align-items: center;
		width: 40px;
		height: 40px;
	}
	input[type=radio]:checked + label {
		border: 2px solid #303030;
		border-radius: 2px;
	}
</style>