<?php
session_start();
include("funcs.php");
sch();


//$idは選択したviewのid

$id = $_GET["id"];

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM main_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
  sql_error($stmt);
}else{
//$rowにはviewの情報が入っている
  $row = $stmt->fetch();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/draw.css">
    <title>新規投稿</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
</head>


<body>

<!-- Head[Start] -->
<header>
        <div id="title">Mitaterest</div>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div id="wrap">
        <!-- テキスト部分 -->
        <div id="text_wrap">
            <div>
                <div id="color_wrap">
                    <div id="color_icon"></div>
                    <input type="color" id="color">
                </div>
                <div id="width_wrap">
                    <div id="width_icon"></div>
                    <input type="range" id="width_range" min="1" max="30" val="5">
                </div>
            </div>
            <div id="save_wrap">
                <div id="clear"></div>
                
                <a id="save" href="#" download="paint.jpg">
                    <img src="img/download.png" class="download">
                </a>
            </div>
            
            <form action="draw_act.php" method="POST" enctype="multipart/form-data" id="input_wrap">    
                    <input type="text" name="rtitle" placeholder="タイトル" id="draw_title"><br>
                    <textArea name="rnaiyou" rows="3" cols="20" id="textarea" placeholder="キャプションを追加"></textArea>
            <div id="form_wrap">
                <p class="text">
                    <img src="img/download.png" alt="" class="download"> を押して画像をダウンロードしてください
                </p>
                <div id="file_wrap">
                    <p> ダウンロードしたファイルを選択してください</p>
                    <input type="file" name="draw_img" id="file" accept="image/*">
                </div>
                <input type="hidden" name="id_view" value="<?=$row["id"]?>">
                <input type="submit" value="投稿" id="submit">
            </form>
            </div>
        </div>
        <div>
        <!-- 描画部分 -->
            <canvas id="canvas" width="650" height="650"></canvas>
        </div>
    </div>

</div>
 
<!-- Main[End] -->

<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
$("#title").on("click", function(){
    window.location.href = "main.php";
})

let canvas_mouse_event = false; //スイッチ
let oldX = 0; //スタート地点のXを入れている
let oldY = 0; //スタート地点のYを入れている
let bold_line = 50; //ラインの太さ指定
let color = "black"; //ラインの色を指定


const can = $("#canvas")[0];
const ctx = can.getContext("2d");
const chara = new Image();
chara.src = "view_img/<?=$row['view_img']?>";  // 画像のURLを指定
// chara.onload = () => {
//     ctx.drawImage(chara, 0, 0, can.width, can.height);
// };

function make_image(){
        var canvasAspect = ctx.canvas.width / ctx.canvas.height, // canvasのアスペクト比
            imgAspect = chara.width / chara.height, // 画像のアスペクト比
            left, top, width, height;

        ctx.fillStyle = "black";
        ctx.fillRect(0, 0, ctx.canvas.width, ctx.canvas.height);

        if(imgAspect >= canvasAspect) {// 画像が横長
            left = 0;
            width = ctx.canvas.width;
            height = ctx.canvas.width / imgAspect;
            top = (ctx.canvas.height - height) / 2;
        } else {// 画像が縦長
            top = 0;
            height = ctx.canvas.height;
            width = ctx.canvas.height * imgAspect;
            left = (ctx.canvas.width - width) / 2;
        }
        ctx.drawImage(chara, 0, 0, chara.width, chara.height, 
            left, top, width, height);
            }

chara.onload = function() {
        make_image();
    };



// let can_w = "view_img/<?=row['view_img']?>".width;

   


    $(can).on("mousedown", function(e){ //canの中に#canvasが代入されている
        //eの中にクリックした場所が代入されている
        // console.log(e);
        color = $("#color").val();
        bold_line = $("#width_range").val();
        oldX = e.offsetX;
        oldY = e.offsetY;
        canvas_mouse_event = true;
    });


    $(can).on("mousemove", function(e){
        // console.log(e.offsetX);
        if(canvas_mouse_event==true){ //mousedownしてから描画するように設定
            const px = e.offsetX;
            const py = e.offsetY;
            ctx.strokeStyle = color; 
            ctx.lineWidth = bold_line;
            ctx.beginPath();
            ctx.lineJoin = "round";
            ctx.lineCap ="round";
            ctx.moveTo(oldX, oldY);
            ctx.lineTo(px, py);
            ctx.stroke();
            oldX = px;
            oldY = py;
        }
    });


    let file_check = $("#file").val().length;
	
	//値が無ければボタンを非表示
	

    $(window).on("mouseup", function(){
        canvas_mouse_event = false;
    })
    
    $("#clear").on("click", function(){
        ctx.beginPath();
        ctx.clearRect(0, 0, can.width, can.height); //範囲内の要素を消去
        make_image();
        // ctx.drawImage(chara, 0, 0, can.width, can.height);
    })

    $("#save").click(function () {
            console.log("ok");
            let canvas = document.getElementById('canvas');
            var base64 = canvas.toDataURL("image/jpeg");
            document.getElementById("save").href = base64;
    });
    $("#submit").hide();
    $("#file_wrap").hide();

    $("#save").on("click", function(){
        $("#file_wrap").show();
        $(".text").hide();
    })

    $("#file").on("change", function(){
        $("#submit").show();
    });

//input内でのEnterキーの無効化
    $(function(){
        $("input"). keydown(function(e) {
            if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
                return false;
            } else {
                return true;
            }
        });
    });


   
// var file = document.getElementById('backimg_uploads');
// var canvas = document.getElementById('canvas');
// var uploadImgSrc;


// function loadLocalImage(e) {
//   // ファイル情報を取得
//   var fileData = e.target.files[0];

//   // 画像ファイル以外は処理を止める
//   if(!fileData.type.match('image.*')) {
//     alert('画像を選択してください');
//     return;
//   }

//   // FileReaderオブジェクトを使ってファイル読み込み
//   var reader = new FileReader();
//   // ファイル読み込みに成功したときの処理
//   reader.onload = function() {
//     // Canvas上に表示する
//     uploadImgSrc = reader.result;
//     canvasDraw();
//   }
//   // ファイル読み込みを実行
//   reader.readAsDataURL(fileData);
// }

// // ファイルが指定された時にloadLocalImage()を実行
// file.addEventListener('change', loadLocalImage, false);

// // Canvas上に画像を表示する
// function canvasDraw() {
//   // canvas内の要素をクリアする
//   ctx.clearRect(0, 0, can.width, can.height);

//   // Canvas上に画像を表示
//   var img = new Image();
//   img.src = uploadImgSrc;
//   img.onload = function() {
//     ctx.drawImage(img, 0, 0, can.width, this.height * (can.width / this.width));
//   }
// }


</script>

</body>
</html>
