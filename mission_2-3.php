<?php
$name = $_GET['name'];
$comment = $_GET['comment'];
$filename='mission_2-2.txt';

if($comment!=NULL){
	$fp=fopen($filename,'a');

	$file=file('./mission_2-2.txt');
	$count=count($file)+1;

	fwrite($fp,$count."<>".$name."<>".$comment."<>".date("Y-m-d H:i:s")."\n");

	fclose($fp);
}
?>

<!DOCTYPE html>
<html lang = "ja">
<head>
<meta charset = "UFT-8">
<title>maimai MURASAKi PLUS</title>
</head>
<body>
<h2>Welcome to maimai MURASAKi PLUS</h2>
<h6>名前　　　　 コメント</h6>
<form action = "mission_2-3.php" method = "get">
<input type = "text" name ="name" size="3">&nbsp;&nbsp;&nbsp;<input type = "text" name ="comment" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="送信">
</form>
</body>
</html>

<?php

$file=file('./mission_2-2.txt');

echo "<br>";

for($i=0;$i<count($file);$i++){
	$file1=explode( '<>',$file[$i]);

	for($j=0;$j<count($file1);$j++){
		echo $file1[$j]."&nbsp;";
	}

	echo "<br>";
}

?>