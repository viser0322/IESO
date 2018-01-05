<?php
$comment = $_GET['comment'];
$filename='mission_1-6.txt';

if($comment!=NULL){
	$fp=fopen($filename,'a');

	fwrite($fp,$comment."\n");

	fclose($fp);
}
?>
<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UFT-8">
<title>フォームからデータを受け取る</title>
</head>
<body>
<h1>フォームデータの送信</h1>
<form action = "mission_1-6.php" method = "get">
<input type = "text" name ="comment"><br/>
<input type = "submit" value ="送信">
</form>
</body>
</html>