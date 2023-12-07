<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['section_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../CONEXION_DB.php";
     include "data/section.php";

     $id = $_GET['section_id'];
     if (removeSection($id, $conn)) {
     	$sm = "¡Eliminado con éxito!";
        header("Location: section.php?success=$sm");
        exit;
     }else {
        $em = "Ha ocurrido un error";
        header("Location: section.php?error=$em");
        exit;
     }


  }else {
    header("Location: section.php");
    exit;
  } 
}else {
	header("Location: section.php");
	exit;
} 