
<?php

session_start();
include("funcs.php");

$u_id = $_SESSION["u_id"];
$u_pw = $_SESSION["u_pw"];
$u_name = $_SESSION["u_name"];
$id = $_POST["id"];



//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "SELECT * FROM main_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
  sql_error();
}

$val = $stmt->fetch();

if ($val["id"] != "" && $u_id == $val["u_id"] && $u_pw == $val["u_pw"]){
    header('Location: delete_act.php?id='.$val["id"]);
    
   
}else{
    echo "投稿者本人しか削除はできません。";
}
exit();
?>
