

    
    
    $(".logout-btn").on("click", () => {

        createYesNoDialog("Tem certeza que deseja sair ?", 
        () => {
            window.location.href = "./logout.php";
        }
        
    );
        
    });

    function openSidebar() {
        document.getElementById("sidebar").style.left = "0";
    }

    function closeSidebar() {
        document.getElementById("sidebar").style.left = "-340px";
    }

    document.querySelector(".menu-icon").addEventListener("click", () => {
        openSidebar();
    })
    document.querySelector(".close-btn").addEventListener("click", () => {
        closeSidebar();
    })

    openSidebar()
    
    $("#overlay-admin").fadeOut('slow', function() {});    

