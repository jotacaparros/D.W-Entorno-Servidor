<?php require_once('../config.php');?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo URLSITE; ?>view/css/app.css">

    <title>CRUD MVC</title>
</head>

<body>
    <h1>Login</h1>
    <div class="panel">
        <form action="<?php echo URLSITE; ?>?c=login&m=loguearse" method="POST">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="usuario" 
        value="" required />
        <br>
        <label for="contrasena" class="form-label">Contrasena</label>
        <input type="password" class="form-control" name="contrasena" id="contrasena" 
        value="" required />
        <br>

        <br>
        <button type="submit" class="btn btn-primary">Aceptar</button>

        </form>
    </div>
</body>
</html>