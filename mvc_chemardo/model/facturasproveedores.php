<?php
require_once("bd.php");

class FacturasProveedoresModelo extends BD
{
    // Campos de la tabla.
    public $id;
    public $proveedor_id;
    public $numero;
    public $fecha;

    public function Insertar()
    {
        $sql = "INSERT INTO facturasproveedores VALUES".
               " (default, $this->proveedor_id, $this->numero, '$this->fecha')";
        
        return $this->_ejecutar($sql);
    }

    public function Modificar()
    {
        $sql = "UPDATE facturasproveedores SET" .
               " proveedor_id=$this->proveedor_id, numero='$this->numero', " .
               " fecha='$this->fecha'" .
               " WHERE id=$this->id";

        return $this->_ejecutar($sql);
    }

    public function Borrar()
    {
        $sql = "DELETE FROM facturasproveedores WHERE id=$this->id";

        return $this->_ejecutar($sql);
    }

    public function Seleccionar()
    {
        $sql = 'SELECT *,'.
               ' (SELECT nombre FROM proveedores WHERE proveedores.id=facturasproveedores.proveedor_id) AS proveedor ' .
               ' FROM facturasproveedores';
        
        // Si me han pasado un id, obtenemos solo el registro indicado.
        if ($this->id != 0)
            $sql .= " WHERE id=$this->id";
    
        $this->filas = $this->_consultar($sql);
        
        if ($this->filas == null)
            return false;
        
        if ($this->id != 0)
        {
            // Guardamos los campos en las propiedades.
            $this->proveedor_id = $this->filas[0]->proveedor_id;
            $this->numero = $this->filas[0]->numero;
            $this->fecha = $this->filas[0]->fecha;
        }
        return true;
    }

    public function SeleccionarProveedor()
    {
        $sql = 'SELECT *,'.
               ' (SELECT nombre FROM proveedores WHERE proveedores.id=facturasproveedores.proveedor_id) AS proveedor ' . 
               ' FROM facturasproveedores';
        
        // Si me han pasado un id, obtenemos solo el registro indicado.
        if ($this->proveedor_id != 0)
            $sql .= " WHERE proveedor_id=$this->proveedor_id";
    
        $this->filas = $this->_consultar($sql);
        
        if ($this->filas == null)
            return false;
        
        if ($this->id != 0)
        {
            // Guardamos los campos en las propiedades.
            $this->proveedor_id = $this->filas[0]->proveedor_id;
            $this->numero = $this->filas[0]->numero;
            $this->fecha = $this->filas[0]->fecha;
        }
        return true;
    }
}
?>