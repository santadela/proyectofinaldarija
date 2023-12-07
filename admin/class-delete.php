<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['class_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../CONEXION_DB.php";
     include "data/class.php";

     $id = $_GET['class_id'];
     if (removeClass($id, $conn)) {
     	$sm = "¡Eliminado con éxito!";
        header("Location: class.php?success=$sm");
        exit;
     }else {
        $em = "Ha ocurrido un error";
        header("Location: class.php?error=$em");
        exit;
     }


  }else {
    header("Location: class.php");
    exit;
  } 
}else {
	header("Location: class.php");
	exit;
} 