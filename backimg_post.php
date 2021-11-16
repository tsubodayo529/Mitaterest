<?php
session_start();

//1.外部ファイル読み込み＆DB接続
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
sch();
$u_id = $_SESSION["u_id"];
$u_pw = $_SESSION["u_pw"];
$backimg = $_POST["backimg"];
fileUpload($backimg, "post_backimg/");

$pdo = db_conn();

//２．データ登録SQL作成
$stmt1 = $pdo->prepare("INSERT INTO backimg_table( u_id, u_pw, backimg)VALUES( :u_id, :u_pw, :backimg)");
$stmt1->bindValue(":u_id", $u_id, PDO::PARAM_STR);
$stmt1->bindValue(":u_pw", $u_pw, PDO::PARAM_STR);
$stmt1->bindValue(":backimg", $backimg, PDO::PARAM_STR);
$status1 = $stmt1->execute();


$stmt2 = $pdo->prepare("SELECT * FROM backimg_table WHERE u_id=:u_id AND u_pw=:u_pw");
$stmt2->bindValue(":u_id", $u_id, PDO::PARAM_STR);
$stmt2->bindValue(":u_pw", $u_pw, PDO::PARAM_STR);
$status2 = $stmt2->execute();

//３．データ表示
$view = "";
if ($status1 == false) {
    sql_error($stmt1);
}
else if($status2 == false){
    sql_error($stmt2);
}

else {
     $imgrow = $stmt2->fetch();
     $imgrow_img = $imgrow["backimg"];
}
echo $imgrow_img;
exit();
?>
