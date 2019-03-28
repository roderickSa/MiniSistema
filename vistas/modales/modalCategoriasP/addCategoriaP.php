<!-- Modal para agregar productos-->
<div class="modal fade" id="addCategoriaPModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="" method="post">
          <div class="form-group row">
            <label for="nombre" class="col-form-label col-3">Nombre</label>
            <input type="text" id="add_nombre_categoriap" class="form-control col-5" placeholder="Nombre">
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="registrarCategoriaP(event)">Registrar</button>
      </div>
    </div>
  </div>
</div>