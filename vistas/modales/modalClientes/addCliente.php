<!-- Modal para agregar clientes-->
<div class="modal fade" id="addClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="" method="post">
          <div class="form-group row">
            <label for="nombres" class="col-form-label col-3">Nombres</label>
            <input type="text" id="add_nombres_cliente" class="form-control col-5"
             placeholder="Nombres">
          </div>
          <div class="form-group row">
            <label for="apellidos" class="col-form-label col-3">Apellidos</label>
            <input type="text" id="add_apellidos_cliente" class="form-control col-5"
             placeholder="Apellidos">
          </div>
          <div class="form-group row">
             <label for="dni" class="col-form-label col-3">DNI</label>
            <input type="number" id="add_dni_cliente" class="form-control col-5"
             placeholder="DNI">
          </div>
          <div class="form-group row">
             <label for="correo" class="col-form-label col-3">Correo</label>
            <input type="email" id="add_correo_cliente" class="form-control col-5"
             placeholder="Correo">
          </div>
          <div class="form-group row">
             <label for="telefono" class="col-form-label col-3">Telefono</label>
            <input type="number" id="add_telefono_cliente" class="form-control col-5"
             placeholder="Telefono">
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="registrarCliente(event)">Registrar</button>
      </div>
    </div>
  </div>
</div>