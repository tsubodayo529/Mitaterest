<?php

$id = $_GET["id"];

include("funcs.php");

$pdo = db_conn();


//３．データ登録SQL作成
$sql = "DELETE FROM main_table WHERE id=:id ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
 sql_error();
}else{
  redirect("main.php");
}
?>