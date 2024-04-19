<?php

namespace Kerlo\papelaria\app;
use DateTime;

class SupAid
{
    public function getCurrentDate()
    {
        date_default_timezone_set('America/Sao_Paulo'); // Configura o fuso horário para Brasília (BRT)
        return date("Y-m-d");
    }

    public function getCurrentTime()
    {
        date_default_timezone_set('America/Sao_Paulo'); // Configura o fuso horário para Brasília (BRT)
        return date("H:i:s");
    }

    public function generateNumKey($len, $min, $max)
    {
        $sequence = array();

        for ($i = 0; $i < $len; $i++) {
            $sequence[] = rand($min, $max);
        }
        return $sequence;
    }

    public function generateRandomLetterHash($length = 20)
    {
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lettersLength = strlen($letters);
        $hash = '';

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, $lettersLength - 1);
            $hash .= $letters[$randomIndex];
        }

        return $hash;
    }

    public function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validatePhoneNumber($phoneNumber)
    {
        return preg_match("/^\d{10}$/", $phoneNumber);
    }

    public function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    public function generateRandomPassword($length = 8)
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }

    public function sendEmail($to, $subject, $message, $headers)
    {
        return mail($to, $subject, $message, $headers);
    }

    public function calculateAge($birthDate)
    {
        $today = new DateTime();
        $birthdate = new DateTime($birthDate);
        $age = $today->diff($birthdate);
        return $age->y;
    }

    public function fileExists($filePath)
    {
        return file_exists($filePath);
    }

    public function sortAssocArrayByValue($array)
    {
        asort($array);
        return $array;
    }

    public function sumArray($array)
    {
        return array_sum($array);
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }
}