<?php
session_start();

// �Z�b�V�����̕ϐ��̃N���A
$_SESSION = array();

// �Z�b�V�����N���A
@session_destroy();
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
<a href="maitter_login.php">���O�C����ʂɖ߂�</a>
</center>
</body>
</html>