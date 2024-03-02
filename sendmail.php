<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);
$mail->isSMTP();
$mail->Host = 'ssl://smtp.mail.ru';
$mail->SMTPAuth = true;
$mail->Username = 'anatoly-web-dev@mail.ru';
$mail->Password = 'jzrx3cWcsSDZXLiz6ZPM';
$mail->SMTPSecure = 'SSL';
$mail->Port = 465;

// От кого письмо
$mail->setFrom('anatoly-web-dev@mail.ru', "Принцип Здоровья");
// Кому отправить
$mail->addAddress('anatoly-web-dev@mail.ru');
$mail->addAddress('kmv26az@mail.ru');
// Тема письма
$mail->Subject = 'Заказ обратного звонка';

foreach ($_POST as $key => $value) {
	$_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
}

$body = '<h2>Здравствуйте, Вам поступила новая заявка на обратный звонок от пациента!</h2>';
$body .= '<h3>Данные пациента:</h3>';

define('SITE_KEY', '6LdQG4cpAAAAAP-QMANugUH3X9SUKzxV1HYtC2hs');
define('SECRET_KEY', '6LdQG4cpAAAAAPyHQ-S831OBQlYlm3LmhIDFu1JM');


if (trim(!empty($_POST['userName']))) {
	$body .= '<p><strong>Имя:</strong> ' . $_POST['userName'] . '</p>';
}

if (trim(!empty($_POST['userPhone']))) {
	$body .= '<p><strong>Номер телефона:</strong> ' . $_POST['userPhone'] . '</p>';
}

if (trim(!empty($_POST['userMessage']))) {
	$body .= '<p><strong>Комментарий:</strong> ' . $_POST['userMessage'] . '</p>';
}

if (empty($_POST['userName']) || empty($_POST['userPhone'])) {
	$body .= '<p>Ошибка обработки данных формы!</p>';
}

$mail->Body = $body;


function getCaptcha($SecretKey) {
	$Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY .
		"&response={$SecretKey}");
	$Return = json_decode($Response);
	return $Return;
}

$Return = getCaptcha($_POST['recaptcha-token']);

if ($Return->success == true && $Return->score > 0.5) {
	// Отправляем
	if (!$mail->send()) {
		$message = 'Не удалось отправить данные!';
	} else {
		$message = "Ваши данные успешно отправлены! Ожидайте звонка администратора. Спасибо, что выбираете нас! ";
	}
} else {
	$message = 'Замечена подозрительная активность!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
