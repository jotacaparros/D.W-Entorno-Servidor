<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php");
require_once('controller/crypt.php');
?>

<h1>USUARIOS</h1>

<br />

<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Foto</th>
            <th>Id</th>
            <th>Usuario</th>
            <th>Contrasena</th>
            <th>Nombre</th>
            <th>Foto_url</th>
            <th>Foto_nombre</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($usuarios->filas) :
            foreach ($usuarios->filas as $fila) :
        ?>
        <tr>
            <td><img src="<?php echo $fila->foto_url; ?>" height="50"></td>
            <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo $fila->usuario; ?></td>
            <td><?php echo Crypt::Desencriptar($fila->contrasena); ?></td>
            <td><?php echo $fila->nombre; ?></td>
            <td><?php echo $fila->foto_url; ?></td>
            <td><?php echo $fila->foto_nombre; ?></td>

            <td style="text-align: right; width: 50%;">
                <a href="index.php?c=usuarios&m=editar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-success">Editar</button></a>

                <a href="index.php?c=usuarios&m=borrar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-danger borrar" 
                            onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">Borrar</button></a>
            </td>
        </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="1">
                <a href="index.php?c=usuarios&m=nuevo">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                </a>
            </td>
            <td colspan="1">
                <a href="index.php?c=usuarios&m=exportar">
                    <button type="button" class="btn btn-success">Exportar</button>
                </a>
            </td>
            <td colspan="1">
                <a href="index.php?c=usuarios&m=importar">
                    <button type="button" class="btn btn-warning">Importar</button>
                </a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>