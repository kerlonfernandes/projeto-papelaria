<div class="carrousel-inicio" style="background-color: #FFC700; margin-top:-25px;">
  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary custom-navbar m-3 bg-navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= SITE ?>">
        <img src="<?= SITE ?>/src/images/logo.png" class="img-fluid" alt="Logo" style="max-width: 200px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= SITE ?>/">Início</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= SITE ?>/categoria/material-escolar">Material Escolar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= SITE ?>/categoria/material-escritorio">Material de Escritório</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= SITE ?>/categoria/mochilas">Mochilas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?= SITE ?>/categoria/cadernos">Cadernos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Contato</a>
          </li>
        </ul>

        <form class="d-flex">
          <input class="form-control me-2 input-pesquisa" type="search" placeholder="Pesquisar produto..." aria-label="Search">
          <button class="btn btn-outline" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>



      </div>
      <button class="btn ml-2 p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa-solid fa-circle-user fa-lg"></i>
      </button>
    </div>
  </nav>
  <div class="collapse mb-3" id="collapseExample">
  <div class="card card-body" style="background-color:#FFC100">
    <ul class="navbar-nav">

      <li class="nav-item icon-usuario m-2">
        <?php
        $go_to = isset($_SESSION['user']) && isset($_SESSION['logged_user']) ? "perfil" : "login";
        ?>
        <a class="perfil" href="<?= SITE ?>/<?= $go_to ?>" style="color:black; text-decoration: none;">
          <i class="fa-regular fa-circle-user fa-lg"></i>
          <?php
          if (isset($_SESSION['user']) && isset($_SESSION['logged_user'])) {
            echo "Seu perfil";
          } else {
            echo "Entrar";
          }
          ?>
        </a>
      </li>
      <?php if(isset($_SESSION['user']) && isset($_SESSION['logged_user'])): ?>
      <li class="nav-item icon-usuario m-2">
        <a class="cart position-relative" href="<?= SITE ?>/carrinho" style="color:black; text-decoration: none;">
          <i class="fa-solid fa-cart-shopping fa-lg"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger carrinho_qtd" style="font-size: 0.7rem; padding: 4px 6px;">
            0
            <span class="visually-hidden">itens do carrinho</span>
          </span>
          Seu carrinho
        </a>
      </li>

      <li class="nav-item icon-usuario m-2">

        <a class="cart position-relative" href="<?= SITE ?>/seus-pedidos" style="color:black; text-decoration: none;">
        <i class="fa-solid fa-bag-shopping fa-lg"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger pedidos_qtd" style="font-size: 0.7rem; padding: 4px 6px;">
            0
            <span class="visually-hidden">Pedidos</span>
          </span>
          Seus pedidos
        </a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</div>
</div>

