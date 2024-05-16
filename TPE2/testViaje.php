<?php
include_once 'Pasajeros.php';
include_once 'ResponsableV.php';
include_once 'Viaje.php';
include_once 'PasajerosEspeciales.php';
include_once 'PasajerosEstandares.php';
include_once 'PasajerosVIP.php';

/**Implementar un script testViaje.php que cree una instancia de la clase Viaje y 
 * presente un menú que permita cargar la información del viaje, modificar y ver sus datos. */

$responsable = new ResponsableV(98,689,"Millie","Parfait");
$pas1 = new PasajerosEstandares("Juan","Perez",123123,321321,20,65464);
$pas2 = new PasajerosEspeciales("Macarena","Lopez",879798,546465,60,12332,true,false,true);
$pasajeros = [$pas1,$pas2];
$viaje = new Viaje(13,"Neuquen",5,[],$responsable,20000,0);
foreach($pasajeros as $pas){
    $viaje->venderPasaje($pas);
}

function requiereONo($cadena){
    while(strcasecmp($cadena, "si") != 0 && strcasecmp($cadena, "no") != 0){
        echo "La respuesta debe ser \"Si\" o \"No\", vuelva a ingresar su respuesta: ";
        $cadena = trim(fgets(STDIN));
    }
    $requiere = true;
    if(strcasecmp($cadena,"no") == 0){
        $requiere = false;
    }
    return $requiere;
}
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
  echo "\n[1] Cargar informacion del viaje.\n";
  echo "[2] Modificar codigo del viaje.\n";
  echo "[3] Modificar destino del viaje.\n";
  echo "[4] Modificar cantidad maxima de pasajeros.\n";
  echo "[5] Modificar el costo del viaje\n";
  echo "[6] Agregar un pasajero.\n";
  echo "[7] Eliminar un pasajero.\n";
  echo "[8] Modificar el dato de un pasajero.\n";
  echo "[9] Ver la informacion del viaje.\n";
  echo "[10] Ver los datos de los pasajeros.\n";
  echo "[11] Ver los datos del responsable.\n";
  echo "[12] Modificar los datos del responsable.\n";
  echo "[13] Salir.\n";
  echo "Ingrese la opcion del menu que desea elegir: ";
  //Verifica que el numero elegido vaya unicamente entre las opciones del menu
  $opcionMenu = solicitarNumeroEntre(1,13);
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
            echo "Ingrese el costo del viaje: ";
            $costoViaje = trim(fgets(STDIN));
            echo "Ingrese el nombre del responsable del viaje: ";
            $nombreResponsable = trim(fgets(STDIN));
            echo "Ingrese el apellido del responsable del viaje: ";
            $apellidoResponsable = trim(fgets(STDIN));
            echo "Ingrese el numero de licencia del responsable: ";
            $numeroLicencia = trim(fgets(STDIN));
            echo "Ingrese el numero de empleado del responsable: ";
            $numeroEmpleado = trim(fgets(STDIN));
            $responsable = new ResponsableV($numeroEmpleado,$numeroLicencia,$nombreResponsable,$apellidoResponsable);
            $viaje = new Viaje($codViaje,$destViaje,$cantidadMaximaPasajeros,[],$responsable, $costoViaje, 0);
            foreach($pasajeros as $pasajero){
                $viaje->venderPasaje($pasajero);
            }
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
            echo "Ingrese el nuevo costo del viaje: ";
            $costoViaje = trim(fgets(STDIN));
            while(!(is_numeric($costoViaje)) || $costoViaje < 0){
                echo "El costo debe ser un numero positivo. Ingrese el costo del viaje: ";
                $costoViaje = trim(fgets(STDIN));
            }
            $viaje->setCostoViaje($costoViaje);
            break;
        case 6: 
            if($viaje->hayPasajesDisponibles()){
                echo "Ingrese el nombre del pasajero: ";
                $nombrePasajero = trim(fgets(STDIN));
                echo "Ingrese el apellido del pasajero: ";
                $apellidoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de documento del pasajero: ";
                $documentoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de telefono del pasajero: ";
                $telefonoPasajero = trim(fgets(STDIN));
                echo "Ingrese el numero de asiento del pasajero: ";
                $numAsiento = trim(fgets(STDIN));
                echo "Ingrese el numero de pasaje: ";
                $numPasaje = trim(fgets(STDIN));
                echo "Ingrese que tipo de pasajero es (VIP, Especial o Estandar): ";
                $tipoPasajero = trim(fgets(STDIN));
                while(strcasecmp($tipoPasajero, "vip") != 0 && strcasecmp($tipoPasajero, "especial") != 0 && strcasecmp($tipoPasajero, "estandar") != 0){
                    echo "El tipo de pasajero es incorrecto. Intente ingresarlo nuevamente, recuerde que debe ser VIP, Especial o Estandar: ";
                    $tipoPasajero = trim(fgets(STDIN));
                }
                if(strcasecmp($tipoPasajero, "vip") == 0){
                    echo "Ingrese el numero de viajero frecuente: ";
                    $numViajero = trim(fgets(STDIN));
                    echo "Ingrese la cantidad de millas del pasajero: ";
                    $cantMillas = trim(fgets(STDIN));
                    $nuevoPasajero = new PasajerosVIP($nombrePasajero, $apellidoPasajero, $telefonoPasajero, $documentoPasajero,
                        $numAsiento, $numPasaje, $numViajero, $cantMillas);
                }elseif(strcasecmp($tipoPasajero, "especial") == 0){
                    echo "Requiere servicio especial? (Si o No): ";
                    $requiereServicio = requiereONo(trim(fgets(STDIN)));
                    echo "Requiere asistencia para embarcar y/o desembarcar? (Si o No): ";
                    $requiereAsistencia = requiereONo(trim(fgets(STDIN)));
                    echo "Requiere comida especial? (Si o No): ";
                    $requiereComida = requiereONo(trim(fgets(STDIN)));
                    $nuevoPasajero = new PasajerosEspeciales($nombrePasajero,$apellidoPasajero,$telefonoPasajero,$documentoPasajero,
                        $numAsiento,$numPasaje,$requiereServicio,$requiereAsistencia,$requiereComida);
                }else{
                    $nuevoPasajero = new PasajerosEstandares($nombrePasajero,$apellidoPasajero,$documentoPasajero,$telefonoPasajero,
                    $numAsiento,$numPasaje);
                }
                if(!$viaje->agregarPasajero($nuevoPasajero)){
                    $viaje->agregarPasajero($nuevoPasajero); 
                    echo "El pasajero fue agregado exitosamente.";
                }else{
                    echo "Ya existe un pasajero con ese dni.";
                }
            }else{
                echo "No se pueden agregar mas pasajeros, el viaje ya alcanzo su capacidad maxima.";
            }
            break;
        case 7:
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
        case 8:
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
                echo "Ingrese que dato desea modificar (nombre, apellido, telefono o dni): ";
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
        case 9:
            echo $viaje;
            break;
        case 10: 
            $pasajeros = $viaje->getColPasajeros();
            $cantPasajeros = count($pasajeros);
            if($cantPasajeros > 0){
                for($i=0; $i<$cantPasajeros; $i++){
                    echo "\n\tPasajero ".$i+1 .$pasajeros[$i];
                }
            }else{
                echo "No hay pasajeros asignados a este viaje.";
            }
            break;
        case 11:
            echo $responsable;
            break;
        case 12:
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
}while ($opcion!=13);
?>