$("document").ready(function(){

listarCategorias();
});

function listarCategorias(){

	$.ajax({
		url: '../ajax/categoriasP.php?op=listadoCategorias',
		type: 'GET',
		dataType: 'html',
		data: {},
		error:function(){
         console.log("error al listar");
		},
		success:function(data){
         
         $("#listaCategoriasP").append(data);
		}
	});
	
}

function registrarCategoriaP(evt){

   evt.preventDefault();

   var nombre=$("#add_nombre_categoriap").val();

   if(nombre.length>0){
      $.ajax({
      	url: '../ajax/categoriasP.php?op=insertarCategoria',
      	type: 'POST',
      	dataType: 'html',
      	data: {nombre: nombre},
      	error:function(){
      		console.log("Error");
      	},
      	success:function(data){

      		$("#listaCategoriasP").html("");
      		listarCategorias();
      		$("#addCategoriaPModal").modal("hide");
      	}
      });
      
   }else{
   	alert("Campo vacio");
   	$("#addCategoriaPModal").modal("hide");
   }
}

function editarCategoriaP(id){

	$.ajax({
		url: '../ajax/categoriasP.php?op=editarCategoria',
		type: 'GET',
		dataType: 'html',
		data: {id: id},
		error:function(){
      		console.log("Error");
      	},
      	success:function(data){

         var categoria=JSON.parse(data);

         $("#edit_id_categoriap").val(categoria.id);
         $("#edit_nombre_categoriap").val(categoria.nombre);
      		
      	}
	});

}

function actualizarCategoriaP(evt){

   evt.preventDefault();

   var id=$("#edit_id_categoriap").val();
   var nombre=$("#edit_nombre_categoriap").val();

   if(nombre.length>0){
      $.ajax({
      	url: '../ajax/categoriasP.php?op=actualizarCategoria',
      	type: 'POST',
      	dataType: 'html',
      	data: {id:id,nombre: nombre},
      	error:function(){
      		console.log("Error");
      	},
      	success:function(data){

      		$("#listaCategoriasP").html("");
      		listarCategorias();
      		$("#editCategoriaPModal").modal("hide");
      	}
      });
      
   }else{
   	alert("Campo vacio");
   	$("#editCategoriaPModal").modal("hide");
   }
   
}

function eliminarCategoriaP(id){

	var conf=confirm("Seguro de eliminar categoria??");

	if(conf){

		$.ajax({
      	url: '../ajax/categoriasP.php?op=eliminarCategoria',
      	type: 'POST',
      	dataType: 'html',
      	data: {id:id},
      	error:function(){
      		console.log("Error");
      	},
      	success:function(data){

      		$("#listaCategoriasP").html("");
      		listarCategorias();
      	}
      });

	}

}
