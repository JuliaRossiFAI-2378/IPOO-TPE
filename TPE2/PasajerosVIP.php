<?php
class PasajerosVIP extends Pasajeros{
    private $numViajeroFrecuente;
    private $cantMillas;

    public function __construct($nombre,$apellido,$telefono,$numDocumento,$numAsiento,$numPasaje,$numViajeroFrecuente,$cantMillas)
    {
        parent::__construct($nombre,$apellido,$telefono,$numDocumento,$numAsiento,$numPasaje);
        $this->numViajeroFrecuente = $numViajeroFrecuente;
        $this->cantMillas = $cantMillas;
    }
    public function getNumViajeroFrecuente(){
        return $this->numViajeroFrecuente;
    }
    public function setNumViajeroFrecuente($newNumViajeroFrecuente){
        $this->numViajeroFrecuente = $newNumViajeroFrecuente;
    }
    public function getCantMillas(){
        return $this->cantMillas;
    }
    public function setCantMillas($newCantMillas){
        $this->cantMillas = $newCantMillas;
    }
    public function __toString()
    {
        $cad = parent::__toString()."Numero de viajero frecuente: ".$this->getNumViajeroFrecuente().
        "\nCantidad de millas: ".$this->getCantMillas()."\n";
        return $cad;
    }

    public function darPorcentajeIncremento(){
        $porcentaje = 35;
        if($this->getCantMillas() > 300){
            $porcentaje = 30;
        }
        return $porcentaje;
    }
}
?>