<?php
session_start();
include("funcs.php");
sch();

$title = $_POST["title"];
$naiyou= $_POST["naiyou"];
$u_name = $_SESSION["u_name"];
$u_id = $_SESSION["u_id"];
$u_pw = $_SESSION["u_pw"];
$view_img = fileUpload("view_img","view_img/");

//2. DB接続します
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO main_table(u_name,u_id,u_pw,title,naiyou, view_img, indate)VALUES(:u_name, :u_id, :u_pw, :title, :naiyou, :view_img, sysdate())";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_name', $u_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_id', $u_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_pw', $u_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':view_img', $view_img, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("main.php");
}
?>
