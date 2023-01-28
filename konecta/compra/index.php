<?php
include "../conexion.php";
$nombre_producto=array();
$productos=mysqli_query($conn,"SELECT * FROM producto ");
while($rowproductos=mysqli_fetch_array($productos)){
	$nombre_producto[$rowproductos['id_producto']]=$rowproductos['nombre'];
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Prueba OET</title>
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
				<th>ID COMPRA</th>
	            <th>PRODUCTO</th>
	            <th>CANTIDAD</th>
	            <!--<th>EDITAR</th>
	            <th>ELIMINAR</th>-->
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    	$compras=mysqli_query($conn,"SELECT * FROM compra ");
	    	foreach ($compras as $rowscompras) {			
	    	?>
		        <tr>
					<th><?=$rowscompras['id_compra']?></th>
		            <th><?=$nombre_producto[$rowscompras['id_producto']]?></th>
		            <th><?=$rowscompras['cantidad']?></th>
		            <!--<td><input type="button" value="Editar" class="btn btn-warning" onClick="editar_compra(<?=$rowscompras['id_compra']?>,'<?=$rowscompras['id_producto']?>','<?=$rowscompras['cantidad']?>');"/></td>
		            <td><input type="button" value="Eliminar" class="btn btn-danger" onClick="eliminar_compra(this,<?=$rowscompras['id_compra']?>);"/></td>-->
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
				<h4 class="modal-title" id="titulo_categoriaID">Registrar Compra</h4>
				</div>
				<div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col">								
								<div class="form-group">
									<select class="form-control" id="id_producto" placeholder="PRODUCTO"> 
										<option value=""> --Seleccione Producto-- </option>
										<?php
										foreach ($productos as $rowproductos) {
										?>
											<option value="<?=$rowproductos['id_producto']?>"><?=$rowproductos['nombre']?></option>
										<?php	
										}
										?>
								</select>
								</div>   
								<div class="form-group">
									<input type="text" class="form-control" id="cantidad" placeholder="CANTIDAD">
								</div>	                			                  
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<input type="button" id="camb_boton" class="btn btn-success" value="Crear" onClick="crear_compra();">	          
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
	$('#titulo_categoriaID').html("Crear Compra" );
	$('#id_producto').val('');
	$('#cantidad').val('');
	$("#camb_boton").attr("value", "Crear");
	$("#camb_boton").attr("onClick", "crear_compra();");
  }

  function editar_compra(id_compra,id_producto,cantidad){
  	$('#myModal').modal('show');
  	$('#id_producto').val(id_producto);
	$('#cantidad').val(cantidad);
  	document.getElementById('camb_boton').setAttribute("value", "Actualizar");
  	document.getElementById('camb_boton').setAttribute("onClick", "actualizar_compra("+id+");");
  }

  

  function actualizar_compra(id_compra){	
	id_producto= $('#id_producto').val();
	cantidad = $('#cantidad').val();	
  	
  	if(id_producto=='' ||  cantidad=='' ){
  		alert('falta diligenciar algun dato');
  	}else{	
  		$("#resp").load('cargar.php',{bloque:'act_compra',id_compra:id_compra,id_producto:id_producto,cantidad:cantidad},function(response,status,xhr){
	        if(response==1){
	        	 location.reload();
	        }  
    	});
  	}
  	
  }	

  function eliminar_compra(esto,id){
  	$(esto).closest('tr').remove();
  	$("#resp").load('cargar.php',{bloque:'eli_compra',id_compra:id},function(response,status,xhr){
        if(response==1){
        	 location.reload();
        }  
		});
  }

  function crear_compra(){
	id_producto= $('#id_producto').val();
	cantidad = $('#cantidad').val();		
  	
  	if(id_producto=='' ||  cantidad=='' ){
  		alert('falta diligenciar algun dato');
  	}else{	
  		$("#resp").load('cargar.php',{bloque:'crear_compra',id_producto:id_producto,cantidad:cantidad},function(response,status,xhr){
	        if(response==1){
	        	 location.reload();
	        }else if(response==2){
				alert("LA CANTIDAD DE PRODUCTOS A COMPRAR SOBREPASA EL STOCK ACTUAL DEL PRODUCTO");
			}else{
				alert("NO QUEDA STOCK DEL PRODUCTO");
			}  
    	});
  	}
  	
  }
  
</script>
</html>