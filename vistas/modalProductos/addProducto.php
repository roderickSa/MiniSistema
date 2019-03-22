<!-- Modal para agregar productos-->
<div class="modal fade" id="addProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form action="" method="post">
          <div class="form-group row">
            <label for="nombre" class="col-form-label col-3">Nombre</label>
            <input type="text" id="add_nombre_producto" class="form-control col-5" placeholder="Nombre">
          </div>
          <div class="form-group row">
            <label for="categoria" class="col-form-label col-3">Categoria</label>
            <div class="form-group">
              <select class="combobox form-control" name="inline" id="add_categoria_producto">
                  <?php foreach($categorias as $row){?>
                  <option value="<?php echo $row['categoria'] ?>"><?php echo $row['categoria'] ?></option>
                  <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="precio" class="col-form-label col-3">Precio</label>
            <input type="number" step="0.01" id="add_precio_producto" class="form-control col-5" placeholder="Precio">
          </div>
          <div class="form-group row">
            <label for="stock" class="col-form-label col-3">Stock</label>
            <input type="number" id="add_stock_producto" class="form-control col-5" placeholder="Stock">
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="registrarProducto(event)">Registrar</button>
      </div>
    </div>
  </div>
</div>