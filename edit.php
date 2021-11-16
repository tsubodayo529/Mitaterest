<?php
$id = $_GET["id"];
session_start();
include("funcs.php");
sch();


//2. DB接続します
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM main_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示

if($status==false) {
  sql_error($stmt);

}else{
  $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/edit.css">
    <title>Bad News 編集</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
</head>
<body>

<!-- Head[Start] -->
   <header>
        <!-- titleをクリックでメイン画面へ -->
        <div id="title">Mitaterest</div>
    </header>
    <!-- Head[End] -->

<!-- Main[Start] -->

    
    <div id="wrap">
        <!-- テキスト編集部分 -->
        <div id="edit_wrap">
            <form method="POST" action="edit_act.php" id="text_wrap">
                <div id="title_wrap">
                    <p>タイトルを変更</p>
                    <input type="text" name="title" value="<?=$row['title']?>" id="view_title">
                </div>
                <div id="naiyou_wrap">
                    <p>キャプションを変更</p>
                    <textArea name="naiyou" rows="4" cols="40"><?=$row["naiyou"]?></textArea>
                </div>
                <p>投稿日 : <?=$row["indate"]?></p>
                <div id="update_wrap">
                    <p id="update_text">更新</p>
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <input type="image" value="変更" src="img/update.png" id="update">
                </div>
            </form>
            <div id="go_map">
                <img src="img/plus2.png" alt="" id="plus">
                <img src="img/map.png" alt="" id="map">
            </div>
        </div>

            <!-- 画像表示部分 -->
            <div id="img_wrap">
                <img src="view_img/<?=$row["view_img"]?>" alt="" id="view_img">
            </div>
    </div>




<!-- Main[End] -->
<script src="js/bootstrap.min.js"></script>
<script>
    $("#title").on("click",function(){
        window.location.href = "main.php";
    })

    $("#go_map").on("click", function(){
        window.location.href = "map.php?id=<?=$id?>";
    })
</script>
</body>
</html>
