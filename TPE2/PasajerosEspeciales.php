<?php
class PasajerosEspeciales extends Pasajeros{
    private $servicioEspecial;
    private $requiereAsistencia;
    private $comidaEspecial;

    public function __construct($nombre,$apellido,$telefono,$numDocumento,$numAsiento,$numPasaje,$servicioEspecial,$requiereAsistencia,$comidaEspecial)
    {
        parent::__construct($nombre,$apellido,$telefono,$numDocumento,$numAsiento,$numPasaje);
        $this->servicioEspecial = $servicioEspecial;
        $this->requiereAsistencia = $requiereAsistencia;
        $this->comidaEspecial = $comidaEspecial;
    }
    
    public function getServicioEspecial(){
        return $this->servicioEspecial;
    }
    public function setServicioEspecial($newServicioEspecial){
        $this->servicioEspecial = $newServicioEspecial;
    }
    public function getRequiereAsistencia(){
        return $this->requiereAsistencia;
    }
    public function setRequiereAsistencia($newRequiereAsistencia){
        $this->requiereAsistencia = $newRequiereAsistencia;
    }
    public function getComidaEspecial(){
        return $this->comidaEspecial;
    }
    public function setComidaEspecial($newComidaEspecial){
        $this->comidaEspecial = $newComidaEspecial;
    }
    public function __toString()
    {
        $cad = parent::__toString()."Requiere servicio especial: ";
        if($this->getServicioEspecial())
            $cad .= "Si.";
        else
            $cad .= "No.";
        $cad .= "\nRequiere asistencia: ";
        if($this->getRequiereAsistencia())
            $cad .= "Si.";
        else
            $cad .= "No.";
        $cad .= "\nRequiere comida especial: ";
        if($this->getComidaEspecial())
            $cad .= "Si.";
        else
            $cad .= "No.";
        $cad .= "\n";
        return $cad;
    }
    public function darPorcentajeIncremento(){
        $porcentaje = 15;
        if($this->getServicioEspecial() && $this->getRequiereAsistencia() && $this->getComidaEspecial()){
            $porcentaje = 30;
        }
        return $porcentaje;
    }
}
?>