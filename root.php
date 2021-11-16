<?php

session_start();
include("funcs.php");

sch();


$id = $_GET["id"];

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


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/root.css">
    <title>Bad News 編集</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
    <title></title>
    <!-- <style>html,body{height:100%;}body{padding:0;margin:0;}h1{padding:0;margin:0;font-size:50%;}div{float:left;}</style> -->
</head>
<body>
    <header>
        <!-- titleをクリックでメイン画面へ -->
        <div id="title">Mitaterest</div>
    </header>

    <div id="option">
        <!-- From:<input type="text" id="from" value="御茶ノ水">
        To:<input id="to" value="表参道"> -->
        <select id="mode">
            <option value="driving">車</option>
            <option value="walking">徒歩</option>
        </select>
        <!-- <input type="button" id="search" value="ルート検索"> -->
        <div id="search">
            <img src="img/root.png" alt="" id="root">
        </div>
    </div>

<!-- MAP[START] -->
<div id="map_wrap">

<div id="myMap" style='width:60%;height:70%;'></div>
<!-- MAP[END] -->


<!--Directions[START]-->

    <div id="direction"></div>


<!-- Directions[END] -->
</div>



<script src="js/jquery-2.1.3.min.js"></script>
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AtZn5wsAvmk3MoBM9PNVXPtSYHwGl9nAGaTaKl5TbxWj7Zy54FrKbovhJAGMj2A9 &setLang=ja&setMkt=ja-JP' async defer></script>
<script src="js/BmapQuery.js"></script>
<script>
//****************************************************************************************
// BingMaps&BmapQuery
//****************************************************************************************
//Init
function GetMap(){
    //------------------------------------------------------------------------
    //1. Instance
    //------------------------------------------------------------------------
    const map = new Bmap("#myMap");

    //------------------------------------------------------------------------
    //2. Display Map
    //   startMap(lat, lon, "MapType", Zoom[1~20]);
    //   MapType:[load, aerial,canvasDark,canvasLight,birdseye,grayscale,streetside]
    //--------------------------------------------------
    map.startMap(35.665100, 139.712000, "load", 15);

    //------------------------------------------------------------------------
    //3. Directions
    // map.direction("#rootView", "from" , "to", waypoint[array]);
    // !! 日本地図で表示してる場合のみルート検索可能（各国毎）以下パラメータ指定で制御も可能 !!
    // +  [ English => https://www.bing.com/...&setLang=en&setMkt=en-US ]
    // +  [ Japan   => https://www.bing.com/...&setLang=ja&setMkt=ja-JP ]
    //------------------------------------------------------------------------
    document.getElementById("search").onclick = function () {

        //現在地情報取得
        map.geolocation(function (position) {
            console.log("位置情報取得開始")
            console.log(position.coords);
            map.reverseGeocode(position.coords, function(data){

            console.log(data);
                // let coords = position.coords;

                // let pos_lat = coords.latitude;
                // let pos_lon = coords.longitude;
            

            //Get From,To
            // const from  = document.getElementById("from").value;  //StartPoint
            const from  = data;  //StartPoint
            console.log(data);
            const to    = "<?=$row["location"]?>"; //EndPoint
            // const to    = $("#to").val(); //EndPoint
            const mode  = document.getElementById("mode").value;  //RouteMode[walking,driving]
            //経由地あり
            // const array = ["新宿", "恵比寿"];                       //Waypoints...
            map.direction("#direction", mode, from, to, []);

            //経由地なし
            //map.direction("#direction", from , to, []);
            });
        });
    };

}

$("#title").on("click", function(){
    window.location.href = "main.php";
})

</script>
</body>
</html>
