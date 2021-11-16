<?php
session_start();
include("funcs.php");
sch();

$ru_name = $_SESSION["u_name"];
$ru_id = $_SESSION["u_id"];
$ru_pw = $_SESSION["u_pw"];
$rtitle = $_POST["rtitle"];
$rnaiyou= $_POST["rnaiyou"];
$id_view = $_POST["id_view"];
$draw_img = fileUpload("draw_img","draw_img/");

//2. DB接続します
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO draw_table(id_view, ru_id, ru_pw, ru_name, rtitle, rnaiyou, draw_img, rindate)VALUES(:id_view, :ru_id, :ru_pw, :ru_name, :rtitle, :rnaiyou, :draw_img, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id_view', $id_view, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ru_id', $ru_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ru_pw', $ru_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ru_name', $ru_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rtitle', $rtitle, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rnaiyou', $rnaiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':draw_img', $draw_img, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("view.php?id=".$id_view);
}
?>
