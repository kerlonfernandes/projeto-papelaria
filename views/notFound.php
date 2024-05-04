<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Não encontrada</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            padding: 0;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #notfound {
            position: relative;
            height: 100vh;
            background-color: #fafbfd;
        }
        .notfound {
            max-width: 520px;
            width: 100%;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .notfound-bg > div {
            width: 100%;
            background: #fff;
            border-radius: 90px;
            height: 125px;
        }
        .notfound-bg > div:nth-child(1) {
            box-shadow: 5px 5px 0px 0px #f3f3f3;
        }
        .notfound-bg > div:nth-child(2) {
            transform: scale(1.3);
            box-shadow: 5px 5px 0px 0px #f3f3f3;
            position: relative;
            z-index: 10;
        }
        .notfound-bg > div:nth-child(3) {
            box-shadow: 5px 5px 0px 0px #f3f3f3;
            position: relative;
            z-index: 90;
        }
        .notfound h1 {
            font-size: 86px;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0;
            color: #151515;
        }
        .notfound h2 {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
            color: #151515;
        }
        .notfound a {
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            background: #18e06f;
            display: inline-block;
            padding: 15px 30px;
            border-radius: 5px;
            color: #fff;
            font-weight: 700;
            margin-top: 20px;
        }
        .notfound .suggestion {
            margin-top: 40px;
        }
        .notfound .suggestion h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #151515;
        }
        .notfound .suggestion ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .notfound .suggestion ul li {
            font-size: 18px;
            color: #777;
            margin-bottom: 10px;
        }
        @media only screen and (max-width: 767px) {
            .notfound .notfound-bg {
                width: 287px;
                margin: auto;
            }
            .notfound .notfound-bg > div {
                height: 85px;
            }
        }
        @media only screen and (max-width: 480px) {
            .notfound h1 {
                font-size: 68px;
            }
            .notfound h2 {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-bg">
                <div></div>
                <div><h1>oops!</h1></div>
                <div></div>
            </div>
            <h1></h1>
            <h2>Parece que a página não foi encontrada!</h2>
            <a href="<?= SITE ?>/">Voltar para a página inicial</a>
            <div class="suggestion">
                <h3>Você não quis dizer</h3>
                <ul>
                  <?php
                    $st = new Core();                  
                    $sites = $st->getFilesWithoutExtension("./views");
                    foreach($sites as $site) {
                    if($site != "notFound" && $site != "login" && $site != "produto" && $site != "login") {
                  ?>
                    <li><a href="<?= SITE ?>/<?= $site ?> "><?= $site ?></a></li>
                    <?php } }?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
