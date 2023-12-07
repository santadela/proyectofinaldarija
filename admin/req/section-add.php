<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['section'])) {
    
    include '../../CONEXION_DB.php';

    $section = $_POST['section'];
    
  if (empty($section)) {
		$em  = "Sección obligatoria";
		header("Location: ../section-add.php?error=$em");
		exit;
	}else {
        $sql  = "INSERT INTO
                 section (section)
                 VALUES(?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$section]);
        $sm = "¡Nueva sección creada con éxito!";
        header("Location: ../section-add.php?success=$sm");
        exit;
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../section-add.php?error=$em");
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
