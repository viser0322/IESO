<?php
$comment = $_GET['comment'];	//comment�Ƃ����ϐ��ɁAget�Ŏ󂯎�����l�������Ă��܂�
echo $comment;			//echo�֐��Ő�قǎ󂯎����comment�Ƃ����ϐ���\�������Ă��܂�
?>

<!DOCTYPE html>			//������ӂ͂Ƃ肠���������Ă����Ƃ��������ŏ����Ă�������
<html lang = "ja">
<head>
<meta charset = "UFT-8">
<title>�t�H�[������f�[�^���󂯎��</title>	//<title></title>�ŋ��񂾕����̓^�u��ɕ\�������^�C�g���ɂȂ�܂�
</head>
<body>
<h1>�t�H�[���f�[�^�̑��M</h1>			//<h1></h1>�ŋ��񂾕����̓T�C�g��ɂ��̂܂ܕ\��������<h2><h3>�Ȃǐ�����ς���ƕ����̑傫�����ς��܂�
<form action = "mission_1-4.php" method = "get">//get�Ƃ������@��mission_1-4.php�Ƃ����ꏊ���瑗���Ă��������Ƃ����Ӗ��ł�
<input type = "text" name ="comment"><br/>	//input type��text�Ƃ����̂́A�T�C�g���
							//�������͂�������t�H�[����\�������A�����comment�Ƃ������O��t���Ă��܂�
<input type = "submit" value ="���M">		//input type��submit�Ƃ����̂́A�{�^����\�������邱�Ƃł�
							//���̃{�^�����������Ƃŏ�L��comment�Ƃ����t�H�[���ɓ��͂��ꂽ�����񂪑��M����܂�
</form>
</body>
</html>