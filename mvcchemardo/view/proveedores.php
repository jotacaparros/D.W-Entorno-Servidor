<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php"); ?>

<h1>PROVEEDORES</h1>

<br />

<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($proveedores->filas) :
            foreach ($proveedores->filas as $fila) :
        ?>
        <tr>
            <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo $fila->nombre; ?></td>
            <td><?php echo $fila->email; ?></td>
            <td><?php echo $fila->telefono; ?></td>

            <td style="text-align: right; width: 50%;">
                <a href="index.php?c=proveedores&m=editar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-success">Editar</button></a>

                <a href="index.php?c=proveedores&m=borrar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-danger borrar" 
                            onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">Borrar</button></a>

                <a href="index.php?c=facturasproveedores&proveedores_id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-success">Facturas</button></a>
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
                <a href="index.php?c=proveedores&m=nuevo">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                </a>
            </td>
            <td colspan="1">
                <a href="index.php?c=proveedores&m=exportar">
                    <button type="button" class="btn btn-success">Exportar</button>
                </a>
            </td>
            <td colspan="1">
                <a href="index.php?c=proveedores&m=importar">
                    <button type="button" class="btn btn-warning">Importar</button>
                </a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>