<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['course_name']) &&
    isset($_POST['course_code']) && 
    isset($_POST['grade'])) {
    
    include '../../CONEXION_DB.php';

    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $grade = $_POST['grade'];

  if (empty($course_name)) {
		$em  = "Nombre del curso obligatorio";
		header("Location: ../course-add.php?error=$em");
		exit;
	}else if(empty($course_code)) {
    $em  = "Código del curso obligatorio";
    header("Location: ../course-add.php?error=$em");
    exit;
  }else if (empty($grade)) {
		$em  = "Grado obligatorio";
		header("Location: ../course-add.php?error=$em");
		exit;
	}else {
    // VERIFICAR SI LA CLASE YA EXISTE
    $sql_check = "SELECT * FROM subjects 
                  WHERE grade=? AND subject_code=?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->execute([$grade, $course_code]);
    if ($stmt_check->rowCount() > 0) {
       $em  = "El curso ya existe";
       header("Location: ../course-add.php?error=$em");
       exit;
    }else {
      $sql  = "INSERT INTO
             subjects(grade, subject, subject_code)
             VALUES(?,?,?)";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$grade, $course_name, $course_code]);
      $sm = "¡Nuevo curso creado con éxito!";
      header("Location: ../course-add.php?success=$sm");
      exit;
    } 
}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../course-add.php?error=$em");
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
