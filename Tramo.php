<?php

/**
 * Se asume que la distancia es la misma de A->B que de B->A
 */
class Tramo {

    /**
     *
     * @var Nodo
     */
    public $a;

    /**
     *
     * @var Nodo
     */
    public $b;

    /**
     *
     * @var MedioTransporte
     */
    public $medioTransporte;

    /**
     *
     * @var int
     */
    public $distancia;
    
    public function __construct(Nodo $a, Nodo $b, MedioTransporte $medioTransporte, $distancia) {
        $this->a = $a;
        $this->a->tramos[$b->nombre] = $b;
        $this->b = $b;
        $this->b->tramos[$a->nombre] = $a;
        $this->medioTransporte = $medioTransporte;
        $this->distancia = $distancia;
    }
    
    public function __toString() {
        return sprintf(
            '%8s %10s <=> %-10s (%6s): %4s Km.',
            '['.__CLASS__.']',
            $this->a->nombre,
            $this->b->nombre,
            $this->medioTransporte->nombre,
            $this->distancia) . PHP_EOL
        ;
    }
    
    public function getCosto(Cliente $cliente) {
        return 
            $this->medioTransporte->costoFijo +
            $this->distancia * $this->medioTransporte->costoVariable * $cliente->consumo +
            (($this->b instanceof Almacen) ? $this->b->costoFijo : 0 ) +
            (($this->b instanceof Almacen) ? $this->b->costoVariable * $cliente->consumo : 0) 
        ;
    }
    
    
}