<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['grade_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../CONEXION_DB.php";
     include "data/grade.php";

     $id = $_GET['grade_id'];
     if (removeGrade($id, $conn)) {
     	$sm = "¡Eliminado con éxito!";
        header("Location: grade.php?success=$sm");
        exit;
     }else {
        $em = "Ha ocurrido un error";
        header("Location: grade.php?error=$em");
        exit;
     }


  }else {
    header("Location: grade.php");
    exit;
  } 
}else {
	header("Location: grade.php");
	exit;
} 