<?php

//Если форма отправлена
if(isset($_POST['submit'])) {

	//Проверка Поля ИМЯ
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	//Проверка поля ТЕМА
	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	//Проверка правильности ввода EMAIL
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Проверка наличия ТЕКСТА сообщения
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//Если ошибок нет, отправить email
	if(!isset($hasError)) {
		$emailTo = 'info@blog-dip.mcdir.ru'; //Сюда введите Ваш email
		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">

<head>
	<title>Демо</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

<script src="/resource/jquery.min.js" type="text/javascript"></script>
<script src="/resource/jquery.validate.pack.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#contactform").validate();
});
</script>

<style type="text/css">
body {
	font-family:Arial, Tahoma, sans-serif;
}
#contact-wrapper {
	width:430px;
	border:1px solid #e2e2e2;
	background:#f1f1f1;
	padding:20px;
}
#contact-wrapper div {
	clear:both;
	margin:1em 0;
}
#contact-wrapper label {
	display:block;
	float:none;
	font-size:16px;
	width:auto;
}
form#contactform input {
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
	padding:5px;
	font-size:16px;
	color:#333;
}
form#contactform textarea {
	font-family:Arial, Tahoma, Helvetica, sans-serif;
	font-size:100%;
	padding:0.6em 0.5em 0.7em;
	border-color:#B7B7B7 #E8E8E8 #E8E8E8 #B7B7B7;
	border-style:solid;
	border-width:1px;
}
</style>
</head>

<?php Head('Пишем свой движок на PHP') ?>
<body>
<div class="wrapper">
	<div class="header"></div>
	<div class="content">
		<?php Menu();
		MessageShow()
		?>
	<div id="contact-wrapper">

	<?php if(isset($hasError)) { //Если найдены ошибки ?>
		<p class="error">Проверьте, пожалуйста, правильность заполения всех полей.</p>
	<?php } ?>

	<?php if(isset($emailSent) && $emailSent == true) { //Если письмо отправленл ?>
		<p><strong>Email успешно отправлен!</strong></p>
		<p>Спасибо  <strong><?php echo $name;?></strong> за использование контактной формы! Ваш email был отправлен и я свяжусь с Вами в кратчайшие сроки.</p>
	<?php } ?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
		<div>
		    <label for="name"><strong>Имя:</strong></label>
			<input type="text" size="50" name="contactname" id="contactname" value="" class="required" />
		</div>

		<div>
			<label for="email"><strong>Email:</strong></label>
			<input type="text" size="50" name="email" id="email" value="" class="required email" />
		</div>

		<div>
			<label for="subject"><strong>Тема:</strong></label>
			<input type="text" size="50" name="subject" id="subject" value="" class="required" />
		</div>

		<div>
			<label for="message"><strong>Сообщение:</strong></label>
			<textarea rows="5" cols="50" name="message" id="message" class="required"></textarea>
		</div>
	    <input type="submit" value="Send Message" name="submit" />
	</form>
	</div>

<?php Footer() ?>