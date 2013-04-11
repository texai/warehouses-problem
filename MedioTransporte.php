<?php

class MedioTransporte {
    
    protected $nombre;
    protected $costoFijo;
    protected $costoVariable;
    
    public function __construct($nombre, $costoFijo = null, $costoVariable = null) {
        $this->nombre = $nombre;
        $this->costoFijo = $costoFijo;
        $this->costoVariable = $costoVariable;
    }
    
    public function __toString() {
        return sprintf('%25s c.Fijo: S/. %4s | c.Var: S/. %4s', '['.__CLASS__.':'.$this->nombre.']', $this->costoFijo, $this->costoVariable) . PHP_EOL;
    }
    
    
    
    public function getNombre() {
        return $this->nombre;
    }

    public function getCostoFijo() {
        return $this->costoFijo;
    }

    public function getCostoVariable() {
        return $this->costoVariable;
    }

}

