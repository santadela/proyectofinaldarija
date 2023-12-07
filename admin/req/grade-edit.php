<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['grade_code']) &&
    isset($_POST['grade']) &&
    isset($_POST['grade_id'])) {
    
    include '../../CONEXION_DB.php';

    $grade_code = $_POST['grade_code'];
    $grade = $_POST['grade'];
    $grade_id = $_POST['grade_id'];
   
    $data = 'grade_code='.$grade_code.'&grade='.$grade.'&grade_id='.$grade_id;

    if (empty($grade_code)) {
        $em  = "Código del grado obligatorio";
        header("Location: ../grade-edit.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "El grado es obligatorio";
        header("Location: ../grade-edit.php?error=$em&$data");
        exit;
    }else {

        $sql  = "UPDATE grades SET grade=?, grade_code=?
                 WHERE grade_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$grade, $grade_code, $grade_id]);
        $sm = "¡Grado actualizado con éxito!";
        header("Location: ../grade-edit.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../grade.php?error=$em");
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
