<?php
$name = $_POST['name'];
$comment = $_POST['comment'];
$sakujo = $_POST['sakujo'];
$filename='mission_2-2.txt';
$f=0;//最初かそれ以降かを判断

if($comment!=NULL){
	$file=file('./mission_2-2.txt');

	if(count($file)==0){	//初めの書き込み
		$count=count($file)+1;
	}

	else{			//それ以降は最後の書き込み+1の番号となるように
		for($i=0;$i<count($file);$i++){
			$file1=explode( '<>',$file[$i]);
			$count=$file1[0]+1;
		}
	}

	$fp=fopen($filename,'a');
	fwrite($fp,$count."<>".$name."<>".$comment."<>".date("Y-m-d H:i:s")."\n");
	fclose($fp);
}

if($sakujo!=NULL){
	$file=file('./mission_2-2.txt');

	for($i=0;$i<=count($file);$i++){
		$file1=explode( '<>',$file[$i]);

		if($file1[0]!=$sakujo){
			if($f==0){
				$fp=fopen($filename,'w');//最初だけ書き込み
				fwrite($fp,$file[$i]);
				fclose($fp);
				$f++;
			}
			else{
				$fp=fopen($filename,'a');//以降は追加
				fwrite($fp,$file[$i]);
				fclose($fp);
			}
		}
	}
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
<form action = "mission_2-4.php" method = "post">
<input type = "text" name ="name" size="3">&nbsp;&nbsp;&nbsp;<input type = "text" name ="comment" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="送信">

<h6>削除対象番号</h6>
<input type = "text" name ="sakujo" size="3">
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