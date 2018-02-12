<?php
$ID = $_POST['ID'];
$password = $_POST['password'];

if($ID!=NULL and $password!=NULL){
	session_start();

	if(!session_is_registered("loginID")){
		session_register("loginID");
	}

	if(!session_is_registered("loginpas")){
		session_register("loginpas");
	}

	$loginID=$ID;
	$loginpas=$password;

	header("Location: maitter.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UFT-8">
<title>Maitter</title>
</head>
<body>
<center>
<img src="http://co-312.it.99sv-coco.com/Maitter.png">
<br><br><br>
<form action = "maitter_login.php" method = "post">
　　　　ID　<input type = "text" name ="ID"><br>
パスワード　<input type = "password" name ="password"><br>
<input type = "submit" name="login" value ="ログイン">
<br><br><br><br>
<a href="maitter_mail.php">新規登録</a><br>
</center>
</form>
</body>
</html>
