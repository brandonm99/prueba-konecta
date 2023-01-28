<?php
include "../conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Categorias</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> 
</head>


<div id="contenidos" style="margin: 1rem;padding: 1rem;">

	<input type="button" value="Nuevo" onClick="abrir_modal();"><br /><br />
	
	<table id="tabla1" class="table table-striped table-bordered" style="width:100%">
	    <thead>
	        <tr>	            
	            <th>ID CATEGORIA</th>
	            <th>NOMBRE CATEGORIA</th>
	            <th>EDITAR</th>
	            <th>ELIMINAR</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$categoria=mysqli_query($conn,"SELECT * FROM categoria ");
				while($rowcategoria=mysqli_fetch_array($categoria)){				
	    	?>
		        <tr>
		            <td><?=$rowcategoria['id_categoria']?></td>
		            <td><?=$rowcategoria['des_categoria']?></td>		            
		            <td><input type="button" value="Editar" class="btn btn-warning" onClick="editar_categoria(<?=$rowcategoria['id_categoria']?>,'<?=$rowcategoria['des_categoria']?>');"/></td>
		            <td><input type="button" value="Eliminar" class="btn btn-danger" onClick="eliminar_categoria(this,<?=$rowcategoria['id_categoria']?>);"/></td>
		        </tr>
	        <?php
	    	}
	        ?>
	    </tbody>
	</table>


	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <h4 class="modal-title" id="titulo_categoriaID" >Crear categoria</h4>
	        </div>
	        <div class="modal-body">
	          	<div class="card-body">

	          		<div class="row">
					    <div class="col">
					    	<div class="form-group">
			                    <input type="text" class="form-control" id="des_categoria" placeholder="NOMBRE CATEGORIA">
			                </div>			                  
					    </div>
					</div>
                </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	          <input type="button" id="camb_boton" class="btn btn-success" value="Crear" onClick="crear_categoria();">	          
	        </div>
	      </div>
	      
	    </div>
	</div>



</div>
<div id="resp" style="visibility: hidden;"></div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/demo.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../plugins/toastr/toastr.min.js"></script>

<script>
  $(function () {
    $("#tabla1").DataTable();    
  });
  function abrir_modal(){
  	$('#myModal').modal('show');
	$('#titulo_categoriaID').html("Crear categoria" );
	$('#des_categoria').val('');
	$("#camb_boton").attr("value", "Crear");
	$("#camb_boton").attr("onClick", "crear_categoria();");
  }
  function crear_categoria(){
  	nombre=$('#des_categoria').val();
  	
  	if(nombre==''){
  		alert('POR FAVOR DILIGENCIAR EL NOMBRE DE LA CATEGORIA');
  	}else{	
  		$("#resp").load('cargar.php',{bloque:'crear_categoria',nombre:nombre},function(response,status,xhr){
	        if(response==1){
	        	 location.reload();
	        }  
    	});
  	}
  	
  }

  function editar_categoria(id,nombre){
  	$('#myModal').modal('show');
	$('#titulo_categoriaID').html("Editar categoria" );
	$('#des_categoria').val(nombre);
	$("#camb_boton").attr("value", "Actualizar");
	$("#camb_boton").attr("onClick", "actualizar_categoria("+id+");");
  }

  function actualizar_categoria(id){
  	nombre=$('#des_categoria').val();
  	
  	if(nombre=='' ){
  		alert('POR FAVOR DILIGENCIAR EL NOMBRE DE LA CATEGORIA');
  	}else{	
  		$("#resp").load('cargar.php',{bloque:'act_categoria',id_categoria:id,nombre:nombre},function(response,status,xhr){
	        if(response==1){
	        	 location.reload();
	        }  
    	});
  	}
  	
  }	

   function eliminar_categoria(esto,id){
  	$(esto).closest('tr').remove();
  	$("#resp").load('cargar.php',{bloque:'eli_categoria',id_categoria:id},function(response,status,xhr){
        if(response==1){
        	 location.reload();
        }  
	});
  }
  
</script>
</html>