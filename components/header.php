<div class="carrousel-inicio" style="background-color: #FFC700; margin-top:-25px;">
  <nav id="navbar" class="navbar navbar-expand-lg bg-body-tertiary custom-navbar m-3 bg-nav bg-navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= SITE ?>"><img src="<?= SITE ?>/src/images/logo.png" width="70%" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav justify-content-center">
            <a class="nav-link active" aria-current="page" href="<?= SITE ?>/">Início</a>
          </li>
          <li class="nav justify-content-center">
            <a class="nav-link active" aria-current="page" href="<?= SITE ?>/categoria/material-escolar">Material Escolar</a>
          </li>
          <li class="nav justify-content-center">
            <a class="nav-link active" aria-current="page" href="<?= SITE ?>/categoria/material-escritorio">Material de Escritório</a>
          </li>
          <li class="nav justify-content-center">
            <a class="nav-link active" aria-current="page" href="<?= SITE ?>/categoria/mochilas">Mochilas</a>
          </li>
          <li class="nav justify-content-center">
            <a class="nav-link active" aria-current="page" href="<?= SITE ?>/categoria/cadernos">Cadernos</a>
          </li>
          <li class="nav justify-content-center">
            <a class="nav-link active" aria-current="page" href="#">Contato</a>
          </li>

          <li class="nav justify-content-center">
            <form class="d-flex" role="search">
              <input class="form-control custom-input me-2 input-pesquisa" type="search" placeholder="Pesquisar produto..." aria-label="Search" style="margin-left: 25px; height: 50px;">
              <button class="btn btn-outline" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
          </li>
        </ul>

        <div class="m-3 usuario">
          <ul class="navbar-nav">
            <li class="nav-item justify-content-center icon-usuario m-2">
              <a class="cart position-relative" href="<?= SITE ?>/carrinho">
                <i class="fa-solid fa-cart-shopping fa-lg" style="color: white;"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger carrinho_qtd" style="font-size: 0.7rem; padding: 4px 6px;">
                  0
                  <span class="visually-hidden">itens do carrinho</span>
                </span>
              </a>
            </li>

            <li class="nav-item justify-content-center icon-usuario m-2">
              <?php
              $go_to = isset($_SESSION['user']) && isset($_SESSION['logged_user']) ? "perfil" : "login";
              ?>
              <a class="perfil" href="<?= SITE ?>/<?= $go_to ?>" style="color: white;">
                <i class="fa-regular fa-circle-user fa-lg"></i>
                <?php
                if (isset($_SESSION['user']) && isset($_SESSION['logged_user'])) {
                  echo "Olá, {$_SESSION['user']}!";
                } else {
                  echo "";
                }
                ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</div>
