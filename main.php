<?php
session_start();
include("funcs.php");

sch();


//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM main_table ORDER BY indate DESC");
$status = $stmt->execute();

//３．データ表示
$view=""; //作成したHTML文字を入れる変数
if($status==false) {
  sql_error($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    // $view .= "<p>".$res["indate"]." - ".$res["id"]." - ".$res["name"]." - ".$res["naiyou"]."</p>"; //$res["email"]

    $id_view = $res["id"];


    // いいね数の読み込み
    $stmt3 = $pdo->prepare("SELECT * FROM good_view_table WHERE id_view = :id_view");
    $stmt3->bindValue(':id_view', $id_view, PDO::PARAM_INT);
    $status3 = $stmt3->execute();

    //３．データ表示

    if($status3==false) {
        sql_error($stmt3);
    }else{
    $view3 = "";
    $array3 = [];
   
    while( $row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
        $array3[] = $row3["id"]; 
    }
}
    $gnum = count($array3);



    $view .= '<li class="post_box" id="'.$res["id"].'">';
    $view .= '<img src="view_img/'.$res["view_img"].'" width="300px">';
    $view .= "</li>";


    
  }
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タイムライン</title>
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>

<body>
<header>
    <div id="title"> 
        Mitaterest
    </div> 

    <div id="logout"></div>
    <div id="post"></div>
</header>


<main>
    <ul><?=$view?></ul>
</main>





<!-- bootstrap install -->
<!-- <script>
    $(".post_box").on("click", function(){
        console.log("ok");
        // 
    });
</script> -->
<script>


    $(".post_box").on("click", function(){
        let a = $(this).attr('id');
        window.location.href = "view.php?id="+a;
    })

    $("#logout").on("click", function(){
        window.location.href = "logout.php";
    })

    $("#post").on("click", function(){
        window.location.href = "view_post.php";
    })


</script>

</body>
</html>