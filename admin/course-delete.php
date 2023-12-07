<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['course_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../CONEXION_DB.php";
     include "data/course.php";

     $id = $_GET['course_id'];
     if (removeCourse($id, $conn)) {
     	$sm = "¡Eliminado con éxito!";
        header("Location: course.php?success=$sm");
        exit;
     }else {
        $em = "Ha ocurrido un error";
        header("Location: course.php?error=$em");
        exit;
     }


  }else {
    header("Location: course.php");
    exit;
  } 
}else {
	header("Location: course.php");
	exit;
} 