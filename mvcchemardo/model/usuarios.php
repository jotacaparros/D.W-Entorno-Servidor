<?php
require_once("bd.php");
class UsuariosModelo extends BD
{
    // Campos de la tabla.
    public $id;
    public $usuario;
    public $contrasena;
    public $nombre;
    public $foto_url;
    public $foto_nombre;

    public function Insertar()
    {
        $sql = "INSERT INTO usuarios VALUES".
               " (default, '$this->usuario', '$this->contrasena' , '$this->nombre' , '$this->foto_url','$this->foto_nombre' )";
        
        return $this->_ejecutar($sql);
    }

    public function Modificar()
    {
        $sql = "UPDATE usuarios SET" .
               " usuario='$this->usuario', contrasena='$this->contrasena', nombre='$this->nombre'";

        if($this->foto_nombre != ''){
            $sql .= ", foto_url='$this->foto_url' , foto_nombre='$this->foto_nombre'";
        }

        $sql .= " WHERE id=$this->id";
        
        return $this->_ejecutar($sql);
    }

    public function Borrar()
    {
        $sql = "DELETE FROM usuarios WHERE id=$this->id";

        return $this->_ejecutar($sql);
    }

    public function Seleccionar()
    {
        $sql = 'SELECT * FROM usuarios';
        
        // Si me han pasado un id, obtenemos solo el registro indicado.
        if ($this->id != 0)
            $sql .= " WHERE id=$this->id";
    
        $this->filas = $this->_consultar($sql);
        
        if ($this->filas == null)
            return false;
        
        if ($this->id != 0)
        {
            // Guardamos los campos en las propiedades.
            $this->usuario = $this->filas[0]->usuario;
            $this->contrasena = $this->filas[0]->contrasena;
            $this->nombre = $this->filas[0]->nombre;
            $this->foto_url = $this->filas[0]->foto_url;
            $this->foto_nombre = $this->filas[0]->foto_nombre;
        }
        return true;
    }
}
?>