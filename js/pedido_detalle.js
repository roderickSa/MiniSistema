$("document").ready(function(){

MuestraPaginacionPedidos();
paginacionPedidosOnLoad();
});
/*
function listarPedidoDetalle(){

  $.ajax({
  	url: '../ajax/Pedido_Detalle.php?op=listaPedidoDetalle',
  	type: 'GET',
  	dataType: 'html',
  	data: {},
  	error:function(){
    console.log("Error");
  	},
  	success:function(data){
     $("#listaPedidoDetalle").html(data);
  	}
  });

}*/

  /*function MuestraPaginacionPedidoDetalle(){

    $.ajax({
  	url: '../ajax/Pedido_Detalle.php?op=muestraPaginacionPedidoDetalle',
  	type: 'GET',
  	dataType: 'html',
  	data: {},
  	error:function(){
    console.log("Error");
  	},
  	success:function(data){
     $("#paginacionPedidoDetalle").html(data);
  	}
  });
  
}*/

function MuestraPaginacionPedidos(){

    $.ajax({
  	url: '../ajax/Pedido_Detalle.php?op=muestraPaginacionPedidos',
  	type: 'GET',
  	dataType: 'html',
  	data: {},
  	error:function(){
    console.log("Error");
  	},
  	success:function(data){
     $("#paginacionPedidoDetalle").html(data);
  	}
  });
  
}

/*function paginacion(pagina){

		$.ajax({
	  	url: '../ajax/Pedido_Detalle.php?op=paginacionPedidoDetalle',
	  	type: 'GET',
	  	dataType: 'html',
	  	data: {pagina:pagina},
	  	error:function(){
	    console.log("Error");
	  	},
	  	success:function(data){
	     $("#listaPedidoDetalle").html(data);
	     console.log(data);
	  	}
	    });

}*/

function paginacionPedidos(pagina){

		$.ajax({
	  	url: '../ajax/Pedido_Detalle.php?op=paginacionPedidos',
	  	type: 'GET',
	  	dataType: 'html',
	  	data: {pagina:pagina},
	  	error:function(){
	    console.log("Error");
	  	},
	  	success:function(data){
	     $("#listaPedidoDetalle").html(data);
	  	}
	    });

}

/*function paginacionOnLoad(){

		$.ajax({
	  	url: '../ajax/Pedido_Detalle.php?op=paginacionPedidoDetalle',
	  	type: 'GET',
	  	dataType: 'html',
	  	data: {pagina:1},
	  	error:function(){
	    console.log("Error");
	  	},
	  	success:function(data){
	     $("#listaPedidoDetalle").html(data);
	  	}
	    });

}*/

function paginacionPedidosOnLoad(){

		$.ajax({
	  	url: '../ajax/Pedido_Detalle.php?op=paginacionPedidos',
	  	type: 'GET',
	  	dataType: 'html',
	  	data: {pagina:1},
	  	error:function(){
	    console.log("Error");
	  	},
	  	success:function(data){
	     $("#listaPedidoDetalle").html(data);
	  	}
	    });

}

function verDetallePedido(id_pedido){

	$("#contenedorPedidoDetalle").html("");

	$.ajax({
	  	url: '../ajax/Pedido_Detalle.php?op=getProductosFromIdPedido',
	  	type: 'GET',
	  	dataType: 'html',
	  	data: {id_pedido:id_pedido},
	  	error:function(){
	    console.log("Error");
	  	},
	  	success:function(data){
	     $("#contenedorPedidoDetalle").append(data);
	  	}
	    });

	$.ajax({
	  	url: '../ajax/Pedido_Detalle.php?op=getTotalProductosFromIdPedido',
	  	type: 'GET',
	  	dataType: 'html',
	  	data: {id_pedido:id_pedido},
	  	error:function(){
	    console.log("Error");
	  	},
	  	success:function(data){

	     $("#totalPedidoDetalle").html(data);
	  	}
	    });

	$("#detallePedidoModal").modal('show');

}