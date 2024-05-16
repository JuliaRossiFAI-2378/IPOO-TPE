<?php
/**los pasajeros sean un objeto que tenga los atributos nombre, apellido, 
 * numero de documento y teléfono. */
class Pasajeros{
    private $nombre;
    private $apellido;
    private $numDocumento;
    private $telefono;
    private $numAsiento;
    private $numPasaje;

    public function __construct($nombre,$apellido,$telefono,$numDocumento,$numAsiento,$numPasaje)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->numDocumento = $numDocumento;
        $this->numAsiento = $numAsiento;
        $this->numPasaje = $numPasaje;
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
    public function getTelefono(){
        return $this->telefono;
    }
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }
    public function getNumDocumento(){
        return $this->numDocumento;
    }
    public function setNumDocumento($newNumDocumento){
        $this->numDocumento = $newNumDocumento;
    }
    public function getNumAsiento(){
        return $this->numAsiento;
    }
    public function setNumAsiento($newNumAsiento){
        $this->numAsiento = $newNumAsiento;
    }
    public function getNumPasaje(){
        return $this->numPasaje;
    }
    public function setNumPasaje($newNumPasaje){
        $this->numPasaje = $newNumPasaje;
    }
    public function __toString()
    {
        $cad = "\nNombre: ".$this->getNombre()."\nApellido: ".$this->getApellido().
        "\nTelefono: ".$this->getTelefono()."\nDocumento: ".$this->getNumDocumento()."\n";
        return $cad;
    }
    
}
?>