<?php

/**
 * @todo Falta implementar validaciones:
 *          - El primer tramo debe partir de la fábrica
 *          - El último tramo debe terminar en el cliente
 *          - El destino de un tramo debe coincidir con el origen del siguiente
 */
class RutaCliente {

    public $cliente;
    public $tramos;
    
    public function __construct($cliente, array $tramos = null) {
        $this->cliente = $cliente;
        $this->tramos = array();
        if (!empty($tramos)){
            foreach ($tramos as $tramo) {
                $this->addTramo($tramo);
            }
        }
    }
    
    public function addTramo(Tramo $tramo){
        $this->tramos[] = $tramo;
    }
    
    public function getCosto() {
        $costo = 0;
        foreach ($this->tramos as $tramo) {
            $costo += $tramo->getCosto($this->cliente);
        }
        return $costo;
    }
    
}

