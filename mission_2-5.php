<?php
$name = $_POST['name'];
$comment = $_POST['comment'];
$sakujo = $_POST['sakujo'];
$henshu = $_POST['henshu'];
$h = $_POST['h'];
$filename='mission_2-2.txt';

if($h==0 && $comment!=NULL){
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

if($h==1 && $comment!=NULL){
	$file=file('./mission_2-2.txt');

	for($i=0;$i<count($file);$i++){
		$file1=explode( '<>',$file[$i]);

		if($file1[0]==$henshu){
			$file2[$i]=$henshu."<>".$name."<>".$comment."<>".date("Y-m-d H:i:s")."\n";
		}
		else{
			$file2[$i]=$file[$i];
		}
	}

	$fp=fopen($filename,'w');

	for($i=0;$i<=count($file);$i++){
		fwrite($fp,$file2[$i]);
	}

	fclose($fp);
	$h=0;

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

<?php
if($h==1){
	$file=file('./mission_2-2.txt');
	for($i=0;$i<count($file);$i++){
		$file1=explode( '<>',$file[$i]);

		if($file1[0]==$henshu){
			$name=$file1[1];
			$comment=$file1[2];
		}
	}
}
?>

<form action = "mission_2-5.php" method = "post">
<input type = "text" name ="name" size="3" <?php if($h==1){ ?> value="<?php echo $name; ?>" <?php } ?>>&nbsp;&nbsp;&nbsp;
<input type = "text" name ="comment" size="3" <?php if($h==1){ ?> value="<?php echo $comment; ?>" <?php }?>>
&nbsp;&nbsp;
<input type = "submit" value ="���M">
<?php if($h==1){ ?> <input type="hidden" name="h" value=1>
<input type="hidden" name="henshu" value="<?php echo $henshu; ?>"> <?php }?>
</form>

<form action = "mission_2-5.php" method = "post">
<h6>�폜�Ώ۔ԍ�</h6>
<input type = "text" name ="sakujo" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="���M">
</form>

<form action = "mission_2-5.php" method = "post">
<h6>�ҏW�Ώ۔ԍ�</h6>
<input type = "text" name ="henshu" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="���M">
<input type="hidden" name="h" value=1>
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