<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
    	

if (isset($_POST['course_name']) &&
    isset($_POST['course_code']) &&
    isset($_POST['grade'])       &&
    isset($_POST['course_id'])) {
    
    include '../../CONEXION_DB.php';

    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $grade = $_POST['grade'];
    $course_id = $_POST['course_id'];

    $data = 'course_id='.$course_id;

    if (empty($course_id)) {
        $em  = "El ID del curso es obligatorio";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($grade)) {
        $em  = "Grado obligatorio";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_name)) {
        $em  = "Nombre del curso obligatorio";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else if (empty($course_code)) {
        $em  = "Código del curso obligatorio";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }else {
        // VERIFICAR SI LA CLASE YA EXISTE
        $sql_check = "SELECT * FROM subjects 
                      WHERE grade=? AND subject_code=?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->execute([$grade, $course_code]);
        if ($stmt_check->rowCount() > 0) {
              $courses = $stmt_check->fetch();
             if ($courses['subject_id'] == $course_id) {
                $sql  = "UPDATE subjects SET subject=?, subject_code=?, grade=?
                     WHERE subject_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$course_name, $course_code, $grade, $course_id]);
                $sm = "Curso actualizado con éxito";
                header("Location: ../course-edit.php?success=$sm&$data");
                exit;

             }else {
                 $em  = "El curso ya existe";
                 header("Location: ../course-edit.php?error=$em&$data");
                 exit;
            }
           
        }else {

            $sql  = "UPDATE subjects SET subject=?, subject_code=?, grade=?
                     WHERE subject_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$course_name, $course_code, $grade, $course_id]);
            $sm = "¡Curso actualizado con éxito!";
            header("Location: ../course-edit.php?success=$sm&$data");
            exit;
       }
	}
    
  }else {
  	$em = "Ha ocurrido un error";
    header("Location: ../course.php?error=$em");
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
