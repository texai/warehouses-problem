<?php

/**
 * @todo Falta implementar validaciones:
 *          - El primer tramo debe partir de la fábrica
 *          - El último tramo debe terminar en el cliente
 *          - El destino de un tramo debe coincidir con el origen del siguiente
 */
class RutaCliente {

    protected $cliente;
    protected $tramos;
    
    /**
     * 
     * @param Cliente $cliente
     * @param array|Tramo $tramos
     */
    public function __construct(Cliente $cliente, $tramos) {
        if($tramos instanceof Tramo){
            $tramos = array($tramos);
        }
        $this->cliente = $cliente;
        $this->tramos = array();
        if (!empty($tramos)){
            foreach ($tramos as $tramo) {
                $this->addTramo($tramo);
            }
        }
    }
    
    public function getCliente() {
        return $this->cliente;
    }

    public function getTramos() {
        return $this->tramos;
    }

    public function addTramo(Tramo $tramo){
        $this->tramos[] = $tramo;
    }
    
    public function calcCosto() {
        $costo = 0;
        foreach ($this->tramos as $tramo) {
            $costo += $tramo->getCosto($this->cliente);
        }
        return $costo;
    }
    
}

