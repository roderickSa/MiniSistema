$("document").ready(function(){

	buscarNombre();
	buscarProducto();
	llenadoCantidadProducto();
	$("#formulario_generar_pedidos").hide();  //oculta formulario de productos
	$("#quitarUltimoPedido").hide();      //oculta boton para quitar un producto
});

//funcion que busca los clientes por filtrado

function buscarNombre(){

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

              agregarProducto();

              $("#agregarCampoPedido").attr('disabled', 'disabled');
              $("#generarPedido").attr('disabled', 'disabled');
        	}
        });
}

//funcion que busca los productos por filtrado
function buscarProducto(){   

   //jQuery: asociar eventos a elementos HTML creados dinámicamente 
   //(id ya establecido antes de carga del jquery)

   $("#nuevoProducto").on('keyup','.nomPro',function(event) {

   	$(".totPro").val('');  //por cada busqueda reseteamos el total
   	$(".cantPro").val('');  //por cada busqueda reseteamos el total
   	
   	var producto=$(".nomPro").val();

  	$.ajax({
  		url: '../ajax/pedidos.php?op=buscarProducto',
  		type: 'GET',
  		dataType: 'html',
  		data: {producto:producto},
  		error:function(){
        console.log("Error");
  		},
  		success:function(data){
         $(".cmbPro").show();
         $(".cmbPro").html('');   
         $(".cmbPro").css('color', 'black');
         $(".cmbPro").append(data);
  		}
  	});
  	
  });
}

//permite seleccionar el item elejido y lo rellena en los campos
function elijeItemProducto(id,nombre,categoria,precio){

    $(".idPro").val(id);
    $(".nomPro").val(nombre);    
    $(".ctgPro").val(categoria);

    localStorage.setItem("precio", precio);

    $(".cmbPro").hide();

}

//funcion q se activa al soltar la tecla -> (esto calcula el total a pagar)
function llenadoCantidadProducto(){

   $("#nuevoProducto").on('keyup','.cantPro',function(event) {

   	   var cantidad=parseInt($(".cantPro").val()); 

   	   if(cantidad>0){

           var precio=parseFloat(localStorage.getItem("precio"));

	   	   var total=parseFloat(precio*cantidad);

	   	   $(".totPro").val(total);

   	   }else{
   	   	  //alert("cantidad no permitida");
   	   }  	   	   
   });

}

//nueva opcion para agregar un nuevo producto en el mismo pedido
function agregarProducto(){

	$("#agregarCampoPedido").attr('disabled', 'disabled');
	$("#generarPedido").attr('disabled', 'disabled');

   $.ajax({
   	url: '../ajax/pedidos.php?op=nuevoProducto',
   	type: 'GET',
   	dataType: 'html',
   	data: {},
   	error:function(){
      console.log("Error");
   	},
   	success:function(data){

       $("#nuevoProducto").append(data);

       if(retornaPosicionUltimoDiv()>0){
           $("#quitarUltimoPedido").show();
       }       
   	}
   });
}

//quita el ultimo producto
function quitarProducto(evt){

	var contenedor=document.getElementById("nuevoProducto");

	var divs=document.getElementsByClassName("identificadorColumna");

    var pos=retornaPosicionUltimoDiv();

    if(pos===1){
       $("#quitarUltimoPedido").hide();
       $("#agregarCampoPedido").removeAttr('disabled');
       $("#generarPedido").removeAttr('disabled');
       contenedor.removeChild(divs.item(pos));
    }else if(pos>0){       
       contenedor.removeChild(divs.item(pos));
    }
}

//inhabilita los campos para proceder a generar el pedido_detalle
function aplicarPedidoDetalle(evt){

      evt.preventDefault();

      var conf=confirm("Desea guardar los productos seleccionados?");

      if(conf){

      	var ultimo=arrayCantidades().length-1;

        //verificamos  q el ultimo input de cantidad no este vacio

      		if( arrayCantidades()[ultimo]!=null && arrayCantidades()[ultimo]>0 ){
                
                $("#agregarCampoPedido").removeAttr('disabled');
                $("#generarPedido").removeAttr('disabled');

		          var idPros=$("#nuevoProducto .idPro");
		          var nomPros=$("#nuevoProducto .nomPro");
		          var cmbPros=$("#nuevoProducto .cmbPro");
		          var ctgPros=$("#nuevoProducto .ctgPro");
		          var cantPros=$("#nuevoProducto .cantPro");
		          var totPros=$("#nuevoProducto .totPro");

		          nomPros.attr('disabled', 'disabled');
		          cantPros.attr('disabled', 'disabled');
		          
		          idPros.removeClass('idPro');
		          nomPros.removeClass('nomPro');
		          cmbPros.removeClass('cmbPro');
		          ctgPros.removeClass('ctgPro');
		          cantPros.removeClass('cantPro');
		          totPros.removeClass('totPro');

      		}else {
      			alert("Error con las cantidades");
      		}
          
          
      }

}

function registroPedidoDetalle(evt){

	evt.preventDefault();

	var id_pedido=$("#id_pedido").val();

	var InnomPro=$("input[name='producto[]']");
	var InidPro=$("input[name='idProducto[]']");
	var IncantPed=$("input[name='cantidadPedido[]']");
	var IntotPed=$("input[name='totalPedido[]']");

	var arrayNomPro=new Array();
	var arrayIdPro=new Array();
	var arrayCantPed=new Array();
	var arrayTotPed=new Array();

    InnomPro.each(function() {
    	arrayNomPro.push($(this).val());
    });
    InidPro.each(function() {
    	arrayIdPro.push($(this).val());
    });
    IncantPed.each(function() {
    	arrayCantPed.push($(this).val());
    });
    IntotPed.each(function() {
    	arrayTotPed.push($(this).val());
    });

	$.ajax({

        	url: '../ajax/pedidos.php?op=registrarPedidoDetalle',
        	type: 'POST',
        	dataType: 'html',
        	data: {
        		cantidad:arrayCantPed,
        		total:arrayTotPed,
        		id_pedido:id_pedido,
        		id_producto:arrayIdPro
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

 //funcion q retorna la posicion del ultimo div "identificadorColumna"
function retornaPosicionUltimoDiv(){
   
   var divs=document.getElementsByClassName("identificadorColumna");

   //obtenemos la posicion ultima del div para eliminarlo
    var posicionDiv=(Object.keys(divs).length)-1;  
    
    return posicionDiv;

}

//retorna un arreglo de cantidades
function arrayCantidades(){

	var ints=$("input[name='cantidadPedido[]']");

	var array=new Array();

	ints.each(function() {
		array.push($(this).val());
	});

	return array;
}





