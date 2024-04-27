
$(document).on("click", ".remove-prod", function (e) {
    e.stopPropagation();
    let id = $(this).attr("data-id");
    console.log(id);
});

$(document).ready(function () {
    $('#checkoutBtn').click(function () {
        var selectedIds = [];

        $('.form-check-input:checked').each(function () {
            var id = $(this).attr('data-id');
            selectedIds.push(id);
        });

        console.log(selectedIds);
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


load_view(".destaques", "#loading-destaques", `${TEMPLATES}/destaques.php`);
load_view(".materiais", "#loading-materiais", `${TEMPLATES}/materiais.php`);
load_view(".materiais-escritorio", "#loading-materiais-escritorio", `${TEMPLATES}/materiais-escritorio.php`);
load_view(".mochilas", "#loading-mochilas", `${TEMPLATES}/mochilas.php`);