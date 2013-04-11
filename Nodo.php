<?php

abstract class Nodo {
    
    protected $nombre;
    
    protected $tramos;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->tramos = array();
    }
    
    public function getNombre(){
        return $this->nombre;
    }
    
    public function addTramo(Tramo $tramo){
        if($this->nombre===$tramo->getA()->nombre){
            $nodoLocal = $tramo->getA();
            $nodoRemoto = $tramo->getB();
        }elseif($this->nombre===$tramo->getB()->nombre){
            $nodoLocal = $tramo->getB();
            $nodoRemoto = $tramo->getA();
        }else{
            throw new Exception("Nodo '{$this->nombre}' no participa del tramo '{$tramo->getA()->nombre} - {$tramo->getB()->nombre}'");
        }
        
        
        if(!array_key_exists($nodoRemoto->nombre, $this->tramos)){
            $this->tramos[$nodoRemoto->nombre] = array();
        }
        
        if(array_key_exists($tramo->getMedioTransporte()->getNombre(), $this->tramos[$nodoRemoto->getNombre()])){
            throw new Exception(sprintf(
                "Ya existe un tramo para '%s - %s' en '%s'. Distancias: Anterior: %s, Nueva: %s.",
                $nodoLocal->nombre,
                $nodoRemoto->nombre,
                $tramo->getMedioTransporte()->getNombre(),
                $this->tramos[$nodoRemoto->nombre][$tramo->getMedioTransporte()->getNombre()]->getDistancia(),
                $tramo->getDistancia()
                        
            ));
        }
        $this->tramos[$nodoRemoto->nombre][$tramo->getMedioTransporte()->getNombre()] = $tramo;
    }
    
    public function getTramosPara(Nodo $nodo){
        $tramos = array();
        foreach ($this->tramos as $destino => $tramosPorMT) {
            if($nodo->nombre===$destino){
                foreach($tramosPorMT as $tramo){
                    $tramos[] = $tramo;
                }
            }
        }
        return $tramos;
    }
    
}