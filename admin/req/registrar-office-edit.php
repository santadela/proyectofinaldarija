<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      &&
    isset($_POST['username'])   &&
    isset($_POST['r_user_id']) &&
    isset($_POST['address'])  &&
    isset($_POST['employee_number']) &&
    isset($_POST['phone_number'])  &&
    isset($_POST['qualification']) &&
    isset($_POST['email_address']) &&
    isset($_POST['gender'])        &&
    isset($_POST['date_of_birth'])) {
    
    include '../../CONEXION_DB.php';
    include "../data/registrar_office.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];

    $address = $_POST['address'];
    $employee_number = $_POST['employee_number'];
    $phone_number = $_POST['phone_number'];
    $qualification = $_POST['qualification'];
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];

    $r_user_id = $_POST['r_user_id'];
    

    $data = 'r_user_id='.$r_user_id;

    if (empty($fname)) {
		$em  = "Nombre obligatorio";
		header("Location: ../registrar-office-edit.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Apellido obligatorio";
		header("Location: ../registrar-office-edit.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Usuario obligatorio";
		header("Location: ../registrar-office-edit.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn, $r_user_id)) {
		$em  = "¡Usuario existente! Utiliza otro";
		header("Location: ../registrar-office-edit.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
        $em  = "Dirección obligatoria";
        header("Location: ../registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($employee_number)) {
        $em  = "Número de empleado obligatorio";
        header("Location: ../registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em  = "Número de teléfono obligatorio";
        header("Location: ../registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($qualification)) {
        $em  = "Calificación obligatoria";
        header("Location: ../registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Dirección de email obligatorio";
        header("Location: ../registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Género obligatorio";
        header("Location: ../registrar-office-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Fecha de nacimiento es obligatoria";
        header("Location: ../registrar-office-edit.php?error=$em&$data");
        exit;
    }else {
        $sql = "UPDATE registrar_office SET
                username = ?, fname=?, lname=?,
                address = ?, employee_number=?, date_of_birth = ?, phone_number = ?, qualification = ?,gender=?, email_address = ?
                WHERE r_user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $fname, $lname, $address, $employee_number, $date_of_birth, $phone_number, $qualification, $gender, $email_address, $r_user_id]);
        $sm = "¡Actualizado con éxito!";
        header("Location: ../registrar-office-edit.php?success=$sm&$data");
        exit;
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../registrar-office.php?error=$em");
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
