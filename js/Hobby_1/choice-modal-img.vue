<template>
	<div>
		<img v-for="imgSRC in imgBuddy" 
			:src="'../img/Hobby_1/Another/'+imgSRC" 
			:key="imgSRC.key" 
			@click="sendIcon(imgSRC)" 
			alt="" width="30" height="30">
	</div>
</template>
 
<script>
module.exports = {
	props: {
	},
	data: function () {
		return {
			imgBuddy: {
				11: '11.jpg', 12: '12.jpg', 13: '13.jpg', 14: '14.jpg', 15: '15.jpg',
				21: '21.jpg', 22: '22.jpg', 23: '23.jpg',
				31: '31.jpg', 32: '32.jpg', 33: '33.jpg',
				41: '41.jpg', 42: '42.jpg',
				51: '51.jpg', 52: '52.jpg', 53: '53.jpg',
				61: '61.jpg', 62: '62.jpg',
				71: '71.jpg', 72: '72.jpg', 73: '73.jpg', 74: '74.jpg'
			},
			showFlg: true,
		}
	},
	methods:{
		sendIcon(value){
			/** クリックしたアイコンを親コンポーネントに送る */
			this.$emit('catch-icon', value);
		},
	}
}
// export default { Node.jsじゃないから、これだとダメだった。 }
</script>
 
<style scoped>
	div{
		width: 180px;
		padding: 3px;
		border: 2px solid gray;
		background-color: #fbfaf5;
	}
	img{
		margin: 2px;
		border: 1px solid black;
	}
</style>