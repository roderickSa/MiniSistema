$("document").ready(function(){

	buscarNombre();
});

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

function elijeItem(id,nombres,apellidos,dni,correo){

    $("#id_cliente").val(id);
    $("#nombreCliente").val(nombres+" "+apellidos);
    $("#comboNombres").hide();
    $("#dniCliente").val(dni);
    $("#correoCliente").val(correo);
}