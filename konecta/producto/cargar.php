<?php
include "../conexion.php";

if($_POST['bloque']=='crear_producto'){
	$insertar=mysqli_query($conn,"INSERT INTO producto (nombre,precio,peso,categoria,stock,fecha_creacion) VALUES ('".$_POST['nombre']."','".$_POST['precio']."','".$_POST['peso']."','".$_POST['id_categoria']."','".$_POST['stock']."','".$_POST['fecha_creacion']."') ");
	echo $insertar;
}
if($_POST['bloque']=='act_producto'){
	$actualizar=mysqli_query($conn,"UPDATE producto SET nombre='".$_POST['nombre']."' , precio='".$_POST['precio']."', peso='".$_POST['peso']."' , categoria='".$_POST['id_categoria']."' , stock='".$_POST['stock']."' , fecha_creacion='".$_POST['fecha_creacion']."'   WHERE id_producto='".$_POST['id_producto']."' ");
	echo $actualizar;
}
if($_POST['bloque']=='eli_producto'){
	$eliminar=mysqli_query($conn,"DELETE  FROM  producto  WHERE id_evaluacion='".$_POST['id_producto']."' ");
	echo $eliminar;
}
?>