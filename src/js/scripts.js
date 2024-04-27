const page = new Page();

document.addEventListener("DOMContentLoaded", function() {

    function toggleCheckbox(event) {
        if (event.target.tagName === 'BUTTON') return;
        if (event.target.tagName === 'IMG') return;
        if (event.target.tagName === 'A') return;
        var checkbox = event.currentTarget.querySelector('.form-check-input');
        checkbox.checked = !checkbox.checked;
    }

    $(".prod-card").on("click", (e) => {
        toggleCheckbox(e)
    })


    


    Page.hideOverlay();
});
