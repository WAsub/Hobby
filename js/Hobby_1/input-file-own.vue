<template>
	<label :for="this.id">
      <img :src="preview" width="70.5" height="74.7">
      <input :id="this.id" :name="this.name" type="file" accept='image/*' @change="readImage()">
	  <span>{{ fileName }}</span>
    </label>
</template>
 
<script>
module.exports = {
	props: {
		id: {default:"inputfile", required:true},
		name: {default:"inputfile", required:true},
		defaImg: {default:"../img/Hobby_1/none.jpg"},
		defaName: {default:"未選択"}
	},
	data: function () {
		return {
			preview: this.defaImg,
			fileName: this.defaName
		}
	},
	methods: {
		readImage() {
			const inputImage = document.getElementById(this.id);
			if (inputImage.files.length === 0) {
				return;
			}
			const fileReader = new FileReader();
			fileReader.onload = (e) => {
				this.preview = e.target.result;
			}
			fileReader.readAsDataURL(inputImage.files[0]);
			//ファイル名表示
			this.fileName = inputImage.files[0].name;
		},
	},
}
// export default { Node.jsじゃないから、これだとダメだった。 }
</script>
 
<style scoped>
	img{
		border: 1px solid #AAAAAA;
	}
    label > input {
    	display:none; 
    }
    label {
    	color: #303030; 
    }
</style>