curl --location 'http://localhost/projeto-papelaria/api-correios/correios/calculate' --header 'Access-token: SEU_ACCESS_TOKEN' --header 'Content-Type: application/json' --data '{
        "servico": "04510",
        "origem": "85930-000",
        "destinatario": "85960-000",
        "tipo": 1,
        "comprimento": 20,
        "altura": 20,
        "largura": 20,
        "diametro": 0,
        "peso": 0.500,
        "maoPropria": "s",
        "valorDeclarado": 150,
        "avisoRecebimento": "s"
}'
