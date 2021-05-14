<?php
    session_start();
    var_dump($_FILES);
    $input = file_get_contents('php://input');
    var_dump("<br><br>");
    var_dump($_POST);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>JavaScriptのFileAPIで画像のプレビュー</title>
<script src="../lib/vue.js"></script> 
<script src="https://unpkg.com/http-vue-loader"></script>

</head>

<body>
  <form method="post" action="Hobby_contents1.php" enctype="multipart/form-data">
    <!-- <label for="inputfile">
      <img id="preview2" src="../img/Hobby_1/none.jpg" width="100" height="100">
      <input type="file" id="inputfile" accept='image/*' onchange="previewImage(this);">
    </label> -->
    <input type="text"name="fnamer" value="0" >
      
    <div id="con">
    <!-- <input-file-own :id="'fname1'" :name="'fname1'"></input-file-own>
    <input-file-own :id="'fname2'" :name="'fname2'"></input-file-own> -->
    <?php
    $i = 1;
    print     '<input-file-own :id="\'mcard'.$i.'\'" :name="\'mcard'.$i.'\'"></input-file-own>';
    ?>
    </div>
    <button type="submit" name="submit" value="アップロード">アップロード</button>
    <!-- <input type="submit" value="アップロード"> -->
  </form>
  <?php
  $input = file_get_contents('php://input');
    $tempfile1 = $_FILES['fname1']['tmp_name']; // 一時ファイル名
    $filename1 = '../img/Hobby_1/'.$_FILES['fname1']['name']; // 本来のファイル名
    $tempfile2 = $_FILES['fname2']['tmp_name']; // 一時ファイル名
    $filename2 = '../img/Hobby_1/'.$_FILES['fname2']['name']; // 本来のファイル名
    var_dump("<br><br>");
    
    var_dump($input);
    var_dump("<br><br>");
    var_dump("<br><br>");
    var_dump($_FILES);
    if (is_uploaded_file($tempfile1)) {
        if ( move_uploaded_file($tempfile1 , $filename1 )) {
      echo $filename1 . "をアップロードしました。";
        } else {
            echo "ファイルをアップロードできません。";
        }
    } else {
        echo "ファイルが選択されていません。";
    } 
    if (is_uploaded_file($tempfile2)) {
        if ( move_uploaded_file($tempfile2 , $filename2 )) {
      echo $filename2 . "をアップロードしました。";
        } else {
            echo "ファイルをアップロードできません。";
        }
    } else {
        echo "ファイルが選択されていません。";
    } 
  ?>


  <script>
  new Vue({
    el: "#con",
    components: {
      'select-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/select-own.vue'),
      'choice-modal-img': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/choice-modal-img.vue'),
      'img-select': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/img-select.vue'),
      'input-file-own': httpVueLoader('http://haveabook.php.xdomain.jp/editing/js/Hobby_1/input-file-own.vue'),
    }
  });
  </script>
  
</body>

</html>

