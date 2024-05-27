<div class="container">
    <input type="hidden" class="dados" value="<?= $helpers->decodeURL($_GET['id']) ?>">
    <div class="card" style="border: none; background-color: #EEEEEE;">
        <div class="dados-usuario">

        </div>

        <div class="produtos-pedidos m-5">
            <div class="text-center spinner-2 m-5">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>


    </div>
</div>