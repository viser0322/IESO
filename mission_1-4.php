<?php
$comment = $_GET['comment'];	//commentという変数に、getで受け取った値を代入しています
echo $comment;			//echo関数で先ほど受け取ったcommentという変数を表示させています
?>

<!DOCTYPE html>			//ここら辺はとりあえず書いておくという感じで書いてください
<html lang = "ja">
<head>
<meta charset = "UFT-8">
<title>フォームからデータを受け取る</title>	//<title></title>で挟んだ文字はタブ上に表示されるタイトルになります
</head>
<body>
<h1>フォームデータの送信</h1>			//<h1></h1>で挟んだ文字はサイト上にそのまま表示させる<h2><h3>など数字を変えると文字の大きさが変わります
<form action = "mission_1-4.php" method = "get">//getという方法でmission_1-4.phpという場所から送ってくださいという意味です
<input type = "text" name ="comment"><br/>	//input typeがtextというのは、サイト上に
							//文字入力をさせるフォームを表示させ、それにcommentという名前を付けています
<input type = "submit" value ="送信">		//input typeがsubmitというのは、ボタンを表示させることです
							//このボタンを押すことで上記のcommentというフォームに入力された文字列が送信されます
</form>
</body>
</html>