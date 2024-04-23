<?php

function gerarSenha($tamanho = 8) {
    // Define os caracteres que serão usados na senha
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%&*';

    // Embaralha os caracteres para tornar a senha mais aleatória
    $caracteresEmbaralhados = str_shuffle($caracteres);

    // Pega um subconjunto do tamanho especificado
    $senha = substr($caracteresEmbaralhados, 0, $tamanho);

    return $senha;
}

function gerarHashSenha($senha) {
    $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
    return $hashSenha;
}



function gerarHashBcrypt($senha) {
    // Define o custo, quanto maior, mais seguro, mas também mais lento
    $custo = 10;

    // Gera um salt aleatório
    $salt = substr(strtr(base64_encode(random_bytes(16)), '+', '.'), 0, 22);

    // Concatena o prefixo do bcrypt, o custo e o salt
    $hashFormatado = sprintf("$2y$%02d$%s", $custo, $salt);

    // Gera o hash usando a função password_hash
    $hash = crypt($senha, $hashFormatado);

    return $hash;
}
// Teste
$senha = gerarSenha();;
$hash = gerarHashBcrypt($senha);
echo "Senha: $senha\n";
echo "Hash gerado: $hash\n";
// Gera uma senha de 12 caracteres
?>
