$("document").ready(function(){

listarClientes();
cerrarSesionForTime();
});

function listarClientes(){

	$.ajax({
		url: '../ajax/clientes.php?op=listarClientes',
		type: 'GET',
		dataType: 'html',
		data: {},
		error:function(){
           console.log("Error");
		},
		success:function(data){
           $("#listaClientes").html(data);
		}
	});
	
}

function registrarCliente(evt){

	evt.preventDefault();

   var nombres=$("#add_nombres_cliente").val();
   var apellidos=$("#add_apellidos_cliente").val();
   var dni=$("#add_dni_cliente").val();
   var correo=$("#add_correo_cliente").val();
   var tel=$("#add_telefono_cliente").val();

   if(validacionDni(dni)=="ok" && validacionTelefono(tel)=="ok"){
       
       $.ajax({
       	url: '../ajax/clientes.php?op=registrarCliente',
       	type: 'POST',
       	dataType: 'html',
       	data: {
       		nombres: nombres,
       		apellidos:apellidos,
       		dni:dni,
       		correo:correo,
       		tel:tel
       	},error:function(){

       	},
       	success:function(data){
       		console.log(data);
       		$("#addClienteModal").modal("hide");
       		listarClientes();
       	}
       });
       
   }else{
   	   alert("Ingrese sus datos correctamente");
   }

}

function editarCliente(id){

   $.ajax({
   	url: '../ajax/clientes.php?op=editarCliente',
   	type: 'GET',
   	dataType: 'html',
   	data: {
           id:id      
   	    }
   	    ,error:function(){
          console.log("Error");
       	},
       	success:function(data){

       		var cliente=JSON.parse(data);
       		
       		$("#edit_id_cliente").val(cliente.id);
       		$("#edit_nombres_cliente").val(cliente.nombres);
       		$("#edit_apellidos_cliente").val(cliente.apellidos);
       		$("#edit_dni_cliente").val(cliente.dni);
       		$("#edit_correo_cliente").val(cliente.correo);
       		$("#edit_telefono_cliente").val(cliente.telefono);
       	}
       });
   
}

function actualizarCliente(evt){

   evt.preventDefault();

       var id= $("#edit_id_cliente").val();
       var nombres= $("#edit_nombres_cliente").val();
       var apellidos= $("#edit_apellidos_cliente").val();
       var dni= $("#edit_dni_cliente").val();
       var correo= $("#edit_correo_cliente").val();
       var telefono= $("#edit_telefono_cliente").val();

       if(validacionDni(dni)=="ok" && validacionTelefono(telefono)=="ok"){

       	  $.ajax({
       	  	url: '../ajax/clientes.php?op=actualizarCliente',
       	  	type: 'POST',
       	  	dataType: 'html',
       	  	data: {
       	  		id:id,
       	  		nombres:nombres,
       	  		apellidos:apellidos,
       	  		dni:dni,
       	  		correo:correo,
       	  		telefono:telefono
       	  	},
       	  	error:function(){
                 console.log("Error");
	       	},
	       	success:function(data){
	       		console.log(data);
	       		$("#editClienteModal").modal("hide");
	       		$("#listaClientes").html("");
	       		listarClientes();
	       	}
       });       	  

       }else{
       	alert("campos ingresados incorrectamente");
       }
}

function estadoCliente(id){

   var con=confirm("Seguro de cambiar el estado del cliente");

   if(con){

   	  $.ajax({
   	  	url: '../ajax/clientes.php?op=estadoCliente',
   	  	type: 'POST',
   	  	dataType: 'html',
   	  	data: {id:id},
   	  	error:function(){
         console.log("Error");
   	  	},
   	  	success:function(data){
         console.log(data);
	     $("#listaClientes").html("");
	     listarClientes();
   	  	}
   	  });
   	  
   }
}

function validacionDni(dni){

	  dni=parseInt(dni);
	  var salida="";

	  if(isNaN(dni)){

        salida= "caracteres no aceptados";

	  }else if(dni.toString().length<8 || dni.toString().length>8){

         salida= "dni solo debe tener 8 digitos";
      }else{
      	salida = "ok";
      }

      return salida;
}

function validacionTelefono(tel){

    tel=parseInt(tel);
    salida="";

    if(isNaN(tel)){
      salida="ingrese solo digitos";
    }else{
    	salida="ok";
    }

    return salida;
}

//funcion q cada 10 min va ir a loguot.php
function cerrarSesionForTime(){

  setTimeout(function(){

     window.location="logout.php";
     //window.open('logout.php');

  }, 600000);//10minutos

}
