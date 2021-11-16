<?php
session_start();
include("funcs.php");
sch();

$id = $_GET["id"];

?>

<!DOCTYPE html>
<html lang="ja">
<head>
 <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/map.css">
    <title>Bad News 編集</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> 
    <style>html,body{height:100%;}body{padding:0;margin:0;}h1{padding:0;margin:0;font-size:50%;}#geocode{font-size: 120%;}</style>
</head>
<body>
    <header>
        <!-- titleをクリックでメイン画面へ -->
        <div id="title">Mitaterest</div>
    </header>


<!-- MAP[START] -->
<div id="text">
    <p>写真の場所を地図上でクリックして「決定」ボタンを押してください</p>
    <div id="geocode"></div>
</div>
    <div id="myMap" style='width:80%;height:75%;'></div>
    <!-- MAP[END] -->


    <form action="map_insert.php" method="post" id="form">
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="hidden" name="location" value="" id="location">
        <input type="submit" value="決定" id="submit">
    </form>


<script src="js/jquery-2.1.3.min.js"></script>
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AtZn5wsAvmk3MoBM9PNVXPtSYHwGl9nAGaTaKl5TbxWj7Zy54FrKbovhJAGMj2A9' async defer></script>
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
    map.startMap(47.6149, -122.1941, "load", 10);

    //----------------------------------------------------
    //3. Geocode(2 patterns)
    // getGeocode("searchQuery",callback);
    //----------------------------------------------------
    
    // A. Address "Seattle"
    map.getGeocode("Tokyo", function(data){
        console.log(data);          //Get Geocode ObjectData
        const lat = data.latitude;  //Get latitude
        const lon = data.longitude; //Get longitude
        // document.querySelector("#geocode").innerHTML='緯度'+lat+', 経度'+lon;
    });
    
        map.onGeocode("click", function(clickPoint){
            const lat = clickPoint.location.latitude;  //Get latitude
            const lon = clickPoint.location.longitude;
            let pin = map.pin(lat, lon, "#ff0000");
            map.onPin(pin, "click", function () {
                map.deletePin();
            });
            map.reverseGeocode(clickPoint.location, function(data){
            // console.log(data);
            
            document.querySelector("#geocode").innerHTML=data;
            $("#location").val(data);
        });
    });

    
$("#title").on("click", function(){
    window.location.href = "main.php";
})

}
    
</script>
</body>
</html>