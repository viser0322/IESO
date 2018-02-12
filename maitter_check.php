<?php
$dsn = 'データベース名';
$user = 'ユーザー名';
$password1 = 'パスワード';

$pdo = new PDO($dsn, $user, $password1);

$h = $_POST['h'];
$i = $_POST['i'];

if($h!=1){
	$ID = $_GET['ID'];
}
?>

<?php
$user_ID = $_POST['user_ID'];
$user_name = $_POST['user_name'];
$user_pas = $_POST['user_pas'];

	$sql = 'CREATE TABLE IF NOT EXISTS Member
		(
		ID char(64),
		name text(100),
		password char(32),
		mail char(64),
		PRIMARY KEY(ID)
		) DEFAULT CHARSET=utf8;';

	$result=$pdo->query($sql);

	$sql="SELECT flag FROM pre_Member WHERE ID='$i'";
	$result=$pdo->query($sql);
	$flag=$result->fetchColumn();

if($user_name!=NULL and $user_pas!=NULL){
	session_start();

	$sql="SELECT mail FROM pre_Member WHERE ID='$i'";
	$result=$pdo->query($sql);
	$mail=$result->fetchColumn();

	$sql="INSERT INTO Member (ID,name,password,mail) VALUES ('$user_ID','$user_name','$user_pas','$mail')";
	$result=$pdo->query('SET NAMES utf8');
	$result=$pdo->query($sql);

	$sql="UPDATE pre_Member SET flag=1 WHERE ID='$i'";
	$result=$pdo->query('SET NAMES utf8');
	$result=$pdo->query($sql);

	if(!session_is_registered("loginID")){
		session_register("loginID");
	}

	if(!session_is_registered("loginpas")){
		session_register("loginpas");
	}

	$loginID=$user_ID;
	$loginpas=$user_pas;


	$h=0;

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

<?php
$sql="SELECT flag FROM pre_Member WHERE ID='$ID'";
$result=$pdo->query($sql);
$flag=$result->fetchColumn();
if($flag==0){
?>


<form action = "maitter_check.php" method = "post">
　　　名前　<input type = "text" name ="user_name"><br>
　　　　ID　<input type = "text" name ="user_ID"><br>
パスワード　<input type = "text" name ="user_pas"><br>
<input type="hidden" name="h" value=1>
<input type="hidden" name="i" value=<?php echo $ID; ?>>
<input type = "submit" name="touroku" value ="登録">

<?php
}
?>

<?php
if($flag!=0){
?>

登録済みです。

<?php
}
?>


</center>
</form>
</body>
</html>
