const page = new Page();

$(document).ready(function () {
    $('#checkoutBtn').click(function () {
        var selectedIds = [];

        $('.form-check-input:checked').each(function () {
            var id = $(this).attr('data-id');
            selectedIds.push(id);
        });

    });
});

document.addEventListener("DOMContentLoaded", function() {

    function toggleCheckbox(event) {
        if (event.target.tagName === 'BUTTON') return;
        if (event.target.tagName === 'INPUT') return;
        if (event.target.tagName === 'IMG') return;
        if (event.target.tagName === 'A') return;
        var checkbox = event.currentTarget.querySelector('.form-check-input');
        checkbox.checked = !checkbox.checked;
    }

    $(".prod-card").on("click", (e) => {
        toggleCheckbox(e)
    })

    // window.addEventListener("scroll", function() {
    //     var header = document.getElementById("navbar");
    //     if (window.scrollY > 0) {
    //       header.classList.add("fixed-header"); 
    //     } else {
    //       header.classList.remove("fixed-header"); 
    //     }
    //   });

    Page.hideOverlay();
});

