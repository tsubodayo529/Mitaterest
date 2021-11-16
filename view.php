<?php
//
session_start();
include("funcs.php");
sch();

$id = $_GET["id"];
$gu_name = $_SESSION["u_name"];
$gu_id = $_SESSION["u_id"];
$gu_pw = $_SESSION["u_pw"];
$pdo = db_conn();



//view読み込み
$stmt = $pdo->prepare("SELECT * FROM main_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
  sql_error($stmt);
}else{
  $row = $stmt->fetch();
}



// draw読み込み
$stmt2 = $pdo->prepare("SELECT * FROM draw_table WHERE id_view = :id ORDER BY rindate DESC");
$stmt2->bindValue(':id', $id, PDO::PARAM_INT);
$status2 = $stmt2->execute();

//３．データ表示

if($status2==false) {
    sql_error($stmt2);
}else{
  

 $view = "";
 $rtitle = array("key"=>"value");
 $rnaiyou = array("key"=>"value");
 $rgood = array("key"=>"value");
 
while( $row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
    
    $id_draw = $row2["id"];    
    
//表示に関する部分

    $view .= '<img class="draw_items"  src="draw_img/'.$row2["draw_img"].'" width="200px" id="'.$row2["id"].'">';


    //連想配列として各配列に挿入
    $rtitle[$row2["id"]] = $row2["rtitle"];
    $rnaiyou[$row2["id"]] = $row2["rnaiyou"];


        //drawに対するいいね数の読み込み
    $stmt4 = $pdo->prepare("SELECT * FROM good_draw_table WHERE id_draw = :id_draw");
    $stmt4->bindValue(':id_draw', $id_draw, PDO::PARAM_INT);
    $status4 = $stmt4->execute();
    
    if($status4==false) {
        sql_error($stmt4);
    }else{
        $view4 = "";
        $array4 = [];

        while( $row4 = $stmt4->fetch(PDO::FETCH_ASSOC)){
            $array4[] = $row4["id"]; 
        }
    }

    $gnum_draw = count($array4);
    $rgood[$row2["id"]] = $gnum_draw;

  }}


    // viewに対するいいね数の読み込み
    $stmt3 = $pdo->prepare("SELECT * FROM good_view_table WHERE id_view = :id");
    $stmt3->bindValue(':id', $id, PDO::PARAM_INT);
    $status3 = $stmt3->execute();

    //viewに対するいいね数表示
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
    
    
    
    //phpの連想配列をJson化
    $json_title = json_encode($rtitle);
    $json_naiyou = json_encode($rnaiyou);
    $json_good = json_encode($rgood);

    // echo $rtitle[12];



?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/view.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
</head>
<body>

<!-- Head[Start] -->
    <header>
        <!-- titleをクリックでメイン画面へ -->
        <div id="title">Mitaterest</div>
        <div type="button" id="canvas"></div>
    </header>
<!-- Head[End] -->

<!-- Main[Start] -->
<main>
<div id="wrap">
<!-- 画像の情報表示部分 -->
    <div id="intro_wrap">
        <div id="subtitle"><?=$row["title"]?></div>
        <div id="go_map"></div>
        <div id="naiyou"><?=$row["naiyou"]?></div>
        <div id="indate"><?=$row["indate"]?></div>

    <!-- 更新、削除ボタン -->
        <div id="btn_wrap">  
                <form method="POST" action="edit_chk.php">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <input type="image" src="img/edit.png" id="edit_btn" class="edit_btn">
                </form>
        
                <form method="POST" action="delete_chk.php">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <input type="image" src="img/delete.png" id="delete_btn" class="edit_btn">
                </form>
        </div>

    <!-- いいねボタン -->
        <div id="good_wrap">
            <form method="POST" action="good_insert_view.php">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <!-- <input type="hidden" name="id_rep" value="'.$row2["id"].'"> -->
                    <input type="image" src="img/good.png" id="good_btn">
            </form>
            <div id="good_num"><?=$gnum?></div>
        </div>
    </div>
<!-- 画像表示部分 -->
    <div id="img_wrap">
        <img src="view_img/<?=$row['view_img']?>">
    </div>
    
</div>

<div id="autoplay">
<?=$view?>
</div>

</main>



<div id="overlay"></div>
<div id="window">
    <img src="img/close.png" alt="" id="close">
    <div id="window_wrap">
        <div id="window_wrap_s">
            <div id="window_text">  
                <div id="draw_title"></div>
                <div id="draw_naiyou"></div>
            </div>
            <div id="window_good">
                <form method="POST" action="good_insert_draw.php">
                    <input type="hidden" name="id_draw" value="" id="id_draw">
                    <input type="hidden" name="id_view" value="<?=$id?>">
                    <input type="image" src="img/good.png" id= "good_num_btn">
                </form>
                <div id="good_num_draw"></div>
            </div>  
        </div>
        <div id="window_img_wrap">
            <img src=""  id="draw_item">
        </div>
    </div>
</div>

<!-- Main[End] -->



<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>

<script>
$(".edit_btn").hide();

$("#title").on("click", function(){
    window.location.href = "main.php";
})

$("#canvas").on("click", function(){
    window.location.href = "draw.php?id=<?=$id?>";
})

$("#overlay").hide();
$("#window").hide();

$(".draw_items").on("click", function(){
    $("#overlay").show();
    $("#window").show();
    //クリックした部分のidを取得
    let drawId = $(this).attr("id");
    // console.log(drawId);
    // console.log(this.src);
  	$("#draw_item").attr("src", this.src);
    //json化してjavascript内変数に代入
    let json_title = <?=$json_title?>;
    let json_naiyou = <?=$json_naiyou?>;
    let json_good = <?=$json_good?>;

    //クリックした部分のidをkeyとしてjson内からvalue取得
    $("#draw_title").html(json_title[drawId]);
    $("#draw_naiyou").html(json_naiyou[drawId]);
    $("#good_num_draw").html(json_good[drawId]);
    $("#id_draw").val(drawId);

    // モーダルウィンドウを中央配置する関数
      function modalResize(){
 
        var w = $(window).width();
        var h = $(window).height();
 
        var cw = $("#window").outerWidth();
        var ch = $("#window").outerHeight();

        console.log("モーダル")
    //取得した値をcssに追加する
        $("#window").css({
            "left": ((w - cw)/2) + "px",
            "top": ((h - ch)/2) + "px"
        });
     }

     modalResize();

     $("#overlay").on("click", function(){
        $("#window").hide();
        $("#overlay").hide();
     })
    
})

$("#close").on("click", function(){
    $("#window").hide();
    $("#overlay").hide();
})

$("#go_map").on("click", function(){
    window.location.href = "root.php?id=<?=$id?>"
})

if('<?=$row["location"]?>'==''){
    $("#go_map").hide();
}



if("<?=$gu_id?>"=='<?=$row["u_id"]?>'){
    console.log("ok");
    $(".edit_btn").show();
}else{
    console.log("no");
}


$('#autoplay').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
});
</script>

</body>
</html>