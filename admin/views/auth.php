<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administração</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/home.css">
    <link rel="stylesheet" href="<?= SITE ?>/src/css/admin.css">

    <link href="<?= SITE ?>/src/css/bootstrap.min.css?id=<?= uniqid(); ?>" rel="stylesheet">
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
        <form id="login_admin" class="login-form">
            <div class="mb-3">
                <input type="text" class="form-control" id="user" name="email" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="text-center mt-3">
            <a href="#">Esqueceu a senha?</a></a>
        </p>
        <div class="text-center mt-3" id="loading" style="display:none;">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
      
        <div id="success-message" style="display: none;" class="alert alert-success" role="alert">
            Autenticado com Sucesso!
        </div>
        <div id="error-message" class="alert alert-danger" style="display: none;" role="alert">
            Login ou senha incorretos!
        </div>
    </div>

    <script src="<?= SITE ?>/src/js/jquery.min.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/bootstrap.bundle.min.js?id=<?= uniqid() ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="<?= SITE ?>/src/js/index.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/styles/styles.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/scripts.js?id=<?= uniqid() ?>"></script>
    <script src="<?= SITE ?>/src/js/admin/admin.js?id=<?= uniqid() ?>"></script>
</body>

</html>
