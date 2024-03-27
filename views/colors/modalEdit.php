<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar cor <span id="model-id"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" data-edit>
                <input type="hidden" name="_method" value="PUT">
                <div class="modal-body">
                    <div class="alert alert-warning">Se informado os 2 campos, Cor específica terá preferência.</div>
                    <button type="button" class="btn btn-primary mb-3" data-color>Usar cor específica</button>
                    <div class="row color-group">
                        <div class="col-md-8 mb-3 color_simple_block">
                            <label for="color_simple_input" class="form-label">Cor simples</label>
                            <input type="text" class="form-control form-control-simple-color" id="color_simple_input" placeholder="Cor Simples" name="color_simple" required>
                        </div>
                        <div class="col-md-4 mb-3 color_specific_block d-none">
                            <label for="color_specific_input" class="form-label">Cor específica</label>
                            <input type="color" class="form-control form-control-color" id="color_specific_input" name="" value="#000000">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="spinner spinner-border spinner-border-sm d-none" aria-hidden="true"></span>
                        <span role="status">Salvar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>