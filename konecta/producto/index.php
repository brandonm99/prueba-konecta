<?php
include "../conexion.php";
$nombre_categoria=array();
$categorias=mysqli_query($conn,"SELECT * FROM categoria ");
while($rowcategorias=mysqli_fetch_array($categorias)){
	$nombre_categoria[$rowcategorias['id_categoria']]=$rowcategorias['des_categoria'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Productos</title>
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
				<th>ID PRODUCTO</th>
	            <th>NOMBRE</th>
	            <th>PRECIO</th>
	            <th>PESO</th>
	            <th>CATEGORIA</th>
	            <th>STOCK</th>
	            <th>FECHA DE CREACION</th>
	            <th>EDITAR</th>
	            <th>ELIMINAR</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$productos=mysqli_query($conn,"SELECT * FROM producto ");
	    	foreach ($productos as $rowsproductos) {			
	    	?>
		        <tr>
					<td><?=$rowsproductos['id_producto']?></td>
		            <td><?=$rowsproductos['nombre']?></td>
		            <th><?=$rowsproductos['precio']?></th>
		            <th><?=$rowsproductos['peso']?></th>
		            <th><?=$nombre_categoria[$rowsproductos['categoria']]?></th>
		            <th><?=$rowsproductos['stock']?></th>
		            <th><?=$rowsproductos['fecha_creacion']?></th>
		            <td><input type="button" value="Editar" class="btn btn-warning" onClick="editar_producto(<?=$rowsproductos['id_producto']?>,'<?=$rowsproductos['nombre']?>','<?=$rowsproductos['precio']?>','<?=$rowsproductos['peso']?>','<?=$rowsproductos['categoria']?>','<?=$rowsproductos['stock']?>','<?=$rowsproductos['fecha_creacion']?>');"/></td>
		            <td><input type="button" value="Eliminar" class="btn btn-danger" onClick="eliminar_producto(this,<?=$rowsproductos['id_producto']?>);"/></td>
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
				<h4 class="modal-title" id="titulo_categoriaID">Crear Producto</h4>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<div class="form-group">
									<input type="text" class="form-control" id="nombre" placeholder="NOMBRE">
								</div>
								<div class="form-group">
									<input type="number" class="form-control" id="precio" placeholder="PRECIO">
								</div>
								<div class="form-group">
									<input type="number" class="form-control" id="peso" placeholder="PESO">
								</div>
								<div class="form-group">
									<select class="form-control" id="id_categoria" placeholder="CATEGORIA"> 
										<option value=""> --Seleccione Producto-- </option>
										<?php
										foreach ($categorias as $rowcategorias) {
										?>
											<option value="<?=$rowcategorias['id_categoria']?>"><?=$rowcategorias['des_categoria']?></option>
										<?php	
										}
										?>
								</select>
								</div>    
								<div class="form-group">
									<input type="number" class="form-control" id="stock" placeholder="STOCK">
								</div>            
								<div class="form-group">
									<input type="date" class="form-control" id="fecha_creacion" placeholder="FECHA CREACION">
								</div>		                			                  
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<input type="button" id="camb_boton" class="btn btn-success" value="Crear" onClick="crear_producto();">	          
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
	$('#titulo_categoriaID').html("Crear Producto" );
	$('#nombre').val('');
	$('#precio').val('');
	$('#peso').val('');
	$('#id_categoria').val('');
	$('#stock').val('');
	$('#fecha_creacion').val('');
	$("#camb_boton").attr("value", "Crear");
	$("#camb_boton").attr("onClick", "crear_producto();");
  }

  function editar_producto(id,nombre,precio,peso,id_categoria,stock,fecha_creacion){
  	$('#myModal').modal('show');
	$('#nombre').val(nombre);
	$('#precio').val(precio);
	$('#peso').val(peso);
	$('#id_categoria').val(id_categoria);
	$('#stock').val(stock);
	$('#fecha_creacion').val(fecha_creacion);
	$('#fecha_creacion').hide();
	$("#camb_boton").attr("value", "Actualizar");
	$("#camb_boton").attr("onClick", "actualizar_producto("+id+");");
  }

  

  function actualizar_producto(id_producto){
	nombre = $('#nombre').val();
	precio = $('#precio').val();
	peso = $('#peso').val();
	id_categoria = $('#id_categoria').val();
	stock = $('#stock').val();
	fecha_creacion = $('#fecha_creacion').val(); 	
  	
  	if(nombre=='' ||  precio=='' || peso==''|| id_categoria=='' || stock=='' || fecha_creacion==''){
  		alert('FALTAN DATOS POR DILIGENCIAR');
  	}else{	
  		$("#resp").load('cargar.php',{bloque:'act_producto',id_producto:id_producto,nombre:nombre,precio:precio,peso:peso,id_categoria:id_categoria,stock:stock,fecha_creacion:fecha_creacion},function(response,status,xhr){
	        if(response==1){
	        	 location.reload();
	        }  
    	});
  	}
  	
  }	

  function eliminar_producto(esto,id){
  	$(esto).closest('tr').remove();
  	$("#resp").load('cargar.php',{bloque:'eli_producto',id_producto:id},function(response,status,xhr){
        if(response==1){
        	 location.reload();
        }  
	});
  }

  function crear_producto(){
	nombre = $('#nombre').val();
	precio = $('#precio').val();
	peso = $('#peso').val();
	id_categoria = $('#id_categoria').val();
	stock = $('#stock').val();
	fecha_creacion = $('#fecha_creacion').val();
  	
  	if(nombre=='' ||  precio=='' || peso==''|| id_categoria=='' || stock=='' || fecha_creacion==''){
  		alert('FALTAN DATOS POR DILIGENCIAR');
  	}else{	
  		$("#resp").load('cargar.php',{bloque:'crear_producto',nombre:nombre,precio:precio,peso:peso,id_categoria:id_categoria,stock:stock,fecha_creacion:fecha_creacion},function(response,status,xhr){
	        if(response==1){
	        	 location.reload();
	        }  
    	});
  	}
  	
  }
  
</script>
</html>