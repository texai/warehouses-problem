<?php

class Cliente extends Nodo {

    public $consumo;
    
    public function __construct($nombre, $consumo = null) {
        parent::__construct($nombre);
        $this->consumo = $consumo;
    }
    
    public function __toString() {
        return sprintf('%25s Consumo: %4s Tn/sem', '['.__CLASS__.':'.$this->nombre.']', $this->consumo) . PHP_EOL;
    }
    
    public function getCosto(array $tramos){
        $costo = 0;
        foreach ($tramos as $tramo) {
            $costo += $tramo->getCosto($this);
        }
        return $costo;
    }
    
}
