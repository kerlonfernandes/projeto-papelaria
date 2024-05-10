<div class="modal fade" id="finalizar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="finalizarLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl"> <!-- Adicione a classe modal-xl aqui -->
        <div class="modal-content" style="border-radius: 2px; border:none; height: 800px;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="finalizarLabel">Resumo do pedido</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-y: auto;">
                <div class="itens_pedido">
                    <div class="text-center mt-3" id="loading-finalizar" style="display:block; padding:150px;">
                        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <h2 class="alert alert-primary">Valor pedido R$<span class="subtotal_finalizar"></span></h2>
            
            <button class="btn btn-outline-success btn-lg floating-button ml-auto finalizar_pedido" style="border-radius: 2px; height:70px;" data-toggle="modal">Finalizar Pedido</button>
            </div>


        </div>
    </div>
</div>