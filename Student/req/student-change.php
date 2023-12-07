<?php 
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
    	

if (isset($_POST['old_pass']) &&
    isset($_POST['new_pass'])   &&
    isset($_POST['c_new_pass']) ) {
    
    include '../../CONEXION_DB.php';
    include "../data/student.php";

    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $student_id = $_SESSION['student_id'];
    
    if (empty($old_pass)) {
		$em  = "La contraseña antigua es obligatoria";
		header("Location: ../pass.php?perror=$em");
		exit;
	}else if (empty($new_pass)) {
		$em  = "Nueva contraseña obligatoria";
		header("Location: ../pass.php?perror=$em");
		exit;
	}else if (empty($c_new_pass)) {
		$em  = "La contraseña confirmada es obligatoria";
		header("Location: ../pass.php?perror=$em");
		exit;
	}else if ($new_pass !== $c_new_pass) {
        $em  = "La nueva contraseña y la contraseña confirmada no coinciden";
        header("Location: ../pass.php?perror=$em");
        exit;
    }else if (!studentPasswordVerify($old_pass, $conn, $student_id)) {
        $em  = "Antigua contraseña incorrecta";
        header("Location: ../pass.php?perror=$em");
        exit;
    }else {
        // hashing the password
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE students SET
                password = ?
                WHERE student_id=?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_pass, $student_id]);
        $sm = "¡La contraseña ha sido cambiada con éxito!!";
        header("Location: ../pass.php?psuccess=$sm");
        exit;
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../pass.php?error=$em");
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
