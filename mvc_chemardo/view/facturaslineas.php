<?php  
require_once('controller/login.php');

if(!LoginControlador::Logueado()){
    header('location: '.URLSITE.'view/login.php');
    die();
}
require("layout/header.php"); ?>

<h1>FACTURAS LINEAS</h1>

<br />

<table class="table table-striped table-hover" id="tabla">
    <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Factura_id</th>
            <th>Ref.</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>IVA</th>
            <th>Importe</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($facturaslineas->filas) :
            foreach ($facturaslineas->filas as $fila) :
        ?>
        <tr>
            <td style="text-align: right; width: 5%;"><?php echo $fila->id; ?></td>
            <td><?php echo $fila->factura_id; ?></td>
            <td><?php echo $fila->referencia; ?></td>
            <td><?php echo $fila->descripcion; ?></td>
            <td><?php echo $fila->cantidad; ?></td>
            <td><?php echo $fila->precio; ?></td>
            <td><?php echo $fila->iva; ?></td>
            <td><?php echo $fila->importe; ?></td>

            <td style="text-align: right; width: 50%;">
                <a href="index.php?c=facturaslineas&m=editar&id=<?php echo $fila->id; ?>">
                    <button type="button" class="btn btn-success">Editar</button></a>
                <a href="index.php?c=facturaslineas&m=borrar&id=<?php echo $fila->id; ?>&factura_id=<?php echo $fila->factura_id; ?>">
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
            <td colspan="5">
                <a href="index.php?c=facturaslineas&m=nuevo&factura_id=<?php echo $factura_id; ?>">
                    <button type="button" class="btn btn-primary">Nuevo</button>
                </a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require("layout/footer.php"); ?>