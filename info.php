<?php
// Função para criptografar a query string
function encryptQueryString($data, $key) {
    $cipher = "AES-256-CBC";
    $iv_length = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encrypted = openssl_encrypt(http_build_query($data), $cipher, $key, 0, $iv);
    return base64_encode($iv . $encrypted);
}

// Função para descriptografar a query string
function decryptQueryString($data, $key) {
    $cipher = "AES-256-CBC";
    $iv_length = openssl_cipher_iv_length($cipher);
    $data = base64_decode($data);
    $iv = substr($data, 0, $iv_length);
    $data = substr($data, $iv_length);
    return parse_str(openssl_decrypt($data, $cipher, $key, 0, $iv), $output);
}

// Dados para a query string
$data = 

// Chave para criptografia (deve ser mantida em segredo)
$key = "chave_secreta";

// Codificar a query string
$queryString = encryptQueryString($data, $key);
echo "Query String criptografada: " . $queryString . "<br>";

// Decodificar a query string
decryptQueryString($queryString, $key);
echo "Dados decodificados: <pre>";
print_r($output);
echo "</pre>";
?>
