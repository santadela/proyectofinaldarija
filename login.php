<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio de sesión - E-Darija</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="logodarija.png">
</head>
<body class="body-login">
    <div class="black-fill"><br /> <br />
    	<div class="d-flex justify-content-center align-items-center flex-column">
    	<form class="login"
              method="post"
              action="req/login.php">

    		<div class="text-center">
    			<img src="logodarija.png"
    			     width="100">
    		</div>
    		<h3>INICIAR SESION</h3>
            <?php if (isset($_GET['error'])) { ?>
    		<div class="alert alert-danger" role="alert">
			  <?=$_GET['error']?>
			</div>
			<?php } ?>
		  <div class="mb-3">
		    <label class="form-label">Usuario</label>
		    <input type="text"
                   class="form-control"
                   name="uname">
		  </div>
		  
		  <div class="mb-3">
		    <label class="form-label">Contraseña</label>
		    <input type="password" 
                   class="form-control"
                   name="pass">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Iniciar sesión como</label>
		    <select class="form-control"
                    name="role">
		    	<option value="1">Administrador</option>
		    	<option value="2">Profesor</option>
		    	<option value="3">Estudiante</option>
				<option value="4">Registrar Office</option>
		    </select>
		  </div>

		  <button type="submit" class="btn btn-primary">Iniciar sesión</button>
		  <a href="index.php" class="text-decoration-none">Inicio</a>
		</form>
        
        <br /><br />
        <div class="text-center text-light">
                Copyright &copy; 2023 E-Darija. Todos los derechos reservados.
        </div>

    	</div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
</body>
</html>