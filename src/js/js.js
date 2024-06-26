$(document).on("click", ".remove-prod", function (e) {
  e.stopPropagation();
  let id = $(this).attr("data-id");
  console.log(id);
});

$(document).ready(function () {
  $("#checkoutBtn").click(function () {
    var selectedIds = [];

    $(".form-check-input:checked").each(function () {
      var id = $(this).attr("data-id");
      selectedIds.push(id);
    });
  });
});
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

function checkClassesExistence(classes) {
  for (let cls of classes) {
    if (!document.querySelector(cls)) {
      return false;
    }
  }
  return true;
}

const home = [".destaques", ".materiais", ".materiais-escritorio", ".mochilas"];
if (checkClassesExistence(home)) {
  load_view(".destaques", "#loading-destaques", `${TEMPLATES}/destaques.php`);
  load_view(".materiais", "#loading-materiais", `${TEMPLATES}/materiais.php`);
  load_view(
    ".materiais-escritorio",
    "#loading-materiais-escritorio",
    `${TEMPLATES}/materiais-escritorio.php`
  );
  load_view(".mochilas", "#loading-mochilas", `${TEMPLATES}/mochilas.php`);
}

// carrinho
const carrinho = [".carrinho-items", ".subtotal"];

if (checkClassesExistence(carrinho)) {
  load_view(".carrinho-items", "", `${LOAD}/carrinho_itens.php`);
  load_view(".subtotal", "", `${LOAD}/subtotal.php`);
}

load_view(".carrinho_qtd", "", `${LOAD}/carrinho_itens_qtd.php`);

$(document).on("click", ".adicionar", function () {
  let id = $(this).attr("data-prod");
  console.log(id);
  $.ajax({
    method: "POST",
    data: { id: id },
    url: `${AJAX}/add_to_cart.php`,

    success: function (res) {
      res = JSON.parse(res);
      swal(res.retorno, res.message, res.status);
      load_view(".carrinho_qtd", "", `${LOAD}/carrinho_itens_qtd.php`);
    },
    error: function (error) {
      swal("Ocorreu um erro!", "Verifique sua conexão com a internet", "error");
    },
  });
});

function incrementarQuantidade(btn) {
  var input = $(btn).closest(".input-group").find(".quantidade-input");
  var valor = parseInt(input.val());
  input.val(valor + 1);
}

function decrementarQuantidade(btn) {
  var input = $(btn).closest(".input-group").find(".quantidade-input");
  var valor = parseInt(input.val());
  if (valor > 0) {
    input.val(valor - 1);
  }
}

$(document).on("click", ".diminui-qtd", function () {
  decrementarQuantidade(this);
  let id = $(this).attr("data-id");
  $.ajax({
    method: "POST",
    data: { id: id },
    url: `${AJAX}/diminui_qtd.php`,
    success: function (res) {
      res = JSON.parse(res);
      load_view(".subtotal", "", `${LOAD}/subtotal.php`);
    },
    error: function (error) {
      swal("Ocorreu um erro!", "Verifique sua conexão com a internet", "error");
    },
  });
});

$(document).on("click", ".aumentar-qtd", function () {
  incrementarQuantidade(this);
  let id = $(this).attr("data-id");
  let checkboxChecked = $(this)
    .closest(".card")
    .find(".form-check-input")
    .is(":checked");
  let is_checked = ""  
    if(checkboxChecked == true) {
      is_checked = "1"
    }
    else {
      is_checked = "0"
    }
  $.ajax({
    method: "POST",
    data: {
      id: id,
      checkboxChecked: is_checked,
    },
    url: `${AJAX}/aumenta_qtd.php`,
    success: function (res) {
      res = JSON.parse(res);
      // swal(res.retorno, res.message, res.status);
      // load_view(".carrinho_qtd", "", `${LOAD}/carrinho_itens_qtd.php`);
      load_view(".subtotal", "", `${LOAD}/subtotal.php`);
    },
    error: function (error) {
      swal("Ocorreu um erro!", "Verifique sua conexão com a internet", "error");
    },
  });
});

$(document).on("click", ".form-check-input", function () {
  let id = $(this).attr("data-id");
  let action = $(this).is(":checked") ? "select" : "unselect";

  $.ajax({
    method: "POST",
    url: `${AJAX}/selecionar_produto.php`,
    data: {
      id: id,
      action: action,
    },
    dataType: "json",
    success: function (response) {
      load_view(".subtotal", "", `${LOAD}/subtotal.php`);
    },
    error: function (xhr, status, error) {
      console.error("Erro na requisição AJAX:", error);
    },
  });
});

$("#finalizar").on("show.bs.modal", function (e) {
  load_view(".itens_pedido", ".loader-finalizar", `${LOAD}/itens_pedido.php`);
  load_view(".subtotal_finalizar", "", `${LOAD}/subtotal.php`);
});

$(document).on("click", ".finalizar_pedido", function () {
  swal("Você tem certeza que deseja continuar com este pedido ?", {
    buttons: {
      cancel: "Não",
      catch: {
        text: "Sim",
        value: "catch",
      },
    },
  }).then((value) => {
    switch (value) {
      case "catch":
        $.ajax({
          method: "GET",
          url: `${AJAX}/fazer_pedido.php`,
          success: function (res) {
            res = JSON.parse(res);
            swal(res.retorno, res.message, res.status);
            if (res.status != "error")
              setTimeout(function () {
                window.location.href = `${SITE}/pedido/${res.id}`;
              }, 2000); // 3000 milissegundos = 3 segundos
          },
          error: function (error) {
            swal(
              "Ocorreu um erro!",
              "Verifique sua conexão com a internet",
              "error"
            );
          },
        });
        break;
    }
  });
});

