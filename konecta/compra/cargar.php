<?php
include "../conexion.php";	



if($_POST['bloque']=='crear_compra'){

	$validar_stock=mysqli_query($conn,"SELECT * FROM producto WHERE stock > 0 AND id_producto = '".$_POST['id_producto']."' ");
	if(mysqli_num_rows($validar_stock) > 0){
		$validar=mysqli_fetch_array($validar_stock);
		
		if(($validar['stock'] - $_POST['cantidad']) >=0 ){
			$actualizar_stock=mysqli_query($conn,"UPDATE producto SET stock='".($validar['stock'] - $_POST['cantidad'])."' WHERE id_producto='".$_POST['id_producto']."' ");
			$insertar=mysqli_query($conn,"INSERT INTO compra (id_producto,cantidad) VALUES ('".$_POST['id_producto']."','".$_POST['cantidad']."') ");
		}else{
			$insertar=2;	
		}
	}else{
		$insertar=0;
	}	

	
	echo $insertar;
}


if($_POST['bloque']=='act_compra'){
	$actualizar=mysqli_query($conn,"UPDATE compra SET id_producto='".$_POST['id_producto']."' ,cantidad='".$_POST['cantidad']."' WHERE id_compra='".$_POST['id_compra']."' ");
	echo $actualizar;
}
if($_POST['bloque']=='eli_compra'){
	$eliminar=mysqli_query($conn,"DELETE  FROM  compra  WHERE id_compra='".$_POST['id_compra']."' ");
	echo $eliminar;
}
?>