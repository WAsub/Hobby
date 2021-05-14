new Vue({
	el: "#con",
	components: {
		'select-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-own.vue'),
		'select-effect': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-effect.vue'),
		'select-effect2': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-effect2.vue'),
		'choice-modal-img': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/choice-modal-img.vue'),
		'img-select': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/img-select.vue'),
      	'input-file-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/input-file-own.vue'),
		'radio-element': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/radio-element.vue'),
	}
});