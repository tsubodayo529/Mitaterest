<?php
//1. POSTデータ取得
$u_id   = $_POST["u_id"];
$u_pw  = $_POST["u_pw"];
$u_name  = $_POST["u_name"];


//2. DB接続します(エラー処理追加)
include("funcs.php");
$pdo = db_conn();

$img = fileUpload("img","profile_img/");

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO login_table( u_id, u_pw, u_name, img, indate)VALUES( :u_id, :u_pw, :u_name, :img, sysdate())");
$stmt->bindValue(':u_id',   $u_id);
$stmt->bindValue(':u_pw',  $u_pw);
$stmt->bindValue(':u_name', $u_name);
$stmt->bindValue(':img',    $img);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("login.php");
}
?>
