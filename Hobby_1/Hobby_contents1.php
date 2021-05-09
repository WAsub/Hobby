
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>JavaScriptのFileAPIで画像のプレビュー</title>
<script src="../lib/vue.js"></script> 
<script src="https://unpkg.com/http-vue-loader"></script>

</head>

<body>
    <div id="con">
    <!-- <choice-modal-img></choice-modal-img> -->
    <select-effect 
      :id_name="['ef1','ef2','ef3','imgchoise']"
    ></select-effect>
    <br>
    <!-- <radio-element :id="'radi'" :name="'radi'"></radio-element> -->
    </div>

    <script>
    new Vue({
      el: "#con",
      components: {
        'select-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-own.vue'),
        'select-effect': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-effect.vue'),
        'choice-modal-img': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/choice-modal-img.vue'),
        'img-select': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/img-select.vue'),
        'input-file-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/input-file-own.vue'),
        'radio-element': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/radio-element.vue'),
      }
    });
    </script>
  
</body>

</html>

