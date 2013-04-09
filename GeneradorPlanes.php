<?php

class GeneradorPlanes {
    
    public $clientes;
    public $tramos;
    public $almacenes;
    public $fabrica;
    
    public $planes;

    public function __construct($clientes, $tramos, $almacenes, $fabrica) {
        $this->clientes = $clientes;
        $this->tramos = $tramos;
        $this->almacenes = $almacenes;
        $this->fabrica = $fabrica;
        $this->planes = array();
    }
    
    public function generarPlanes(){
        $this->_generarPlanesDirectos();
    }
    
    /**
     * Gera Rutas directas desde la fábrica hasta cada cliente, sin usar almacenes
     */
    private function _generarPlanesDirectos(){
        $tramosPorCliente = array();
        foreach($this->clientes as $cliente){
            $tramos = $this->_getTramosByNodos($this->fabrica, $cliente);
            if(empty($tramos)){
                throw new Exception("No hay tramos para {$this->fabrica->nombre} -> {$cliente->nombre}");
            }
            $tramosPorCliente[$cliente->nombre] = $tramos;
            
        }
    }
    
    public function addPlan(PlanDistribucion $plan){
        $this->planes[] = $plan;
    }
    
    /**
     * 
     * @param Nodo $a
     * @param Nodo $b
     * @return array Tramo[]
     */
    private function _getTramosByNodos(Nodo $a, Nodo $b){
        return $a->getTramosPara($b);
    }
    
    
    
}
