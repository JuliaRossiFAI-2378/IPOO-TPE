<?php
include_once 'Pasajeros.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';
/**Implementar un script testViaje.php que cree una instancia de la clase Viaje y 
 * presente un menú que permita cargar la información del viaje, modificar y ver sus datos. */

$responsable = new ResponsableV(98,689,"Millie","Parfait");
$pas1 = new Pasajero("Juan","Perez",123123,321321);
$pas2 = new Pasajero("Macarena","Lopez",879798,546465);
$pasajeros = [$pas1,$pas2];
$viaje = new Viaje(13,"Neuquen",4,$pasajeros,$responsable);



function solicitarNumeroEntre($minimo,$maximo){
    $numero = trim(fgets(STDIN));
    while (!($numero>=$minimo && $numero<=$maximo) || !(is_numeric($numero))){
        echo "Debe ingresar un numero que este entre ".$minimo." y ".$maximo.": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}
/** Muestra el menu y pide seleccionar una opcion
 * @return INT
 */
function seleccionarOpcion(){
  echo "[1] Cargar informacion del viaje.\n";
  echo "[2] Modificar codigo del viaje.\n";
  echo "[3] Modificar destino del viaje.\n";
  echo "[4] Modificar cantidad maxima de pasajeros.\n";
  echo "[5] Agregar un pasajero.\n";
  echo "[6] Eliminar un pasajero.\n";
  echo "[7] Modificar el dato de un pasajero.\n";
  echo "[8] Ver la informacion del viaje.\n";
  echo "[9] Ver los datos de los pasajeros.\n";
  echo "[10] Ver los datos del responsable.\n";
  echo "[11] Modificar los datos del responsable.\n";
  echo "[12] Salir.\n";
  echo "Ingrese la opcion del menu que desea elegir: ";
  //Verifica que el numero elegido vaya unicamente entre las opciones del menu
  $opcionMenu = solicitarNumeroEntre(1,12);
  return $opcionMenu;
}
do{
  //Muestra el menu y devuelve la opcion elegida para utilizar en el switch
  $opcion = seleccionarOpcion();
  switch($opcion){
        case 1:
            echo "Ingrese el codigo del viaje: ";
            $codViaje = trim(fgets(STDIN));
            echo "Ingrese el destino del viaje: ";
            $destViaje = trim(fgets(STDIN));
            echo "Ingrese la cantidad maxima de pasajeros: ";
            $cantidadMaximaPasajeros = trim(fgets(STDIN));
            echo "Ingrese el nombre del responsable del viaje: ";
            $nombreResponsable = trim(fgets(STDIN));
            echo "Ingrese el apellido del responsable del viaje: ";
            $apellidoResponsable = trim(fgets(STDIN));
            echo "Ingrese el numero de licencia del responsable: ";
            $numeroLicencia = trim(fgets(STDIN));
            echo "Ingrese el numero de empleado del responsable: ";
            $numeroEmpleado = trim(fgets(STDIN));
            $responsable = new ResponsableV($numeroEmpleado,$numeroLicencia,$nombreResponsable,$apellidoResponsable);
            $viaje = new Viaje($codViaje,$destViaje,$cantidadMaximaPasajeros,$pasajeros,$responsable);
            break;
        case 2:
            echo "Ingrese el nuevo codigo de viaje: ";
            $nuevoCodigoViaje = trim(fgets(STDIN));
            $viaje->setCodigo($nuevoCodigoViaje);
            break;
        case 3:
            echo "Ingrese el nuevo destino de viaje: ";
            $nuevoDestinoViaje = trim(fgets(STDIN));
            $viaje->setDestino($nuevoDestinoViaje);
            break;
        case 4:
            echo "Ingrese la nueva cantidad maxima de pasajeros: ";
            $nuevaCantMaxPasajeros = trim(fgets(STDIN));
            $viaje->setCantMaxPasajeros($nuevaCantMaxPasajeros);
            break;
        case 5: 
            $cantPasajeros = count($viaje->getColPasajeros());
            $cantMaxPasajeros = $viaje->getCantMaxPasajeros();
            if($cantPasajeros < $cantMaxPasajeros){
                echo "Ingrese el nombre del pasajero: ";
                $nombrePasajero = trim(fgets(STDIN));
                echo "Ingrese el apellido del pasajero: ";
                $apellidoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de documento del pasajero: ";
                $documentoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de telefono del pasajero: ";
                $telefonoPasajero = trim(fgets(STDIN));
                $nuevoPasajero = new Pasajero($nombrePasajero,$apellidoPasajero,$documentoPasajero,$telefonoPasajero);
                if($viaje->agregarPasajero($nuevoPasajero)){
                    $viaje->agregarPasajero($nuevoPasajero); 
                    echo "El pasajero fue agregado exitosamente.";
                }else{
                    echo "Ya existe un pasajero con ese dni.";
                }
            }else{
                echo "No se pudo agregar el pasajero, el viaje ya alcanzo su capacidad maxima.";
            }
            break;
        case 6:
            $pasajeros = $viaje->getColPasajeros();
            $cantPasajeros = count($pasajeros);
            if ($cantPasajeros == 0){
                echo "\nNo hay pasajeros para eliminar.\n";
            }else{
                //Muestra los pasajeros asi el usuario sabe que numero de pasajero elegir
                for($i=0; $i<$cantPasajeros; $i++){
                    echo "\nPasajero numero: ".$i+1;
                    echo $pasajeros[$i];
                }
                echo "\nIngrese el numero del pasajero desea eliminar: ";
                //Solicita un numero que no sobrepase la cantidad de pasajeros
                $numeroDePasajero = solicitarNumeroEntre(1,$cantPasajeros);
                $viaje->eliminarPasajero($numeroDePasajero-1);
            }
            break;
        case 7:
            $cantPasajeros = count($viaje->getColPasajeros());
            //Verifica que haya pasajeros para modificar
            if ($cantPasajeros == 0){
                echo "No hay pasajeros registrados.\n";
            }else{
                //Imprime los pasajeros para que el usuario sepa que numero seleccionar
                //Muestra los pasajeros asi el usuario sabe que numero de pasajero elegir
                for($i=0; $i<$cantPasajeros; $i++){
                    echo "\nPasajero numero: ".$i+1;
                    echo $pasajeros[$i];
                }
                echo "\nIngrese el numero del pasajero desea modificar: ";
                //Solicita un numero que no sobrepase la cantidad de pasajeros
                $numeroDePasajero = solicitarNumeroEntre(1,$cantPasajeros);
                echo "Ingrese que dato desea modificar: ";
                $datoPasajero = trim(fgets(STDIN));
                /*Si el dato a modificar ingresado no es el nombre, el apellido o el dni, 
                seguira pidiendo dato a modificar hasta que se ingrese uno valido*/
                while (strcasecmp($datoPasajero,"nombre")!=0 && strcasecmp($datoPasajero,"apellido")!=0 && 
                    strcasecmp($datoPasajero,"dni")!=0 && strcasecmp($datoPasajero,"telefono")!=0){
                    echo "El dato ingresado no es valido, debe ser nombre, apellido, telefono o dni.\n".
                    "Ingrese el dato a modificar: ";
                    $datoPasajero = trim(fgets(STDIN));
                }
                echo "Ingrese el nuevo dato: ";
                $nuevoDato = trim(fgets(STDIN));
                $viaje->modificarDatosPasajero($numeroDePasajero-1,$datoPasajero,$nuevoDato);
            }
            break;
        case 8:
            echo $viaje;
            break;
        case 9: 
            $pasajeros = $viaje->getColPasajeros();
            $cantPasajeros = count($pasajeros);
            if($cantPasajeros > 0){
                for($i=0; $i<$cantPasajeros; $i++){
                    echo "\nPasajero ".$i+1 .":".$pasajeros[$i];
                }
            }else{
                echo "No hay pasajeros asignados a este viaje.";
            }
            break;
        case 10:
            echo $responsable;
            break;
        case 11:
            echo "Ingrese el nombre del responsable: ";
            $nombreResponsable = trim(fgets(STDIN));
            $responsable->setNombre($nombreResponsable);
            echo "Ingrese el apellido del responsable: ";
            $apellidoResponsable = trim(fgets(STDIN));
            $responsable->setApellido($apellidoResponsable);
            echo "Ingrese el numero de empleado del responsable: ";
            $numeroEmpleado = trim(fgets(STDIN));
            $responsable->setNumEmpleado($numeroEmpleado);
            echo "Ingrese el numero de licencia del responsable: ";
            $numeroLicencia = trim(fgets(STDIN));
            $responsable->setNumLicencia($numeroLicencia);
            echo "Los datos fueron cambiados exitosamente.";
            break;
  }
}while ($opcion!=12);
?>