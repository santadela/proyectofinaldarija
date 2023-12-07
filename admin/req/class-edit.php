<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['section']) &&
    isset($_POST['grade']) &&
    isset($_POST['class_id'])) {
    
    include '../../CONEXION_DB.php';

    $section = $_POST['section'];
    $grade = $_POST['grade'];
    $class_id = $_POST['class_id'];

    $data = 'class_id='.$class_id;

    if (empty($class_id)) {
        $em  = "El ID de la clase es obligatorio";
        header("Location: ../class-edit.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "Grado obligatorio";
        header("Location: ../class-edit.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em  = "Sección obligatoria";
        header("Location: ../class-edit.php?error=$em&$data");
        exit;
    }else {
        // Verificar que la clase ya existe
        $sql_check = "SELECT * FROM class 
                      WHERE grade=? AND section=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $section]);
        if ($stmt_check->rowCount() > 0) {
           $em  = "La clase ya existe";
           header("Location: ../class-edit.php?error=$em&$data");
           exit;
        }else {

            $sql  = "UPDATE class SET grade=?, section=?
                     WHERE class_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$grade, $section, $class_id]);
            $sm = "¡Clase actualizada con éxito!";
            header("Location: ../class-edit.php?success=$sm&$data");
            exit;
       }
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../class.php?error=$em");
    exit;
  }

  }else {
    header("Location: ../../logout.php");
    exit;
  } 
}else {
	header("Location: ../../logout.php");
	exit;
} 