$(document).on("click", ".remove-prod", function () {
  let id = $(this).attr("data-id");
  $.ajax({
    method: "POST",
    data: { id: id },
    url: `${AJAX}/remove_item.php`,
    success: function (res) {
      res = JSON.parse(res);
      showToast(res.status, res.message, (duration = 3000));

      load_view(".carrinho_qtd", "", `${LOAD}/carrinho_itens_qtd.php`);
      load_view(".carrinho-items", "", `${LOAD}/carrinho_itens.php`);
      load_view(".subtotal", "", `${LOAD}/subtotal.php`);
    },
    error: function (error) {
      swal("Ocorreu um erro!", "Verifique sua conexão com a internet", "error");
    },
  });
});

$(document).ready(function () {
  $(".form-check-input").click(function () {
    var valor = $(this).val();
    $(".form-group").hide();
    $("#" + valor + "Form .form-group").show();
  });
});

$(document).ready(function () {
  $(".btn-next").click(function () {
    var currentStep = $(".step-item.active");
    var nextStep = currentStep.next();
    currentStep.removeClass("active");
    nextStep.addClass("active");
    $("#" + currentStep.attr("id") + "_content").hide();
    $("#" + nextStep.attr("id") + "_content").show();

    var nomeCompleto = $("#nomeCompleto").val();
    var telefone = $("#telefone").val();
    var endereco = $("#endereco").val();
    var numeroResidencia = $("#numeroResidencia").val();
    var complemento = $("#complemento").val();
    var bairro = $("#bairro").val();
    var cidade = $("#cidade").val();
    var estado = $("#estado").val();

    $("#nomeRevisao").text(nomeCompleto);
    $("#telefoneRevisao").text(telefone);
    $("#enderecoRevisao").text(endereco);
    $("#numeroRevisao").text(numeroResidencia);
    $("#complementoRevisao").text(complemento);
    $("#bairroRevisao").text(bairro);
    $("#cidadeRevisao").text(cidade);
    $("#estadoRevisao").text(estado);
  });

  $(".btn-prev").click(function () {
    var currentStep = $(".step-item.active");
    var prevStep = currentStep.prev();
    currentStep.removeClass("active");
    prevStep.addClass("active");
    $("#" + currentStep.attr("id") + "_content").hide();
    $("#" + prevStep.attr("id") + "_content").show();
  });

  $(document).ready(function () {
    $(".confirmar").on("click", function () {
      var nomeCompleto = $("#nomeCompleto").val();
      var telefone = $("#telefone").val();
      var endereco = $("#endereco").val();
      var complemento = $("#complemento").val();
      var bairro = $("#bairro").val();
      var cidade = $("#cidade").val();
      var estado = $("#estado").val();

      if (
        nomeCompleto == "" ||
        telefone == "" ||
        endereco == "" ||
        complemento == "" ||
        bairro == "" ||
        cidade == "" ||
        estado == ""
      ) {
        showToast(
          "error",
          "Todos os campos devem ser preenchidos corretamente!"
        );
      }
    });
  });

  $(document).on("submit", "#enderecoForm", function (e) {
    e.preventDefault();
    swal("Você tem certeza que os seus dados de endereço estão certos ?", {
      buttons: {
        cancel: "Não",
        catch: {
          text: "Sim",
          value: "catch",
        },
      },
    }).then((value) => {
      switch (value) {
        case "catch":
          let dados = $(this).serialize();
          $.ajax({
            method: "POST",
            data: dados,
            url: `${AJAX}/cadastra_endereco.php`,
            success: function (res) {
              res = JSON.parse(res);
              swal(res.retorno, res.message, res.status);
              if (res.status != "error") {
                setTimeout(function () {
                  window.location.href = `${SITE}/pedido/checkout/${res.id}`;
                }, 2000);
              }
            },
            error: function (error) {
              swal(
                "Ocorreu um erro!",
                "Verifique sua conexão com a internet",
                "error"
              );
            },
          });
          break;
      }
    });
  });

  $(document).on("keyup", ".cep", function () {
    let cep = $(this).val().replace(/\D/g, "");

    if (cep != "" && cep.length == 8) {
      $.ajax({
        url: "https://viacep.com.br/ws/" + cep + "/json/",
        dataType: "json",
        type: "GET",
        success: function (data) {
          if (!("erro" in data)) {
            $("#logradouro").val(data.logradouro);
            $("#bairro").val(data.bairro);
            $("#cidade").val(data.localidade);
            $("#estado").val(data.uf);
          } else {
            alert("CEP não encontrado.");
          }
        },
        error: function () {
          alert("Erro ao buscar CEP. Por favor, tente novamente mais tarde.");
        },
      });
    } else {
      //   alert("Formato de CEP inválido.");
    }
  });

  const pedidos_area = [
    "#listaPedidos",

  ];
  if (checkClassesExistence(pedidos_area)) {
    load_view(
      ".pedido-items",
      "#loading-pedidos",
      `${LOAD}/pedidos.php`
    )
  }
});
