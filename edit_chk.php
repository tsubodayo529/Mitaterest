<?php
session_start();
$id = $_POST["id"];
$u_id = $_SESSION["u_id"];
$u_pw = $_SESSION["u_pw"];
$u_name = $_SESSION["u_name"];

include("funcs.php");
$pdo = db_conn();



//３．データ登録SQL作成
$sql = "SELECT * FROM main_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]); //配列[2]だけが読めるエラー文字
}
else{
$val = $stmt->fetch();
}

if ($val["id"] != "" && $u_id == $val["u_id"] && $u_pw == $val["u_pw"]){
    header('Location: edit.php?id='.$val["id"]);
    
   
}else{
    echo "投稿者本人しか編集はできません。";
    exit();
}
?>
