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
      const formElement = document.querySelector(form);
      if (formElement) {
        formElement.reset();
        if (typeof callback === "function") {
          callback();
        }
      } else {
        console.error("Form element not found");
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

  var currentPage = 1;

  function load_products_table_pagination(page = 1) {
    var target = ".table-products";
    var loader_div = "#loading";

    if ($(target).length > 0) {
      load_view(
        target,
        loader_div,
        `${RELOAD_ADMIN}/produtos_table.php?page=${page}`
      );
      $("#current-page").text(page);
    }
  }

  $(document).ready(function () {
    load_products_table_pagination();

    $("#next-page").click(function () {
      currentPage++;
      load_products_table_pagination(currentPage);
    });

    $("#prev-page").click(function () {
      if (currentPage > 1) {
        currentPage--;
        load_products_table_pagination(currentPage);
      }
    });
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
        $(".cadastro-produto")[0].reset();
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
    $("#edita-produto").on("show.bs.modal", function (e) {
      var button = $(e.relatedTarget);
      var produtoNome = button.data("produto-nome");
      var descricao = button.data("descricao");
      var quantidade = button.data("quantidade");
      var preco = button.data("preco");
      var precoAnterior = button.data("preco-anterior");
      var categoria = button.data("categoria");
      var tipo = button.data("tipo");
      var id = button.data("id");

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
      modal.find(".id-prod").val(id);

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
            response = JSON.parse(response);
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
  $(document).on("click", "#btnSalvarImagem", function () {
    var formData = new FormData();

    var fileInput = document.getElementById("novaImagem");
    formData.append("imagem", fileInput.files[0]);
    formData.append("image_name", $("#imagemModal").attr("data-image"));
    formData.append("id_produto", $(this).data("prod-id"));

    $.ajax({
      type: "POST",
      url: `${AJAX_ADMIN_URL}/mudar_imagem_produto.php`,
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        response = JSON.parse(response);
        showToast(response.status, response.message, (duration = 3000));
      },
      error: function (xhr, status, error) {
        console.error("Erro ao enviar imagem:", error);
      },
    });

    $("#uploadImagemModal").modal("hide");
  });

  // adicionar mais imagens
  $(document).on("click", "#enviar-mais-imagens", function () {
    var formData = new FormData();
    var fileInput = document.getElementById("maisImg");
    var files = fileInput.files;

    for (var i = 0; i < files.length; i++) {
      formData.append("imagens[]", files[i]);
    }

    formData.append("id_produto", $(this).data("prod-id"));

    $.ajax({
      type: "POST",
      url: `${AJAX_ADMIN_URL}/add_imagens.php`,
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        response = JSON.parse(response);
        showToast(response.status, response.message, (duration = 3000));

        $("#addImagens").modal("hide");
      },
      error: function (xhr, status, error) {
        console.error("Erro ao enviar imagem:", error);
      },
    });
  });
  //apagar imagens
  $(document).on("click", "#btnDeleteImagem", function () {
    var formData = new FormData();
    formData.append("id_produto", $(this).data("prod-id"));
    formData.append("image_name", $("#imagemModal").attr("data-image"));

    console.log(formData);
    $.ajax({
      type: "POST",
      url: `${AJAX_ADMIN_URL}/delete_image.php`,
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        response = JSON.parse(response);
        showToast(response.status, response.message, (duration = 3000));
      },
      error: function (xhr, status, error) {
        console.error("Erro ao enviar imagem:", error);
      },
    });

    $("#uploadImagemModal").modal("hide");
  });

  function edita_produto(e) {}

  $(document).on("submit", ".edita-produto", function (e) {
    e.preventDefault();
    let dados_form = $(this).serialize();
    createYesNoDialog(
      "Tem certeza que deseja editar este produto ?",
      function () {
        let id_produto = $("#editar-btn").attr("data-id-produto");

        let formData = dados_form + "&id_produto=" + id_produto;
        console.log(formData);
        $.ajax({
          url: `${AJAX_ADMIN_URL}/editar_produto.php`,
          type: "POST",
          data: formData,
          success: function (response) {
            let res = JSON.parse(response);
            showToast(res.status, res.message, (duration = 3000));
            load_products_table();
          },
          error: function (xhr, status, error) {
            console.error("Erro ao enviar dados:", error);
          },
        });
      }
    );
  });

  $(document).on("submit", ".editar-produto", function (e) {});

  function load_categorias_table() {
    var target = ".categorias-table";
    var loader_div = "#loading-categorias";

    if ($(target).length > 0) {
      load_view(target, loader_div, `${RELOAD_ADMIN}/listar_categorias.php`);
    }
  }

  $(document).ready(function () {
    $("#categorias").on("show.bs.modal", function (e) {
      load_categorias_table();
    });
  });

  function load_tipos_table() {
    var target = ".tipos-table";
    var loader_div = "#loading-tipos";

    if ($(target).length > 0) {
      load_view(target, loader_div, `${RELOAD_ADMIN}/listar_tipos.php`);
    }
  }
  $(document).ready(function () {
    $("#tipos").on("show.bs.modal", function (e) {
      load_tipos_table();
    });
  });

  $(document).on(
    "submit",
    ".cadastrar-tipo, .cadastrar-categoria",
    function (e) {
      e.preventDefault();

      const formData = $(this).serialize();

      $.ajax({
        url: `${AJAX_ADMIN_URL}/cadastar_categoria_tipo.php`,
        type: "POST",
        data: formData,
        success: function (response) {
          let res = JSON.parse(response);
          showToast(res.status, res.message, (duration = 3000));
          load_categorias_table();
          load_tipos_table();
          document.querySelector(".cadastrar-tipo").reset();
          document.querySelector(".cadastrar-categoria").reset();
        },
        error: function (xhr, status, error) {
          console.error("Erro ao enviar dados:", error);
        },
      });
    }
  );

  $(document).on("click", ".deletar-tipo", function () {
    let id = $(this).data("id");

    $.ajax({
      url: `${AJAX_ADMIN_URL}/deleta_tipo.php`,
      type: "POST",
      data: { id: id },
      success: function (response) {
        response = JSON.parse(response);
        showToast(response.status, response.message, (duration = 3000));
        load_tipos_table();
      },
      error: function (xhr, status, error) {
        console.error("Erro ao enviar dados:", error);
      },
    });
  });

  $(document).on("click", ".deletar-categoria", function () {
    let id_categoria = $(this).data("id");
    $.ajax({
      url: `${AJAX_ADMIN_URL}/deleta_categoria.php`,
      type: "POST",
      data: { id: id_categoria },
      success: function (response) {
        response = JSON.parse(response);
        showToast(response.status, response.message, (duration = 3000));
        load_categorias_table();
      },
      error: function (xhr, status, error) {
        console.error("Erro ao enviar dados:", error);
      },
    });
  });

  $(document).on("click", ".apaga-pedido", function () {
    let id = $(this).attr("data-id");
    createYesNoDialog(
      "Tem certeza que deseja deletar este pedido ?",
      function () {
        $.ajax({
          url: `${AJAX_ADMIN_URL}/deleta_pedido.php`,
          type: "POST",
          data: { id: id },
          success: function (response) {
            response = JSON.parse(response);

            showToast(response.status, response.message, (duration = 3000));
            load_pedidos_table();
          },
          error: function (xhr, status, error) {
            console.error("Erro ao enviar dados:", error);
          },
        });
      }
    );
  });

  $(document).on("change", ".muda-status", function () {
    let id = $(this).attr("data-id");
    let status = $(this).val();
    $.ajax({
      url: `${AJAX_ADMIN_URL}/mudar_status_pedido.php`,
      type: "POST",
      data: {
        id: id,
        status: status,
      },
      success: function (response) {
        response = JSON.parse(response);
        showToast(response.status, response.message, (duration = 3000));
      },
      error: function (xhr, status, error) {
        console.error("Erro ao enviar dados:", error);
      },
    });
  });

  $(document).ready(function () {
    load_view(".dados-usuario", "", `${RELOAD_ADMIN}/dados_pedido.php`, {
      id: $(".dados").val(),
    });
    load_view(
      ".produtos-pedidos",
      ".spinner-2",
      `${RELOAD_ADMIN}/produtos_pedidos.php`,
      { id: $(".dados").val() }
    );
  });

  $(document).on("click", ".diminui-qtd", function () {
    decrementarQuantidade(this);
    let id = $(this).attr("data-id");
    let id_produto = $(this).attr("data-id-produto");
    $.ajax({
      method: "POST",
      data: { id: id, id_produto: id_produto },
      url: `${AJAX_ADMIN_URL}/diminui_qtd_pedido.php`,
      success: function (res) {
        res = JSON.parse(res);
        load_view(
          ".produtos-pedidos",
          ".spinner-2",
          `${RELOAD_ADMIN}/produtos_pedidos.php`,
          { id: $(".dados").val() }
        );
      },
      error: function (error) {
        swal(
          "Ocorreu um erro!",
          "Verifique sua conexão com a internet",
          "error"
        );
      },
    });
  });
  function incrementarQuantidade(btn) {
    var input = $(btn).closest(".input-group").find(".quantidade-input");
    var valor = parseInt(input.text()); // Obtemos o texto do span e convertemos para inteiro
    input.text(valor + 1); // Incrementamos o valor e atualizamos o texto do span
  }

  function decrementarQuantidade(btn) {
    var input = $(btn).closest(".input-group").find(".quantidade-input");
    var valor = parseInt(input.text()); // Obtemos o texto do span e convertemos para inteiro
    if (valor > 0) {
      input.text(valor - 1); // Decrementamos o valor e atualizamos o texto do span, se for maior que 0
    }
  }

  $(document).on("click", ".aumentar-qtd", function () {
    incrementarQuantidade(this);
    let id = $(this).attr("data-id");
    let id_produto = $(this).attr("data-id-produto");

    $.ajax({
      method: "POST",
      data: { id: id, id_produto: id_produto },
      url: `${AJAX_ADMIN_URL}/aumenta_qtd_pedido.php`,
      success: function (res) {
        res = JSON.parse(res);
        load_view(
          ".produtos-pedidos",
          ".spinner-2",
          `${RELOAD_ADMIN}/produtos_pedidos.php`,
          { id: $(".dados").val() }
        );

        // swal(res.retorno, res.message, res.status);
        // load_view(".carrinho_qtd", "", `${LOAD}/carrinho_itens_qtd.php`);
        // load_view(".subtotal", "", `${RELOAD_ADMIN}/subtotal.php`);
      },
      error: function (error) {
        swal(
          "Ocorreu um erro!",
          "Verifique sua conexão com a internet",
          "error"
        );
      },
    });
  });
  function removerReadonly(className) {
    $(className).removeAttr("readonly");
  }
  function adicionarReadonly(className) {
    $(className).attr("readonly", "readonly");
  }
  let end_btn = 0;
  $(document).on("click", ".editar-endereco", function () {
    if (end_btn == 0) {
      $(this).addClass("active");
      removerReadonly(".form-control.cep");
      removerReadonly(".form-control.endereco");
      removerReadonly(".form-control.numero");
      removerReadonly(".form-control.complemento");
      removerReadonly(".form-control.bairro");
      removerReadonly(".form-control.cidade");
      removerReadonly(".form-control.estado");
      $(this).text("Salvar")
      end_btn = 1;
    } else if (end_btn == 1) {
      adicionarReadonly(".form-control.cep");
      adicionarReadonly(".form-control.endereco");
      adicionarReadonly(".form-control.numero");
      adicionarReadonly(".form-control.complemento");
      adicionarReadonly(".form-control.bairro");
      adicionarReadonly(".form-control.cidade");
      adicionarReadonly(".form-control.estado");
      end_btn = 0;
      $(this).text("Editar Endereço")
      $(this).removeClass("active");
    }
  });
});
