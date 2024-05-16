<?php
/**De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros 
 * del viaje.
 * 
 * Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos 
 * de dicha clase (incluso los datos de los pasajeros). Utilice clases y arreglos  para   almacenar la información 
 * correspondiente a los pasajeros. Cada pasajero guarda  su “nombre”, “apellido” y “numero de documento”.
 * 
 * El viaje ahora contiene una referencia a una colección de objetos de la clase 
 * Pasajero. También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree 
 * una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje 
 * debe hacer referencia al responsable de realizar el viaje.

 * Implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego 
 * implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. 
 * Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la 
 * información del responsable del viaje. */
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $colPasajeros;
    private $responsableViaje;
    private $costoViaje;
    private $sumaCostos;

    public function __construct($codigo,$destino,$cantMaxPasajeros,$colPasajeros,$responsableViaje,$costoViaje,$sumaCostos)
    {
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->colPasajeros = $colPasajeros;
        $this->responsableViaje = $responsableViaje;
        $this->costoViaje = $costoViaje;
        $this->sumaCostos = $sumaCostos;
    }
    public function getCodigo(){
        return $this->codigo;
    }
    public function setCodigo($newCodigo){
        $this->codigo = $newCodigo;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function setDestino($newDestino){
        $this->destino = $newDestino;
    }
    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function setCantMaxPasajeros($newCantMaxPasajeros){
        $this->cantMaxPasajeros = $newCantMaxPasajeros;
    }
    public function getColPasajeros(){
        return $this->colPasajeros;
    }
    public function setColPasajeros($newColPasajeros){
        $this->colPasajeros = $newColPasajeros;
    }
    public function getResponsableViaje(){
        return $this->responsableViaje;
    }
    public function setResponsableViaje($newResponsableViaje){
        $this->responsableViaje = $newResponsableViaje;
    }
    public function getCostoViaje(){
        return $this->costoViaje;
    }
    public function setCostoViaje($newCostoViaje){
        $this->costoViaje = $newCostoViaje;
    }
    public function getSumaCostos(){
        return $this->sumaCostos;
    }
    public function setSumaCostos($newSumaCostos){
        $this->sumaCostos = $newSumaCostos;
    }
    public function __toString()
    {
        $cad = "\nCodigo: ".$this->getCodigo()."\nDestino: ".$this->getDestino()."\nCantidad maxima de pasajeros: ".
        $this->getCantMaxPasajeros()."\nCantidad actual de pasajeros: ".count($this->getColPasajeros()).
        "\nCosto del viaje: $".$this->getCostoViaje()."\nRecaudacion total del viaje: $".$this->getSumaCostos().
        "\nInformacion de los pasajeros";
        $pasajeros = $this->getColPasajeros();
        for($i=0; $i<count($pasajeros); $i++){
            $cad .= "\n\tPasajero ".$i+1 .$pasajeros[$i];
        }   
        return $cad;
    }

    public function modificarDatosPasajero($numPasajero,$datoPasajero,$nuevoDato){
        $pasajeros = $this->getColPasajeros();
        switch($datoPasajero){
            case "dni":
                $cantPasajeros = count($pasajeros);
                $seEncontro = false;
                $i = 0;
                while($i<$cantPasajeros && !$seEncontro){
                    $dniPasajero = $pasajeros[$i]->getNumDocumento();
                    if($dniPasajero == $nuevoDato){
                        $seEncontro = true;
                    }
                    $i++;
                }
                if(!$seEncontro){
                    $pasajeros[$numPasajero]->setNumDocumento($nuevoDato);
                }
                break;
            case "nombre":
                $pasajeros[$numPasajero]->setNombre($nuevoDato);
                break;
            case "apellido":
                $pasajeros[$numPasajero]->setApellido($nuevoDato);
                break;
            case "telefono":
                $pasajeros[$numPasajero]->setTelefono($nuevoDato);
                break;
        }
    }
    public function agregarPasajero($nuevoPasajero){
        $colPasajeros = $this->getColPasajeros();
        $cantPasajeros = count($colPasajeros);
        $seEncontro = false;
        $i = 0;
        while($i<$cantPasajeros && !$seEncontro){
            $dniPasajero = $colPasajeros[$i]->getNumDocumento();
            $nuevoDni = $nuevoPasajero->getNumDocumento();
            if($dniPasajero == $nuevoDni){
                $seEncontro = true;
            }
            $i++;
        }
        if(!$seEncontro){
            $colPasajeros[] = $nuevoPasajero;
            $this->setColPasajeros($colPasajeros);
        }
        return $seEncontro;    
    }
    public function eliminarPasajero($numPasajero){
        $colPasajeros = $this->getColPasajeros();
        unset($colPasajeros[$numPasajero]);
        $colPasajeros = array_values($colPasajeros);
        $this->setColPasajeros($colPasajeros);
    }
    public function hayPasajesDisponibles(){
        $disponible = false;
        if(count($this->getColPasajeros()) < $this->getCantMaxPasajeros()){
            $disponible = true;
        }
        return $disponible;
    }
    /**debe incorporar el pasajero a la colección de pasajeros ( solo si hay espacio disponible),
     * actualizar los costos abonados y retornar el costo final que deberá ser abonado por el pasajero.*/
    public function venderPasaje($objPasajero){
        $sumaCostos = $this->getSumaCostos();
        $costoFinal = -1;
        if($this->hayPasajesDisponibles()){
            $this->agregarPasajero($objPasajero);
            $sumaCostos += $this->getCostoViaje();
            $costoFinal = $this->getCostoViaje();
            $porcentajeIncremento = $objPasajero->darPorcentajeIncremento();
            $porcentajeIncremento = $costoFinal * ($porcentajeIncremento / 100);
            $sumaCostos += $porcentajeIncremento;
            $costoFinal += $porcentajeIncremento;
            $this->setSumaCostos($sumaCostos);
        }
        return $costoFinal;
    }
    
}

?>