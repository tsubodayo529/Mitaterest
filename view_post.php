<?php
session_start();
include("funcs.php");
sch();
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/view_post.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
    <title></title>
</head>
<body>

<!-- Head[Start] -->
<header>
        <!-- titleをクリックでメイン画面へ -->
        <div id="title">Mitaterest</div>
</header>
<!-- Head[End] -->
<main>
<!-- Main[Start] -->
    <h3>新規投稿</h3>
    <div id="wrap">
        <form method="POST" action="view_post_act.php" enctype="multipart/form-data" id="input_wrap">
            <!-- 写真を描画するcanvas -->
                <input type="text" name="title" placeholder="タイトル" id="view_title"><br>
                <textArea name="naiyou" rows="10" cols="20" placeholder="キャプションを追加" id="textarea"></textArea>
            
            <p>画像を選択してください</p> 
            <input type="file" name="view_img" id="file" accept="image/*">
            
            <input type="submit" value="Mitaterestに投稿" class="btn btn-primary">
            <!-- ↓↓選択した画像を表示する部分↓↓ -->
        </form>
            <div id="img_wrap">
                <img id="preview">
            </div>
    </div>

</main>
<!-- Main[End] -->

<script src="js/bootstrap.min.js"></script>
<script>

$("#title").on("click", function(){
    window.location.href = "main.php";
})

$('#file').on('change', function (e) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $("#preview").attr('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
});

</script>

</body>
</html>
