<?php
$dsn = 'データベース名';
$user = 'ユーザー名';
$password1 = 'パスワード';

$pdo = new PDO($dsn, $user, $password1);

$sql = 'CREATE TABLE IF NOT EXISTS pre_Member
	(
	ID char(64) NOT NULL,
	mail char(64) NOT NULL,
	flag int(1) NOT NULL,
	PRIMARY KEY(ID)
	) DEFAULT CHARSET=utf8;';

$result=$pdo->query($sql);


if(empty($_POST)) {
	header("Location: maitter_mail.php");
	exit();
}else{
	//POSTされたデータを変数に入れる
	$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
	
	//メール入力判定
	if ($mail == ''){
		$errors['mail'] = "メールが入力されていません。";
	}else{
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
			$errors['mail_check'] = "メールアドレスの形式が正しくありません。";
		}
		
		/*
		ここで本登録用のmemberテーブルにすでに登録されているmailかどうかをチェックする。
		$errors['member_check'] = "このメールアドレスはすでに利用されております。";
		*/
	}
}

if (count($errors) === 0){
	$sql="SELECT * FROM Member WHERE mail='$mail'";
	$result=$pdo->query($sql);

	foreach($result as $row){
		$a=$row['ID'];

	}

	if($a==NULL){
	//result=NULLであれば登録
	//それ以外であればブロック
		$ID=uniqid();

		$sql="INSERT INTO pre_Member (ID, mail,flag) VALUES ('$ID', '$mail',0)";
		$result=$pdo->query('SET NAMES utf8');
		$result=$pdo->query($sql);

		$to = $mail;
		$subject = 'Maitter登録';
		$message = "http://co-312.it.99sv-coco.com/maitter_check.php?ID=$ID";

		mail($to, $subject, $message);
	}
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
	if($a==NULL){
		print $mail.'宛に確認メールを送信しました。<br>';
	}

	else{
		print $mail.'は既に登録済みです。<br>';
	}
?>
</center>
</body>
</html>