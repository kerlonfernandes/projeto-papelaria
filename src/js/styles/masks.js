$(document).ready(function () {
  // Descomente e ajuste conforme necessário as máscaras que deseja aplicar

  // $('.celular').mask('(00) 0 0000-0000');
  // $('.fone').mask('00 0000-0000');

  $(document).on("keyup", ".lowercase", function () {
    this.value = this.value.toLowerCase();
  });

  $(document).on("keyup", ".uppercase", function () {
    this.value = this.value.toUpperCase();
  });

  $(document).on("keyup", ".cnpj", function () {
    $(this).mask("00.000.000/0000-00");
  });

  $(document).on("keyup", ".tempoedit", function () {
    $(this).mask("00:00:00.000");
  });

  $(document).on("keyup", ".time", function () {
    $(this).mask("00:00:00");
  });

  $(document).on("keyup", ".cep", function () {
    $(this).mask("00000-000");
  });

  $(document).on("keyup", ".celular", function () {
    $(this).mask("(00) 0 0000-0000");
  });

  $(document).on("keyup", ".cpf", function () {
    $(this).mask("000.000.000-00");
  });

  $(document).on("keyup", ".digitnumero", function () {
    $(this).mask("0000");
  });
  $(document).on("keyup", ".moeda", function () {
    $(this).mask("000.000.000.000.000,00", { reverse: true });
  });
  $(document).on("keyup", ".cpfcnpj", function () {
    var cpfcnpj = $(this).val();
    const masks = ["000.000.000-000", "00.000.000/0000-00"];
    const mask = cpfcnpj.length >= 15 ? masks[1] : masks[0];
    $(this).mask(mask);
  });
});
