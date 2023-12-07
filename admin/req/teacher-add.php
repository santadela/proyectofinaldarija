<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

        if (isset($_POST['fname']) &&
        isset($_POST['lname']) &&
        isset($_POST['username']) &&
        isset($_POST['pass'])     &&
        isset($_POST['address'])  &&
        isset($_POST['employee_number']) &&
        isset($_POST['phone_number'])  &&
        isset($_POST['qualification']) &&
        isset($_POST['email_address']) &&
        isset($_POST['classes'])        &&
        isset($_POST['date_of_birth']) &&
        isset($_POST['subjects'])) {
    
    include '../../CONEXION_DB.php';
    include "../data/teacher.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    $address = $_POST['address'];
    $employee_number = $_POST['employee_number'];
    $phone_number = $_POST['phone_number'];
    $qualification = $_POST['qualification'];
    $email_address = $_POST['email_address'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];

    $classes = "";
    foreach ($_POST['classes'] as $class) {
    	$classes .=$class;
    }

    $subjects = "";
    foreach ($_POST['subjects'] as $subject) {
    	$subjects .=$subject;
    }

    $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname.'&address='.$address.'&en='.$employee_number.'&pn='.$phone_number.'&qf='.$qualification.'&email='.$email_address;

    if (empty($fname)) {
		$em  = "El nombre es obligatorio";
		header("Location: ../teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "El apellido es obligatorio";
		header("Location: ../teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "El usuario es obligatorio";
		header("Location: ../teacher-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Usuario ya existente! Utiliza otro";
		header("Location: ../teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em  = "Contraseña obligatoria";
		header("Location: ../teacher-add.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
        $em  = "Dirección obligatoria";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else if (empty($employee_number)) {
        $em  = "Número de empleado obligatorio";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else if (empty($phone_number)) {
        $em  = "Número de teléfono obligatorio";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else if (empty($qualification)) {
        $em  = "Calificación obligatoria";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Dirección de email obligatoria";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Género obligatorio";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Fecha de nacimiento obligatoria";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else if (empty($pass)) {
        $em  = "Contraseña obligatoria";
        header("Location: ../teacher-add.php?error=$em&$data");
        exit;
    }else {
        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql  = "INSERT INTO
        teachers(username, password, class, fname, lname, subjects, address, employee_number, date_of_birth, phone_number, qualification, gender, email_address)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $classes, $fname, $lname, $subjects, $address, $employee_number, $date_of_birth, $phone_number, $qualification, $gender, $email_address]);
        $sm = "¡Nuevo profesor actualizado con éxito!";
        header("Location: ../teacher-add.php?success=$sm");
exit;
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../teacher-add.php?error=$em");
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
