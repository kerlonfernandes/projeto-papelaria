<?php

function calcularFrete($baseUrl, $accessToken, $servico, $origem, $destinatario, $tipo, $comprimento, $altura, $largura, $diametro, $peso, $maoPropria, $valorDeclarado, $avisoRecebimento) {
    $url = $baseUrl . "/correios/calculate";

    $data = [
        'servico' => $servico,
        'origem' => $origem,
        'destinatario' => $destinatario,
        'tipo' => $tipo,
        'comprimento' => $comprimento,
        'altura' => $altura,
        'largura' => $largura,
        'diametro' => $diametro,
        'peso' => $peso,
        'maoPropria' => $maoPropria,
        'valorDeclarado' => $valorDeclarado,
        'avisoRecebimento' => $avisoRecebimento
    ];

    

    $payload = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Access-token: ' . $accessToken,
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        throw new Exception('Erro no cURL: ' . curl_error($ch));
    }

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode != 200) {
        throw new Exception('Erro ao comunicar com a API: Código HTTP ' . $httpcode . ' Resposta: ' . $response);
    }

    echo $response; // Adicione esta linha para depuração

    $decodedResponse = json_decode($response, true);
    if ($decodedResponse === null) {
        throw new Exception('Erro ao decodificar a resposta JSON: ' . json_last_error_msg());
    }

    return $decodedResponse;
}

// Exemplo de uso
try {
    $freteInfo = calcularFrete(
        'http://localhost/projeto-papelaria/api-correios/correios/calculate',
        'SEU_ACCESS_TOKEN',
        '04510',
        '29930-010',
        '29900-280',
        1,
        20,
        20,
        20,
        0,
        0.500,
        's',
        150,
        's'
    );

} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
