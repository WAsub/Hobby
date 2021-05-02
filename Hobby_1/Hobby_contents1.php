
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>modalをcomponentで作る</title>
  <script src="../lib/vue.js"></script> 
  <script src="https://unpkg.com/http-vue-loader"></script>
</head>
<body>
  <div id="con">
  <select-own 
    :op="'opMagic'"></select-own>
    <?php
      print '<select-own id="mcard'.$i.'_lv_one" name="mcard'.$i.'_lv_one" 
      :seled="1" 
      :op="\'opAddCard\'"></select-own>';
    ?>
  </div>
  <script src="../js/Hobby_1/Hobby_1_4_add.js"></script>
  <!-- <script src="https://unpkg.com/vue"></script>
  <script src="https://unpkg.com/http-vue-loader"></script> -->
</body>
</html>
