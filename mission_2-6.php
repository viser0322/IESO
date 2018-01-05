<?php
$name = $_POST['name'];
$comment = $_POST['comment'];
$sakujo = $_POST['sakujo'];
$henshu = $_POST['henshu'];
$password = $_POST['password'];
$s_pas = $_POST['s_pas'];
$h_pas = $_POST['h_pas'];
$h = $_POST['h'];
$filename='mission_2-6.txt';

if($h==0 && $comment!=NULL){
		$file=file('./mission_2-6.txt');

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
		fwrite($fp,$count."<>".$name."<>".$comment."<>".date("Y-m-d H:i:s")."<>".$password."<>"."\n");
		fclose($fp);
}

if($sakujo!=NULL){
	$file=file('./mission_2-6.txt');

	for($i=0;$i<=count($file);$i++){
		$file1=explode( '<>',$file[$i]);
		if($file1[0]==$sakujo){
			$pas=$file1[4];
		}
	}

	if($pas==$s_pas){
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

}

if($h==1 && $comment!=NULL){
	$file=file('./mission_2-6.txt');

	for($i=0;$i<count($file);$i++){
		$file1=explode( '<>',$file[$i]);

		if($file1[0]==$henshu){
			$file2[$i]=$henshu."<>".$name."<>".$comment."<>".date("Y-m-d H:i:s")."<>".$password."<>"."\n";
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
<h6>名前／コメント／パスワード</h6>

<?php
if($h==1){
	$file=file('./mission_2-6.txt');
	for($i=0;$i<count($file);$i++){
		$file1=explode( '<>',$file[$i]);

		if($file1[0]==$henshu){
			$name=$file1[1];
			$comment=$file1[2];
		}
	}

	for($i=0;$i<=count($file);$i++){
		$file1=explode( '<>',$file[$i]);
		if($file1[0]==$henshu){
			$pas=$file1[4];
		}
	}
}
?>

<form action = "mission_2-6.php" method = "post">
<input type = "text" name ="name" size="3" <?php if($h==1 && $pas==$h_pas ){ ?> value="<?php echo $name; ?>" <?php } ?>>&nbsp;&nbsp;&nbsp;
<input type = "text" name ="comment" size="3" <?php if($h==1 && $pas==$h_pas){ ?> value="<?php echo $comment; ?>" <?php }?>>&nbsp;&nbsp;&nbsp;
<input type = "text" name ="password" size="3">&nbsp;&nbsp;
<input type = "submit" value ="送信">
<?php if($h==1 && $pas==$h_pas){ ?> <input type="hidden" name="h" value=1>
<input type="hidden" name="henshu" value="<?php echo $henshu; ?>"> <?php }?>
</form>

<form action = "mission_2-6.php" method = "post">
<h6>削除対象番号／パスワード</h6>
<input type = "text" name ="sakujo" size="3">
&nbsp;&nbsp;
<input type = "text" name ="s_pas" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="送信">
</form>

<form action = "mission_2-6.php" method = "post">
<h6>編集対象番号／パスワード</h6>
<input type = "text" name ="henshu" size="3">
&nbsp;&nbsp;
<input type = "text" name ="h_pas" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="送信">
<input type="hidden" name="h" value=1>
</form>


</body>
</html>

<?php
$file=file('./mission_2-6.txt');

echo "<br>";

for($i=0;$i<count($file);$i++){
	$file1=explode( '<>',$file[$i]);

	for($j=0;$j<4;$j++){
		echo $file1[$j]."&nbsp;";
	}

	echo "<br>";
}
?>