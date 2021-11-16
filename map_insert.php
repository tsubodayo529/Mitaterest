<?php
session_start();
include("funcs.php");
sch();

$id = $_POST["id"];
$location = $_POST["location"];

//2. DB接続します
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "UPDATE main_table SET location=:location WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':location', $location, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

// //４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("main.php");
}
?>
