<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['admin_pass']) &&
    isset($_POST['new_pass'])   &&
    isset($_POST['c_new_pass']) &&
    isset($_POST['student_id'])) {
    
    include '../../CONEXION_DB.php';
    include "../data/admin.php";

    $admin_pass = $_POST['admin_pass'];
    $new_pass = $_POST['new_pass'];
    $c_new_pass = $_POST['c_new_pass'];

    $student_id = $_POST['student_id'];
    $id = $_SESSION['admin_id'];
    
    $data = 'student_id='.$student_id.'#change_password';

    if (empty($admin_pass)) {
		$em  = "La contraseña del admin es obligatoria";
		header("Location: ../student-edit.php?perror=$em&$data");
		exit;
	}else if (empty($new_pass)) {
		$em  = "Una nueva contraseña es obligatoria";
		header("Location: ../student-edit.php?perror=$em&$data");
		exit;
	}else if (empty($c_new_pass)) {
		$em  = "La confirmación de la contraseña es obligatoria";
		header("Location: ../student-edit.php?perror=$em&$data");
		exit;
	}else if ($new_pass !== $c_new_pass) {
        $em  = "La nueva contraseña y la contraseña confirmada no coinciden";
        header("Location: ../student-edit.php?perror=$em&$data");
        exit;
    }else if (!adminPasswordVerify($admin_pass, $conn, $id)) {
        $em  = "Contraseña del administrador incorrecta";
        header("Location: ../student-edit.php?perror=$em&$data");
        exit;
    }else {
        // hashing the password
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE students SET
                password = ?
                WHERE student_id=?";

        $stmt = $conn->prepare($sql);
        $stmt->execute([$new_pass, $student_id]);
        $sm = "¡La contraseña ha sido cambiada con éxito!";
        header("Location: ../student-edit.php?psuccess=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../student-edit.php?error=$em&$data");
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
