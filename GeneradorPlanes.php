<?php

class GeneradorPlanes {
    
    protected $clientes;
    protected $tramos;
    protected $almacenes;
    protected $fabrica;
    
    protected $planes;

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
     * Genera Rutas directas desde la fábrica hasta cada cliente, sin usar almacenes
     */
    private function _generarPlanesDirectos(){
        $tramosPorCliente = $this->_getTramosPorCliente();
        
        foreach ($tramosPorCliente as $cliente => $tramos){
            echo $cliente . ' => ' . PHP_EOL;
            foreach ($tramos as  $tramo){
                echo  $tramo;
            }
        }
        
    }
    
    protected function _getTramosPorCliente(){
        $tramosPorCliente = array();
        
        foreach($this->clientes as $cliente){
            $tramos = $this->_getTramosPorNodos($this->fabrica, $cliente);
            if(empty($tramos)){
                throw new Exception("No hay tramos para {$this->getFabrica()->getNombre()} -> {$cliente->getNombre()}");
            }
            $tramosPorCliente[$cliente->getNombre()] = $tramos;
            
        }
        return $tramosPorCliente;
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
    protected function _getTramosPorNodos(Nodo $a, Nodo $b){
        return $a->getTramosPara($b);
    }
    
    
    
    
    
    public function getClientes() {
        return $this->clientes;
    }

    public function getTramos() {
        return $this->tramos;
    }

    public function getAlmacenes() {
        return $this->almacenes;
    }

    public function getFabrica() {
        return $this->fabrica;
    }


    
}
