<?php
include "../conexion.php";

if($_POST['bloque']=='crear_categoria'){
	$insertar=mysqli_query($conn,"INSERT INTO categoria (des_categoria) VALUES ('".$_POST['nombre']."')");
	echo $insertar;
}
if($_POST['bloque']=='act_categoria'){
	$actualizar=mysqli_query($conn,"UPDATE categoria SET des_categoria='".$_POST['nombre']."' WHERE id_categoria='".$_POST['id_categoria']."' ");
	echo $actualizar;
}
if($_POST['bloque']=='eli_categoria'){
	$eliminar=mysqli_query($conn,"DELETE  FROM  categoria  WHERE id_categoria='".$_POST['id_categoria']."' ");
	echo $eliminar;
}
?>