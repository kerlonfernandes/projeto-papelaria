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

  if ($(".usuarios-table").length > 0) {
    $.ajax({
      method: "GET",
      url: `${RELOAD_ADMIN}/usuarios_table.php`,
      dataType: "html",
      beforeSend: function (xhr) {
        $("#loading").show();
      },
      success: function (data) {
        $(".usuarios-table").html(data);
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  $(document).on("submit", "#pesquisar-usuario", function (e) {
    e.preventDefault();
    let data = $(this).serialize();
    console.log(data);
    $.ajax({
      method: "GET",
      url: `${RELOAD_ADMIN}/usuarios_table.php`,
      data: data,
      beforeSend: function (xhr) {
        $("#loading").show();
      },
      success: function (data) {
        $(".usuarios-table").html(data);
      },
      error: function (error) {
        console.log(error);
      },
    });
  });

  $("#button-clear-users").on("click", () => {
    $("#pesquisar-usuario")[0].reset();
  });

  //   if ($(".usuarios-table")) {
  //     $.ajax({
  //       method: "GET",
  //       url: `${RELOAD_ADMIN}/usuarios_table.php`,
  //       dataType: "html",
  //       beforeSend: function (xhr) {
  //         $("#loading").show();
  //       },
  //       success: function (data) {
  //         $(".usuarios-table").html(data);
  //       },
  //       error: function (error) {
  //         console.log(error);
  //       },
  //     });
  //   }
  $("#overlay-admin").fadeOut("slow", function () {});
});
