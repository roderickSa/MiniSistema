$("document").ready(function(){

var inicio="";      //al cagar
$("#buscador").val("");   //al cargar
buscadorProductos();
paginacionOnLoad(inicio);  //llama a todos los datos al estar vacio llama a todos
crearPaginacionBuscador(inicio);  //crea la paginacion al estar vacio llama a todos(por la condicion)
});

function listarProductos(){

    $.ajax({
        url: '../ajax/productos.php?op=listarProductos',
        type: 'GET',
        dataType: 'html',     //valor de retorno
        data: {},
        error:function(){
            console.log("error");
        },
        success:function(data){
            $("#listaProductos").html(data);
        }
    });
    
}

function registrarProducto(evt){

    evt.preventDefault();

    var nombre=$("#add_nombre_producto").val();
    var precio=$("#add_precio_producto").val();
    var id_categoria=$("#add_categoria_producto").val();
    var stock=$("#add_stock_producto").val();   

    validarNumeros(precio,stock);console.log(nombre+precio+id_categoria+stock);

    $.ajax({
        url: '../ajax/productos.php?op=insertarProducto',
        type: 'POST',
        dataType: 'html',
        data: {nombre:nombre,id_categoria:id_categoria,precio:precio,stock:stock},
        error:function(){
            console.log("Error");
        },
        success:function(datos){
            console.log(datos);

            $("#addProductoModal").modal("hide");
            
            paginacionOnLoad("");
            crearPaginacionBuscador("");
            limpiarAddModal();
        }
    });
    
}

function editarProducto(id){

    if(id>0){

        $.ajax({
            url: '../ajax/productos.php?op=buscarPorId',
            type: 'GET',
            dataType: 'html',
            data: {id:id},
            error:function(){
            console.log("Error");
            },
            success:function(data){

            var producto=JSON.parse(data);

               $("#edit_id_producto").val(producto.id); 
               $("#edit_nombre_producto").val(producto.nombre); 
               $("#edit_precio_producto").val(producto.precio);  
               $("#edit_categoria_producto").val(producto.categoria);  
               $("#edit_stock_producto").val(producto.stock);         
            }
        });
        

    }
}

function actualizarProducto(evt){

    evt.preventDefault();

    var id= $("#edit_id_producto").val();
    var nombre=$("#edit_nombre_producto").val(); 
    var precio=$("#edit_precio_producto").val();  
    var id_categoria=$("#edit_categoria_producto").val();  
    var stock=$("#edit_stock_producto").val();
    
    validarNumeros(precio,stock);

    $.ajax({
          url: '../ajax/productos.php?op=actualizarProducto',
          type: 'POST',
          dataType: 'html',
          data: {
            id:id,
            nombre:nombre,
            precio:precio,
            id_categoria:id_categoria,
            stock:stock
            },
              error:function(){
              console.log("Error");
              },
              success:function(data){

                 $("#editProductoModal").modal("hide");

                 paginacionOnLoad("");
                 crearPaginacionBuscador("");
              }

          });
        
}

function eliminarProducto(id){

    var con=confirm("seguro de eliminar ??");

    if(con){
      $.ajax({
        url: '../ajax/productos.php?op=eliminarProducto',
        type: 'POST',
        dataType: 'html',
        data: {id:id},
        error:function(){
            console.log("Error");
        },
        success:function(data){
            console.log(data);

            paginacionOnLoad("");
            crearPaginacionBuscador("");

        }
    });
    }    
    
}


function crearPaginacionBuscador(nombre){

    $.ajax({
        url: '../ajax/productos.php?op=barraPaginacionBuscador',
        type: 'GET',
        dataType: 'html',
        data: {nombre:nombre},
        error:function(){
          console.log("Error");
        },
        success:function(data){

          $("#paginacion").html(data);     
          paginacionOnLoad(nombre);  
          paginacionOnClick(nombre); 
        }
    });
    
}

function paginacionOnClick(nombre){

    $(".page-link").click(function(e){
        e.preventDefault();

        var pagina=$(this).text();

        $.ajax({
        url: '../ajax/productos.php?op=paginacion',
        type: 'GET',
        dataType: 'html',
        data: {pagina: pagina,nombre:nombre},
        error:function(){
         console.log("Error al paginar");
        },
        success:function(data){
          $("#listaProductos").html(data);
        }
        });

    });    
}

function paginacionOnLoad(nombre){

    $.ajax({
        url: '../ajax/productos.php?op=paginacion',
        type: 'GET',
        dataType: 'html',
        data: {pagina: 1,nombre:nombre},
        error:function(){
         console.log("Error al paginar");
        },
        success:function(data){
          $("#listaProductos").html(data);
        }
    });

}


function buscadorProductos(){

    $("#buscador").focus();
    $("#buscador").keyup(function(event) {
        
        var valor=$("#buscador").val();

        $.ajax({
            url: '../ajax/productos.php?op=buscadorProductos',
            type: 'GET',
            dataType: 'html',
            data: {nombre: valor},
            error:function(){
             console.log("Error en la busqueda");
            },
            success:function(data){

                  $("#listaProductos").html(data);
                  crearPaginacionBuscador(valor);
            }
        });
        
    });
}

function limpiarAddModal(){

    $("#add_nombre_producto").val('');
    $("#add_precio_producto").val('');
    $("#add_categoria_producto").val('');
    $("#add_stock_producto").val('');
}

function validarNumeros(precio,stock){

    stock=parseInt(stock);
    precio=parseFloat(precio);

    if(isNaN(precio) || isNaN(stock)){
       alert("error en los campos precio o stock"); 
    }

}
