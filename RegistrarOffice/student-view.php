<?php 
session_start();
if (isset($_SESSION['r_user_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Registrar Office') {
       include "../CONEXION_DB.php";
       include "data/student.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/section.php";

       if(isset($_GET['student_id'])){

       $student_id = $_GET['student_id'];

       $student = getStudentById($student_id, $conn);    
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrar Office - View Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logodarija.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php 
        if ($student != 0) {
     ?>
     <div class="container mt-5">
         <div class="card" style="width: 22rem;">
          <img src="../imagenes/student-<?=$student['gender']?>.png" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center">@<?=$student['username']?></h5>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Nombre: <?=$student['fname']?></li>
            <li class="list-group-item">Apellido: <?=$student['lname']?></li>
            <li class="list-group-item">Usuario: <?=$student['username']?></li>
            <li class="list-group-item">Dirección: <?=$student['address']?></li>
            <li class="list-group-item">Fecha de nacimiento: <?=$student['date_of_birth']?></li>
            <li class="list-group-item">Dirección de email: <?=$student['email_address']?></li>
            <li class="list-group-item">Género: <?=$student['gender']?></li>
            <li class="list-group-item">Fecha en la que se ha unido: <?=$student['date_of_joined']?></li>

            <li class="list-group-item">Grado: 
                 <?php 
                      $grade = $student['grade'];
                      $g = getGradeById($grade, $conn);
                      echo $g['grade_code'].'-'.$g['grade'];
                  ?>
            </li>
            <li class="list-group-item">Sección: 
                 <?php 
                    $section = $student['section'];
                    $s = getSectioById($section, $conn);
                    echo $s['section'];
                  ?>
            </li>
            <br><br>
            <li class="list-group-item">Nombre del padre: <?=$student['parent_fname']?></li>
            <li class="list-group-item">Apellido del padre: <?=$student['parent_lname']?></li>
            <li class="list-group-item">Número de teléfono del padre: <?=$student['parent_phone_number']?></li>
          </ul>
          <div class="card-body">
            <a href="student.php" class="card-link">Atrás</a>
          </div>
        </div>
     </div>
     <?php 
        }else {
          header("Location: student.php");
          exit;
        }
     ?>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	

</body>
</html>
<?php 

    }else {
        header("Location: student.php");
        exit;
    }

  }else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 

?>