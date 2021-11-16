<?php
session_start();
$l_id = $_POST["l_id"];
$l_pw = $_POST["l_pw"];

include("funcs.php");


//2. DB接続します

$pdo = db_conn();





//３．データ登録SQL作成
$sql = "SELECT * FROM login_table WHERE u_id=:l_id AND u_pw=:l_pw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':l_id', $l_id, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':l_pw', $l_pw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //sqlと変数が合体したあとなので、ここで初めて実行される

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}

$val = $stmt->fetch();

if ($val["id"] != ""){
    $_SESSION["chk_ssid"] = session_id();
    $_SESSION["u_name"] = $val["u_name"];
    $_SESSION["u_id"] = $val["u_id"];
    $_SESSION["u_pw"] = $val["u_pw"];
    $_SESSION["img"] = $val["img"];
    redirect("main.php");
}else{
    redirect("login.php");
}
?>
