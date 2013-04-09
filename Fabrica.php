<?php

class Fabrica extends Nodo {
    
    public function __construct($nombre) {
        parent::__construct($nombre, 0, 0);
    }
    
    public function __toString() {
        return sprintf('%25s', '['.__CLASS__.':'.$this->nombre.']') . PHP_EOL;
    }
        
}
