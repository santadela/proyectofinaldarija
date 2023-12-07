<?php 
session_start();
if (isset($_SESSION['r_user_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Registrar Office') {
    	

if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['pass'])     &&
    isset($_POST['address'])  &&
    isset($_POST['gender'])   &&
    isset($_POST['email_address']) &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['parent_fname'])  &&
    isset($_POST['parent_lname'])  &&
    isset($_POST['parent_phone_number']) &&
    isset($_POST['section']) &&
    isset($_POST['grade'])) {
    
    include '../../CONEXION_DB.php';
    include "../data/student.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['parent_fname'];
    $parent_lname = $_POST['parent_lname'];
    $parent_phone_number = $_POST['parent_phone_number'];

    $grade = $_POST['grade'];
    $section = $_POST['section'];
    

    $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname.'&address='.$address.'&gender='.$email_address.'&pfn='.$parent_fname.'&pln='.$parent_lname.'&ppn='.$parent_phone_number;

    if (empty($fname)) {
		$em  = "Nombre obligatorio";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($lname)) {
		$em  = "Apellido obligatorio";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($uname)) {
		$em  = "Usuario obligatorio";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (!unameIsUnique($uname, $conn)) {
		$em  = "Usuario ya existente! Utiliza otro";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($pass)) {
		$em  = "Contraseña obligatoria";
		header("Location: ../student-add.php?error=$em&$data");
		exit;
	}else if (empty($address)) {
        $em  = "Dirección obligatoria";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Género obligatorio";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Dirección de email obligatoria";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Fecha de nacimiento obligatoria";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_fname)) {
        $em  = "Nombre del padre obligatorio";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_lname)) {
        $em  = "Apellido del padre obligatorio";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Número de teléfono obligatorio";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em  = "Sección obligatoria";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else {
        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql  = "INSERT INTO
                 students(username, password, fname, lname, grade, section, address, gender, email_address, date_of_birth, parent_fname, parent_lname, parent_phone_number)
                 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $fname, $lname, $grade, $section, $address, $gender, $email_address, $date_of_birth, $parent_fname, $parent_lname, $parent_phone_number]);
        $sm = "Nuevo estudiante registrado con éxito";
        header("Location: ../student-add.php?success=$sm");
        exit;
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../student-add.php?error=$em");
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
