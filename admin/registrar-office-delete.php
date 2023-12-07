<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['r_user_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../CONEXION_DB.php";
     include "data/registrar_office.php";

     $id = $_GET['r_user_id'];
     if (removeRUser($id, $conn)) {
     	$sm = "¡Eliminado con éxito!";
        header("Location: registrar-office.php?success=$sm");
        exit;
     }else {
        $em = "Ha ocurrido un error";
        header("Location: registrar-office.php?error=$em");
        exit;
     }


  }else {
    header("Location: registrar-office.php");
    exit;
  } 
}else {
	header("Location: registrar-office.php");
	exit;
} 