<?php

/**
 * @todo Falta implementar validaciones:
 *          - Que entregue a todos los clientes
 */
class PlanDistribucion {

    public $rutasCliente;
    
    public function __construct() {
        $this->rutasCliente = array();
    }
    
    public function addRuta(RutaCliente $rutaCliente) {
        $this->rutasCliente[] = $rutaCliente;
    }
    
    public function getCosto() {
        if(!$this->esValido()){
            throw new Exception('Plan de distribución No Válido');
        }
        
        $costo = 0;
        foreach ($this->rutasCliente as $rutaCliente) {
            $costo += $rutaCliente->getCosto();
        }
        return $costo;
    }
    
    /**
     * @todo Validar que entregue a todos los clientes
     */
    public function esValido(){
        return true;
    }
    
}
