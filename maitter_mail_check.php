<?php
$dsn = '�f�[�^�x�[�X��';
$user = '���[�U�[��';
$password1 = '�p�X���[�h';

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
	//POST���ꂽ�f�[�^��ϐ��ɓ����
	$mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
	
	//���[�����͔���
	if ($mail == ''){
		$errors['mail'] = "���[�������͂���Ă��܂���B";
	}else{
		if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail)){
			$errors['mail_check'] = "���[���A�h���X�̌`��������������܂���B";
		}
		
		/*
		�����Ŗ{�o�^�p��member�e�[�u���ɂ��łɓo�^����Ă���mail���ǂ������`�F�b�N����B
		$errors['member_check'] = "���̃��[���A�h���X�͂��łɗ��p����Ă���܂��B";
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
	//result=NULL�ł���Γo�^
	//����ȊO�ł���΃u���b�N
		$ID=uniqid();

		$sql="INSERT INTO pre_Member (ID, mail,flag) VALUES ('$ID', '$mail',0)";
		$result=$pdo->query('SET NAMES utf8');
		$result=$pdo->query($sql);

		$to = $mail;
		$subject = 'Maitter�o�^';
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
		print $mail.'���Ɋm�F���[���𑗐M���܂����B<br>';
	}

	else{
		print $mail.'�͊��ɓo�^�ς݂ł��B<br>';
	}
?>
</center>
</body>
</html>