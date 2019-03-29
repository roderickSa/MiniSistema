$("document").ready(function(){

	buscarNombre();
	buscarProducto();
	llenadoCantidadProducto();
	$("#formulario_generar_pedidos").hide();  //oculta formulario de productos
	$("#quitarUltimoPedido").hide();      //oculta boton para quitar un producto
});

//funcion que busca los clientes por filtrado

function buscarNombre(){

  $("#nombreCliente").focus();
  $("#nombreCliente").keyup(function(event) {
  	
  	var nombres=$("#nombreCliente").val();

  	$.ajax({
  		url: '../ajax/pedidos.php?op=buscarNombre',
  		type: 'GET',
  		dataType: 'html',
  		data: {nombres:nombres},
  		error:function(){
        console.log("Error");
  		},
  		success:function(data){
         $("#comboNombres").show();
         $("#comboNombres").html('');      
         $("#comboNombres").append(data);
  		}
  	});
  	
  });
}

//permite seleccionar el item elejido y lo rellena en los campos
function elijeItemPedido(id,nombres,apellidos,dni,correo){

    $("#cliente_id").val(id);
    $("#nombreCliente").val(nombres+" "+apellidos);
    $("#comboNombres").hide();
    $("#dniCliente").val(dni);
    $("#correoCliente").val(correo);

}

//funcion q crea el pedido

function cargarPedido(evt){   

  evt.preventDefault();

  var cliente_id=$("#cliente_id").val();
  var nombreCliente=$("#nombreCliente").val();

  if(cliente_id.length!=0 && nombreCliente.length!=0){

        $.ajax({

        	url: '../ajax/pedidos.php?op=registrarPedido',
        	type: 'POST',
        	dataType: 'html',
        	data: {cliente_id : cliente_id},
        	error:function(){
        		console.log("Error");
        	},
        	success:function(data){

        	  console.log(data);
        	  buscarPedido(cliente_id);
        	}
        });
        

  	}else {
  		alert("campo vacio");
  	}
}

//funcion q habilita el pedido creado para insertar los campos de la tabla pedido_detalle

function buscarPedido(cliente_id){

   $.ajax({
        	url: '../ajax/pedidos.php?op=buscarPedido',
        	type: 'GET',
        	dataType: 'html',
        	data: {cliente_id : cliente_id},
        	error:function(){
        		console.log("Error");
        	},
        	success:function(data){

        	  var pedido=JSON.parse(data);
              
              $("#nombreCliente").attr('disabled','disabled');
              $("#buttonCargarPedido").attr('disabled','disabled');
              $("#id_pedido").val(pedido.id);
              $("#formulario_generar_pedidos").show();
        	}
        });
}

//funcion que busca los productos por filtrado
function buscarProducto(){   

   $("#nombreProducto").keyup(function(event) {

   	$("#totalPedido").val('');  //por cada busqueda reseteamos el total
   	$("#cantidadPedido").val('');  //por cada busqueda reseteamos el total
   	
   	var producto=$("#nombreProducto").val();

  	$.ajax({
  		url: '../ajax/pedidos.php?op=buscarProducto',
  		type: 'GET',
  		dataType: 'html',
  		data: {producto:producto},
  		error:function(){
        console.log("Error");
  		},
  		success:function(data){
         $("#comboProductos").show();
         $("#comboProductos").html('');   
         $("#comboProductos").css('color', 'black');
         $("#comboProductos").append(data);
  		}
  	});
  	
  });
}

//permite seleccionar el item elejido y lo rellena en los campos
function elijeItemProducto(id,nombre,categoria,precio){

    $("#idProducto").val(id);
    $("#nombreProducto").val(nombre);    
    $("#categoriaProducto").val(categoria);

    localStorage.setItem("precio", precio);

    $("#comboProductos").hide();

}

//funcion q se activa al soltar la tecla -> (esto calcula el total a pagar)
function llenadoCantidadProducto(){

   $("#cantidadPedido").keyup(function() {

   	   var cantidad=parseInt($("#cantidadPedido").val()); 

   	   if(cantidad>0){

           var precio=parseFloat(localStorage.getItem("precio"));

	   	   var total=parseFloat(precio*cantidad);

	   	   $("#totalPedido").val(total);

   	   }else{
   	   	  //alert("cantidad no permitida");
   	   }  	   	   
   });

}

//nueva opcion para agregar un nuevo producto en el mismo pedido
function agregarProducto(evt){

   evt.preventDefault();

   $.ajax({
   	url: '../ajax/pedidos.php?op=nuevoProducto',
   	type: 'GET',
   	dataType: 'html',
   	data: {},
   	error:function(){
      console.log("Error");
   	},
   	success:function(data){

   	   localStorage.setItem("nuevoProducto", data);
       $("#nuevoProducto").append(data);

       $("#quitarUltimoPedido").show();
   	}
   });
}

function quitarProducto(evt){

    evt.preventDefault();
    $("#nuevoProducto").remove(localStorage.getItem("nuevoProducto"));

}

//inhabilita los campos para proceder a generar el pedido_detalle
function aplicarPedidoDetalle(evt){
    
      evt.preventDefault();

      var conf=confirm("Desea guardar los productos seleccionados?");

      if(conf){
           $("#nombreProducto").attr('disabled', 'disabled');
           $("#cantidadPedido").attr('disabled', 'disabled');           
      }

}

function registroPedidoDetalle(evt){

	evt.preventDefault();

	var id_pedido=$("#id_pedido").val();
	var id_producto=$("#idProducto").val();
	var cantidad=$("#cantidadPedido").val();
	var total=$("#totalPedido").val();

	$.ajax({

        	url: '../ajax/pedidos.php?op=registrarPedidoDetalle',
        	type: 'POST',
        	dataType: 'html',
        	data: {
        		cantidad:cantidad,
        		total:total,
        		id_pedido:id_pedido,
        		id_producto:id_producto
        	},
        	error:function(){
        		console.log("Error");
        	},
        	success:function(data){

        	  console.log(data);
        	  localStorage.clear();    //    AL FINAL CERRAMOS limpiamos EL LOCALSTORAGE
        	  window.location="home.php";
        	}
        });
}





