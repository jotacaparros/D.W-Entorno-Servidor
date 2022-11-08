<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1> INTRODUCE TUS DATOS </h1>
    <form action="comprueba_login.php" method="post">
        <table>
            <tr>
                <td class="izq"> Login:</td>
                <td class="der"><input type="text" name="login"></td>
            </tr>
            <tr>
                <td class="izq"> Password:</td>
                <td class="der"><input type="password" name="password"></td>
            </tr>
            <tr><td colspan="2"><input type="submit" name="enviar" value="Login"></td></tr>
        </table>


    </form>
</body>
</html>