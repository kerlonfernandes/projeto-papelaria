<?php

require "../../_app/Config.inc.php";
require "../../classes/Email.inc.php";

$email = new Email();


$subject = 'Olá teste';
$body = '<p>Teste</p>';
$recipient_name = 'KErlon';
$recipient_email = 'kerlon1221@gmail.com';


$email->add($subject, $body, $recipient_name, $recipient_email);

// // Anexos (opcional)
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
