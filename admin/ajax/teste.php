<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once '../../vendor/autoload.php';
require "../../_app/Config.inc.php";
require "../../classes/Email.inc.php"; // Substitua com o caminho correto para o arquivo Email.inc.php

$email = new Email();

$subject = 'Olá teste';
$body = '<p>Teste</p>';
$recipient_name = 'KErlon';
$recipient_email = 'kerlon1221@gmail.com';

$email->add($subject, $body, $recipient_name, $recipient_email);

// Anexos (opcional) - Descomente esta seção se precisar de anexos
// $filePath = '/caminho/para/o/arquivo.pdf';
// $fileName = 'arquivo.pdf';
// $email->attach($filePath, $fileName);

// Enviar o email
if ($email->send()) {
    echo 'Email enviado com sucesso!';
} else {
    echo 'Houve um erro ao enviar o email: ' . $email->error()->getMessage();
}

?>
