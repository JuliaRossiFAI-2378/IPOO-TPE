<?php
/**clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido */
class ResponsableV{
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    public function __construct($numEmpleado,$numLicencia,$nombre,$apellido)
    {
        $this->numEmpleado = $numEmpleado;
        $this->numLicencia = $numLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    public function getNumEmpleado(){
        return $this->numEmpleado;
    }
    public function setNumEmpleado($newNumEmpleado){
        $this->numEmpleado = $newNumEmpleado;
    }
    public function getNumLicencia(){
        return $this->numLicencia;
    }
    public function setNumLicencia($newNumLicencia){
        $this->numLicencia = $newNumLicencia;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($newNombre){
        $this->nombre = $newNombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($newApellido){
        $this->apellido = $newApellido;
    }
    public function __toString()
    {
        $cad = "\nNombre: ".$this->getNombre()."\nApellido: ".$this->getApellido().
        "\nNumero de empleado: ".$this->getNumEmpleado()."\nNumero de licencia: ".$this->getNumLicencia()."\n";
        return $cad;
    }
}
?>