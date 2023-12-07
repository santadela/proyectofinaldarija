<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['student_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../CONEXION_DB.php";
     include "data/student.php";

     $id = $_GET['student_id'];
     if (removeStudent($id, $conn)) {
     	$sm = "¡Eliminado con éxito!";
        header("Location: student.php?success=$sm");
        exit;
     }else {
        $em = "Ha ocurrido un error";
        header("Location: student.php?error=$em");
        exit;
     }


  }else {
    header("Location: student.php");
    exit;
  } 
}else {
	header("Location: teacher.php");
	exit;
} 