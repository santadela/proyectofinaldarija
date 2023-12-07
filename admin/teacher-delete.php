<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['teacher_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../CONEXION_DB.php";
     include "data/teacher.php"; 

     $id = $_GET['teacher_id'];
     if (removeTeacher($id, $conn)) {
     	$sm = "¡Profesor eliminado!";
        header("Location: teacher.php?success=$sm");
        exit;
     }else {
        $em = "Ha ocurrido un error";
        header("Location: teacher.php?error=$em");
        exit;
     }


  }else {
    header("Location: teacher.php");
    exit;
  } 
}else {
	header("Location: teacher.php");
	exit;
} 