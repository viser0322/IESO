<?php
$name = $_POST['name'];
$comment = $_POST['comment'];
$sakujo = $_POST['sakujo'];
$filename='mission_2-2.txt';

if($comment!=NULL){
	$file=file('./mission_2-2.txt');

	if(count($file)==0){	//���߂̏�������
		$count=count($file)+1;
	}

	else{			//����ȍ~�͍Ō�̏�������+1�̔ԍ��ƂȂ�悤��
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
			$file2[$i]=$file[$i];
		}
	}

	$fp=fopen($filename,'w');

	for($i=0;$i<=count($file);$i++){
		fwrite($fp,$file2[$i]);
	}

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
<h6>���O�@�@�@�@ �R�����g</h6>
<form action = "mission_2-4-1.php" method = "post">
<input type = "text" name ="name" size="3">&nbsp;&nbsp;&nbsp;<input type = "text" name ="comment" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="���M">

<h6>�폜�Ώ۔ԍ�</h6>
<input type = "text" name ="sakujo" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="���M">

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