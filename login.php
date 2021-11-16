<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Caveat rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
<header>
        <!-- titleをクリックでメイン画面へ -->
        <div id="title">- Mitaterest -</div>
        <br>
        <div id="sub">Open the Sense of Wonder with Mitaterest</div>
</header>

<!-- Head[End] -->

<!-- Main[Start] -->

  
<div id="wrap">
    <form method="POST" action="login_act.php" id="login_wrap">
            <!-- ログインボタンを押すとlidとlpwがPOSTされる  →  login_act.phpへ遷移 -->
        <input id="l_id" type="text" name="l_id" placeholder="ID" aria-label="ID" aria-describedby="basic-addon1">
        <br>
        <input id="l_pw" type="password" name="l_pw" placeholder="password" aria-label="password" aria-describedby="basic-addon1">
        <br>      
        <input type="submit" value="ログイン">      
    </form>

   



    <form id="reg_wrap" method="POST" action="reg_act.php" enctype="multipart/form-data">
            <input id="u_id" type="text" name="u_id" placeholder="User ID" aria-label="User ID" aria-describedby="basic-addon1">
            <br>
            <input id="u_pw" type="password" name="u_pw"  placeholder="User Password" aria-label="User Password" aria-describedby="basic-addon1">
            <br>
            <input id="u_name" type="text" name="u_name" placeholder="User Name" aria-label="User Name" aria-describedby="basic-addon1">
            <br>
            <!-- <input type="file" name="img" accept="image/*"> -->
            <input type="submit" value="新規登録">
    </form>
</div>



<!-- <a href="select.php">データ一覧へ</a> -->
<!-- Main[End] -->

<!-- bootstrapインストール -->
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>


</script>
</body>
</html>
