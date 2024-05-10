<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barra lateral de Steps</title>
  <!-- Adicionando Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Estilo personalizado para a barra de steps */
    .step {
      position: relative;
    }

    .step .step-item {
      list-style: none;
      padding: 10px;
      background-color: #f8f9fa;
      border-left: 3px solid #dee2e6;
      margin-bottom: 20px;
    }

    .step .step-item.active {
      background-color: #007bff;
      color: #fff;
    }

    .step .step-item.active::before {
      content: "";
      position: absolute;
      top: 10px;
      left: -8px;
      width: 0;
      height: 0;
      border-top: 8px solid transparent;
      border-bottom: 8px solid transparent;
      border-right: 8px solid #007bff;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="step">
        <ul class="list-unstyled">
          <li class="step-item active">Passo 1</li>
          <li class="step-item">Passo 2</li>
          <li class="step-item">Passo 3</li>
          <!-- Adicione mais passos conforme necessário -->
        </ul>
      </div>
    </div>
    <div class="col-md-9">
      <!-- Conteúdo da página -->
      <h1>Conteúdo da Página</h1>
      <p>Este é o conteúdo da página onde você pode adicionar o que desejar.</p>
    </div>
  </div>
</div>

<!-- Adicionando Bootstrap JS (opcional, apenas se você precisar de funcionalidades como dropdowns) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
