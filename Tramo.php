<?php

/**
 * Se asume que la distancia es la misma de A->B que de B->A
 */
class Tramo {

    /**
     *
     * @var Nodo
     */
    protected $a;

    /**
     *
     * @var Nodo
     */
    protected $b;

    /**
     *
     * @var MedioTransporte
     */
    protected $medioTransporte;

    /**
     *
     * @var int
     */
    protected $distancia;
    
    public function __construct(Nodo $a, Nodo $b, MedioTransporte $medioTransporte, $distancia) {
        $this->a = $a;
        $this->b = $b;
        $this->medioTransporte = $medioTransporte;
        $this->distancia = $distancia;
        $this->a->addTramo($this);
        $this->b->addTramo($this);
//        $this->a->tramos[$b->getNombre()] = $b;
//        $this->b->tramos[$a->getNombre()] = $a;
        
    }
    
    public function getA() {
        return $this->a;
    }

    public function getB() {
        return $this->b;
    }

    public function getMedioTransporte() {
        return $this->medioTransporte;
    }

    public function getDistancia() {
        return $this->distancia;
    }

        
    public function __toString() {
        return sprintf(
            '%8s %10s <=> %-10s (%6s): %4s Km.',
            '['.__CLASS__.']',
            $this->a->getNombre(),
            $this->b->getNombre(),
            $this->medioTransporte->getNombre(),
            $this->distancia) . PHP_EOL
        ;
    }
    
    public function getCosto(Cliente $cliente) {
        return 
            $this->medioTransporte->getCostoFijo() +
            $this->distancia * $this->medioTransporte->getCostoVariable() * $cliente->getConsumo() +
            (($this->b instanceof Almacen) ? $this->b->getCostoFijo() : 0 ) +
            (($this->b instanceof Almacen) ? $this->b->getCostoVariable() * $cliente->getConsumo() : 0) 
        ;
    }
    
    
}