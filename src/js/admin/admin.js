$(document).ready(function () {
  openSidebar();

  $(".logout-btn").on("click", () => {
    createYesNoDialog("Tem certeza que deseja sair ?", () => {
      window.location.href = "./logout.php";
    });
  });

  function openSidebar() {
    var sidebar = document.getElementById("sidebar");
    if (sidebar) {
      sidebar.style.left = "0";
    }
  }

  function closeSidebar() {
    var sidebar = document.getElementById("sidebar");
    if (sidebar) {
      sidebar.style.left = "-340px";
    }
  }

  $(".menu-icon").on("click", () => {
    openSidebar();
  });

  $(".close-btn").on("click", () => {
    closeSidebar();
  });

  // usual functions

  function load_view(target, loader_div, view, data) {
    $.ajax({
      method: "GET",
      data: data,
      url: view,
      dataType: "html",
      beforeSend: function (xhr) {
        if ($(loader_div).length > 0) {
          $(loader_div).show();
        }
      },
      success: function (data) {
        $(target).html(data);
        if ($(loader_div).length > 0) {
          $(loader_div).hide();
        }
      },
      error: function (error) {
        console.log("Error:", error);
        console.log("URL:", view);
      },
    });
  }
  function reset_form(btn, form, callback) {
    $(btn).on("click", () => {
      $(form)[0].reset();
      if (typeof callback === "function") {
        callback();
      }
    });
  }

  // ajax
  $(document).on("submit", "#login_admin", function (e) {
    e.preventDefault();
    let login = $(this).serialize();
    if (login) {
      $.ajax({
        method: "POST",
        url: `${AJAX_ADMIN_URL}/login.php`,
        data: login,
        beforeSend: function (xhr) {
          $("#loading").show();
        },
        success: function (data) {
          data = JSON.parse(data);
          if (data.status == "success") {
            $("#loading").hide();
            $("#error-message").hide();
            $("#success-message").show();
            window.location.href = "./?route=painel&auth=admin";
          } else {
            $("#loading").hide();
            $("#success-message").hide();
            $("#error-message").show();
          }
          $("#loading").hide();
        },
        error: function (error) {
          console.log(error);
        },
      });
    }
  });

  function load_users_table(data) {
    var target = ".usuarios-table";
    var loader_div = "#loading";

    if ($(target).length > 0) {
      load_view(target, loader_div, `${RELOAD_ADMIN}/usuarios_table.php`, data);
    }
  }

  $(document).on("submit", "#pesquisar-usuario", function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    load_users_table(data);
  });

  reset_form("#button-clear-users", "#pesquisar-usuario", load_users_table());

  load_users_table();

  function load_products_table(data) {
    var target = ".table-products";
    var loader_div = "#loading";

    if ($(target).length > 0) {
      load_view(target, loader_div, `${RELOAD_ADMIN}/produtos_table.php`, data);
    }
  }

  $(document).on("submit", "#pesquisar-produto", function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    load_products_table(data);
  });

  reset_form("#button-clear", "#pesquisar-produto", load_products_table());

  // pedidos

  function load_pedidos_table(data) {
    var target = ".tabela-pedidos";
    var loader_div = "#loading";

    if ($(target).length > 0) {
      load_view(target, loader_div, `${RELOAD_ADMIN}/pedidos_table.php`, data);
    }
  }

  $(document).on("submit", "#pesquisar-pedido", function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    load_pedidos_table(data);
  });

  reset_form("#button-clear", "#pesquisar-pedido", load_pedidos_table());

  $(document).on("submit", ".cadastro-produto", function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    var images = [];
    var fileInput = $('[name="imagens[]"]')[0];
    if (fileInput.files.length > 0) {
      for (var i = 0; i < fileInput.files.length; i++) {
        images.push(fileInput.files[i].name);
      }
    }

    $.ajax({
      url: `${AJAX_ADMIN_URL}/cadastra_produto.php`,
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        let res = JSON.parse(response);
        showToast(res.status, res.message, (duration = 3000));
        load_products_table();
      },
      error: function (xhr, status, error) {
        console.error("Erro ao enviar dados:", error);
      },
    });
  });

  $(document).ready(function () {
    $("#imagens").change(function () {
      $(".carousel-inner").empty();
      const files = Array.from(this.files);

      if (files.length === 0) {
        return;
      }

      files.forEach(function (file, index) {
        const reader = new FileReader();

        reader.onload = function (e) {
          const image = $("<img>")
            .addClass("d-block w-100")
            .attr("src", e.target.result);
          const carouselItem = $("<div>")
            .addClass("carousel-item")
            .append(image);

          if (index === 0) {
            carouselItem.addClass("active");
          }

          $(".carousel-inner").append(carouselItem);
        };

        reader.readAsDataURL(file);
      });

      $("#carouselExample").carousel();
    });
  });
  $("#cadastrar-produto").on("shown.bs.modal", function () {
    load_view("#categorias-produtos", "", `${RELOAD_ADMIN}/categorias.php`);
    load_view("#tipo-produtos", "", `${RELOAD_ADMIN}/tipo_produto.php`);
  });

  $(document).ready(function () {
    $("#editar-produto").on("show.bs.modal", function (e) {
      var button = $(e.relatedTarget);
      var produtoNome = button.data("produto-nome");
      var descricao = button.data("descricao");
      var quantidade = button.data("quantidade");
      var preco = button.data("preco");
      var precoAnterior = button.data("preco-anterior");
      var categoria = button.data("categoria");
      var tipo = button.data("tipo");

      var modal = $(this);
      modal.find("#prod-nome").val(produtoNome);
      modal.find("#prod-descricao").val(descricao);
      modal.find("#prod-quantidade").val(quantidade);
      modal.find("#real").val(preco);
      modal.find("#prod-preco-anterior").val(precoAnterior);
      modal.find(".cat-editar").val(categoria);
      modal.find(".tipo-editar").val(tipo);
      modal.find(".cat-editar").text(categoria);
      modal.find(".tipo-editar").text(tipo);
      load_view(
        "#categorias-produtos-editar",
        "",
        `${RELOAD_ADMIN}/categorias.php`
      );
      load_view(
        "#tipo-produtos-editar",
        "",
        `${RELOAD_ADMIN}/tipo_produto.php`
      );
    });
  });

  $(document).on("click", ".deletar-produto", function () {
    let id_produto = $(this).data("id-produto");
    createYesNoDialog(
      "Tem certeza que deseja deletar o produto <strong>" +
        $(this).data("produto-nome") +
        "</strong> ?",
      () => {
        $.ajax({
          url: `${AJAX_ADMIN_URL}/deleta_produto.php`,
          type: "POST",
          data: { id_produto: id_produto },
          success: function (response) {
            response = JSON.parse(response)
            showToast(response.status, response.message, (duration = 3000));
            load_products_table();
          },
          error: function (xhr, status, error) {
            console.error("Erro ao enviar dados:", error);
          },
        });
      }
    );
  });

  // mudar imagem 
  $(document).on('click', "#btnSalvarImagem", function() {
    var formData = new FormData();

    var fileInput = document.getElementById('novaImagem');
    formData.append('imagem', fileInput.files[0]);
    formData.append('image_name', $("#imagemModal").attr("data-image"));
    formData.append('id_produto', $(this).data("prod-id"));

    $.ajax({
        type: 'POST',
        url: `${AJAX_ADMIN_URL}/mudar_imagem_produto.php`,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          response = JSON.parse(response)
          showToast(response.status, response.message, (duration = 3000));
        },
        error: function(xhr, status, error) {
            console.error('Erro ao enviar imagem:', error);
        }
    });

    $('#uploadImagemModal').modal('hide');
});

});
