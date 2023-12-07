<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        

if (isset($_POST['fname'])      &&
    isset($_POST['lname'])      &&
    isset($_POST['username'])   &&
    isset($_POST['student_id']) &&
    isset($_POST['address'])    &&
    isset($_POST['email_address']) &&
    isset($_POST['gender'])        &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['section'])       &&
    isset($_POST['parent_fname'])  &&
    isset($_POST['parent_lname'])  &&
    isset($_POST['parent_phone_number']) &&
    isset($_POST['grade'])) {
    
    include '../../CONEXION_DB.php';
    include "../data/student.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];

    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $section = $_POST['section'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['parent_fname'];
    $parent_lname = $_POST['parent_lname'];
    $parent_phone_number = $_POST['parent_phone_number'];

    $student_id = $_POST['student_id'];
    
    $grade = $_POST['grade'];

    $data = 'student_id='.$student_id;

    if (empty($fname)) {
        $em  = "El nombre es obligatorio";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em  = "El apellido es obligatorio";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em  = "El usuario es obligatorio";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn, $student_id)) {
        $em  = "Usuario ya existente! Utiliza otro";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em  = "Dirección obligatoria";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Género obligatori";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Dirección de email obligatoria";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Fecha de nacimiento obligatoria";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_fname)) {
        $em  = "Nombre del padre obligatorio";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_lname)) {
        $em  = "Apellido del padre obligatorio";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Número de teléfono del padre obligatorio";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else if (empty($section)) {
        $em  = "Sección obligatoria";
        header("Location: ../student-edit.php?error=$em&$data");
        exit;
    }else {
        /*
$address = $_POST['address'];
    $gender = $_POST['gender'];
    $section = $_POST['section'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $parent_fname = $_POST['parent_fname'];
    $parent_lname = $_POST['parent_lname'];
    $parent_phone_number = $_POST['parent_phone_number'];

        */
        $sql = "UPDATE students SET
                username = ?, fname=?, lname=?, grade=?, address=?,gender = ?, section=?, email_address=?, date_of_birth=?, parent_fname=?,parent_lname=?,parent_phone_number=?
                WHERE student_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname,$fname, $lname, $grade, $address, $gender,$section, $email_address, $date_of_birth, $parent_fname, $parent_lname,$parent_phone_number, $student_id]);
        $sm = "¡Actualizado con éxito!";
        header("Location: ../student-edit.php?success=$sm&$data");
        exit;
    }
    
  }else {
    $em = "Ha ocurrido un error";
    header("Location: ../student.php?error=$em");
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
