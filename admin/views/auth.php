<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administração</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/home.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/admin.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    .login-container {
        width: 80%;
        max-width: 600px;
        margin: auto;
        margin-top: 10%;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .login-container h2 {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-form input {
        width: 100%;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }
    
    .login-form button {
        width: 100%;
        padding: 15px;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    
    .login-form button:hover {
        background-color: #0056b3;
    }
    
    .error-message {
        color: red;
        margin-top: 20px;
        text-align: center;
    }
    
    @media (max-width: 576px) {
        .login-container {
            width: 90%;
            padding: 30px;
        }
    }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Administração</h2>
        <div class="text-center mb-4">
        <img src="<?= SITE ?>/src/images/logo.png" style="width: 256px;" class="rounded" alt="Imagem do usuário">
    </div>
        <form class="login-form">
            <div class="mb-3">
                <input type="text" class="form-control" id="user" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="text-center mt-3">
            <a href="#">Esqueceu a senha?</a> | <a href="#">Criar conta</a>
        </p>
        <div class="text-center mt-3" id="loading" style="display:none;">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <p id="error-message" class="error-message"></p>
        <div id="success-message" style="display: none;" class="alert alert-success" role="alert">
            Autenticado com Sucesso!
        </div>
        <div id="error-message" class="alert alert-danger" style="display: none;" role="alert">
            Login ou senha incorretos!
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= SITE ?>/src/js/index.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/styles/styles.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/admin/admin.js?id=<?= uniqid() ?>"></script>
</body>

</html>
