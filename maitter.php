<?php
$dsn = 'データベース名';
$user = 'ユーザ名';
$password1 = 'パスワード';

$pdo = new PDO($dsn, $user, $password1);
?>

<?php
session_start();

if(!session_is_registered("loginID")){
	header("Location: maitter_login.php");
	exit();
}

else{
$loginID=$_SESSION['loginID'];
$loginpas=$_SESSION['loginpas'];

$sql="SELECT password FROM Member WHERE ID='$loginID'";
$result=$pdo->query($sql);
$password2=$result->fetchColumn();
}
if($loginpas!=$password2){
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
パスワードが間違っています。<br>
<a href='maitter_login.php'>ログイン画面へ</a>
</form>
</body>
</html>
<?php
session_start();
session_destroy();
exit();
}
?>

<?php
if($loginpas==$password2){
?>

<?php
$name = $_POST['name'];
$comment = $_POST['comment'];
$sakujo = $_POST['sakujo'];
$henshu = $_POST['henshu'];
$h = $_POST['h'];
$user_name = $_POST['user_name'];
$user_pas = $_POST['user_pas'];

try{
	$sql = 'CREATE TABLE IF NOT EXISTS Maitter
		(
		No int(11) auto_increment,
		name text(255),
		ID char(64),
		comment text(255),
		date varchar(255),
		password char(32),
		filename char(32),
		PRIMARY KEY(No)
		) DEFAULT CHARSET=utf8;';

	$result=$pdo->query($sql);

	if($h==0 && $comment!=NULL){
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');

		$sql="SELECT name FROM Member WHERE ID='$loginID'";
		$result=$pdo->query($sql);
		$name=$result->fetchColumn();

		if(isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])){
 			$old_name = $_FILES['file']['tmp_name'];

			//  もしuploadというフォルダーがなければ
			if(!file_exists('upload')){
				mkdir('upload');
			}

			$new_name = date("YmdHis"); //ベースとなるファイル名は日付
			$new_name .= mt_rand(); //ランダムな数字も追加

			$ext = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1);

			if($_FILES['file']['name']!=NULL){
				if($ext=="mp4"){
					$new_name .= '.mp4';
				}
				else if($ext=="jpeg"){
					$new_name .= '.jpg';
				}
				else if($ext=="gif"){
					$new_name .= '.gif';
				}
				else if($ext=="png"){
					$new_name .= '.png';
				}

				else{
					header('Location: maitter.php');
				}
			}
			move_uploaded_file ( $old_name, 'upload/' . $new_name);

		}

		$sql="INSERT INTO Maitter (name,comment,ID,password,date,filename) VALUES ('$name','$comment','$loginID','$password','$date','$new_name')";
		$result=$pdo->query('SET NAMES utf8');
		$result=$pdo->query($sql);
	}

	if($sakujo!=NULL){
		$sql="SELECT ID FROM Maitter WHERE No='$sakujo'";
		$result=$pdo->query($sql);
		$sakujo_ID=$result->fetchColumn();

		if($sakujo_ID==$loginID){
			$sql="DELETE FROM Maitter WHERE No=$sakujo";
			$result=$pdo->query($sql);
			$sql="ALTER TABLE Maitter auto_increment = 1";
			$result=$pdo->query($sql);
		}
	}

	if($h==1 && $comment!=NULL){
		$date = new DateTime();
		$date = $date->format('Y-m-d H:i:s');

		if(isset($_FILES['file']) && is_uploaded_file($_FILES['file']['tmp_name'])){
 			$old_name = $_FILES['file']['tmp_name'];

			//  もしuploadというフォルダーがなければ
			if(!file_exists('upload')){
				mkdir('upload');
			}

			$new_name = date("YmdHis"); //ベースとなるファイル名は日付
			$new_name .= mt_rand(); //ランダムな数字も追加

			$ext = substr($_FILES['file']['name'], strrpos($_FILES['file']['name'], '.') + 1);

			if($_FILES['file']['name']!=NULL){
				if($ext=="mp4"){	//MP4対応しとらん
					$new_name .= '.mp4';
				}
				else if($ext=="jpeg"){
					$new_name .= '.jpg';
				}
				else if($ext=="gif"){
					$new_name .= '.gif';
				}
				else if($ext=="png"){
					$new_name .= '.png';
				}

				else{
					header('Location: maitter.php');
				}
			}
			move_uploaded_file ( $old_name, 'upload/' . $new_name);

			$sql="UPDATE Maitter SET filename='$new_name' WHERE No=$henshu";
			$result=$pdo->query('SET NAMES utf8');
			$result=$pdo->query($sql);

		}

		$sql="UPDATE Maitter SET comment='$comment', password='$password',date='$date' WHERE No=$henshu";
		$result=$pdo->query('SET NAMES utf8');
		$result=$pdo->query($sql);
		$h=0;
	}

}
catch (PDOException $e){
	print('エラーが発生しました。:'.$e->getMessage());
	die();
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
</center>

<?php
$sql="SELECT name FROM Member WHERE ID='$loginID'";
$result=$pdo->query($sql);
$name=$result->fetchColumn();
$sql="SELECT mail FROM Member WHERE ID='$loginID'";
$result=$pdo->query($sql);
$mail=$result->fetchColumn();
print $name;
print "<font color='gray'>";
print ' @'.$loginID;
print "</font>";
echo '　<a href="maitter_logout.php">ログアウト</a>'.'<br><br>';
?>
<center>
<?php
	$sql="SELECT ID FROM Maitter WHERE No='$henshu'";
	$result=$pdo->query($sql);
	$henshu_ID=$result->fetchColumn();
?>

<form action = "maitter.php" enctype="multipart/form-data" method = "post">
<input type = "text" name ="comment" style="width:500px;height:100px;" <?php if($h==1 && $henshu_ID==$loginID){ ?> value="
<?php
	$sql="SELECT comment FROM Maitter WHERE No=$henshu";
	$result=$pdo->query($sql);
	$comment=$result->fetchColumn();
	echo $comment;
?>" <?php } else{$h=0;}?>><br>
<input type = "file" name = "file" size="55">
<font size=2>※jpeg/gif/png/mp4のみ</font><br>
<input type = "submit" value ="投稿">
<?php if($h==1 && $pas==$h_pas){ ?> <input type="hidden" name="h" value=1>
<input type="hidden" name="henshu" value="<?php echo $henshu; ?>"> <?php }?>
</form>
</center>

<form action = "maitter.php" method = "post">
<br>削除対象番号　<input type = "text" name ="sakujo" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="削除">
</form>

<form action = "maitter.php" method = "post">
編集対象番号　<input type = "text" name ="henshu" size="3">
&nbsp;&nbsp;
<input type = "submit" value ="編集">
<input type="hidden" name="h" value=1>
</form>
</body>
</html>

<?php
echo "<br>";

try{

	$sql='SELECT * FROM Maitter';

	$result=$pdo->query($sql);

	foreach($result as $row){
		print "<div style='padding: 10px; margin-bottom: 10px; border: 1px solid #00aced; border-radius: 10px;'>";
		print '<br>';
		print $row['No'].' ';
		print $row['name'];
		print "<font color='gray'>";
		print ' @'.$row['ID'];
		print "</font>";
		print "<br><br>";
		print '　　'.$row['comment'].'<br><br>';
		if($row['filename']!=0){
			print "<center>";
			$e = substr($row['filename'], strrpos($row['filename'], '.') + 1);
			if($e=="mp4"){ ?>
			<video src="http://co-312.it.99sv-coco.com/upload/<?php echo $row['filename']; ?>"></video> 
			<?php }
			else{ ?>
			<img src="http://co-312.it.99sv-coco.com/upload/<?php echo $row['filename']; ?>">
			<?php }
			print "</center>";
		}
		print "<div align='right'>";
		print '<br>'.$row['date'].'<br>';
		print "</div>";
		print "<br>";
		print "</div>";
	}
}
catch (PDOException $e){
	print('エラーが発生しました。:'.$e->getMessage());
	die();
}
?>

<?php
}
?>
