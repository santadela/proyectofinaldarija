<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['grade']) &&
    isset($_POST['section'])) {
    
    include '../../CONEXION_DB.php';

    $section = $_POST['section'];
    $grade = $_POST['grade'];

  if (empty($section)) {
		$em  = "Sección obligatoria";
		header("Location: ../class-add.php?error=$em");
		exit;
	}else if (empty($grade)) {
		$em  = "Grado obligatorio";
		header("Location: ../class-add.php?error=$em");
		exit;
	}else {
        // Verificar que la clase ya existe
        $sql_check = "SELECT * FROM class 
                      WHERE grade=? AND section=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $section]);
        if ($stmt_check->rowCount() > 0) {
           $em  = "Esa clase ya existe";
           header("Location: ../class-add.php?error=$em");
           exit;
        }else {
          $sql  = "INSERT INTO
                 class(grade, section)
                 VALUES(?,?)";
          $stmt = $conn->prepare($sql);
          $stmt->execute([$grade, $section]);
          $sm = "¡Nueva clase creada con éxito!";
          header("Location: ../class-add.php?success=$sm");
          exit;
        } 
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../class-add.php?error=$em");
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
