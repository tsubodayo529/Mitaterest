<?php
session_start();
include("funcs.php");
sch();
$id_draw = $_POST["id_draw"];
$id_view = $_POST["id_view"];
$gu_name = $_SESSION["u_name"];
$gu_id = $_SESSION["u_id"];
$gu_pw = $_SESSION["u_pw"];

//2. DB接続します
$pdo = db_conn();


$stmt3 = $pdo->prepare("SELECT * FROM good_draw_table WHERE id_draw = :id_draw AND gu_id = :gu_id AND gu_pw = :gu_pw");
    $stmt3->bindValue(':id_draw', $id_draw, PDO::PARAM_INT);
    $stmt3->bindValue(':gu_id', $gu_id, PDO::PARAM_STR);
    $stmt3->bindValue(':gu_pw', $gu_pw, PDO::PARAM_STR);
    $status3 = $stmt3->execute();

    //３．既に「いいね！」をしていないのかのチェック
$chc ="";
    if($status3==false) {
        sql_error($stmt3);
    }else {
    $res = $stmt3->fetch();
    if($res != []){
    $chc = "done";}
    
    }


//「いいね」をしていない場合登録
if($chc != "done"){
$sql = "INSERT INTO good_draw_table(id_draw,gu_name,gu_id,gu_pw)VALUES(:id_draw, :gu_name, :gu_id, :gu_pw)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id_draw', $id_draw, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gu_name', $gu_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gu_id', $gu_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':gu_pw', $gu_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("view.php?id=".$id_view);
}
}
else{
  redirect("view.php?id=".$id_view);
}


?>
