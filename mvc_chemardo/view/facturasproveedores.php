<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php"); ?>

<h1>FACTURAS PROVEEDORES</h1>

<br />

<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Proveedor</th>
            <th>Número</th>
            <th>Fecha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($facturas->filas) :
            foreach ($facturas->filas as $fila) :
        ?>
        <tr>
            <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo $fila->proveedor; ?></td>
            <td><?php echo $fila->numero; ?></td>
            <td><?php echo date('d/m/Y', strtotime($fila->fecha)) ?></td>


            <td style="text-align: right; width: 50%;">
                <a href="index.php?c=facturasproveedores&m=editar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-success">Editar</button></a>
                <a href="index.php?c=facturasproveedores&m=borrar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-danger borrar" onclick="return confirm('¿Estás seguro de borrar el registro <?php echo $fila->id; ?>?');">Borrar</button></a>
                <a href="index.php?c=facturaslineasproveedores&factura_id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-warning">Líneas</button></a>
            </td>
        </tr>
        <?php
            endforeach;
        endif;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">
                <a href="index.php?c=facturasproveedores&m=nuevo">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                </a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>