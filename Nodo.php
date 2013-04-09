<?php

abstract class Nodo {
    
    public $nombre;
    public $tramos;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->tramos = array();
    }
    
    public function addTramo(Tramo $tramo){
        if($this->nombre===$tramo->a->nombre){
            $nodoLocal = $tramo->a;
            $nodoRemoto = $tramo->b;
        }elseif($this->nombre===$tramo->b->nombre){
            $nodoLocal = $tramo->b;
            $nodoRemoto = $tramo->a;
        }else{
            throw new Exception("Nodo '{$this->nombre}' no participa del tramo '{$tramo->a->nombre} - {$tramo->b->nombre}'");
        }
        
        
        if(!array_key_exists($nodoRemoto->nombre, $this->tramos)){
            $this->tramos[$nodoRemoto->nombre] = array();
        }
        
        if(array_key_exists($tramo->medioTransporte->nombre, $this->tramos[$nodoRemoto->nombre])){
            throw new Exception(sprintf(
                "Ya existe un tramo para '%s - %s' en '%s'. Distancias: Anterior: %s, Nueva: %s.",
                $nodoLocal->nombre,
                $nodoRemoto->nombre,
                $tramo->medioTransporte->nombre,
                $this->tramos[$nodoRemoto->nombre][$tramo->medioTransporte->nombre]->distancia,
                $tramo->distancia
                        
            ));
        }
        $this->tramos[$nodoRemoto->nombre][$tramo->medioTransporte->nombre] = $tramo;
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