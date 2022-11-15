<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* Gonzalez Lautaro FAI-2950 - Carrera: TUDW lautarofglez@gmail.com LautaroGonzalez-FAI2950
Camusso Valentin - FAI-3208 - Carrera: TUDW - valentin.camusso@est.fi.uncoma.edu.ar - github.com/ValentinCamussoFAI-3208
Emiliano Lopez - FAI-3357 - Carrera: TUDW - Mail: emiliano.lopez@est.fi.uncoma.edu.ar - Github: EmiMlz 
Rossi Julia - FAI-2378 - Carrera: TUDW - Mail: julia.rossi@est.fi.uncoma.edu.ar - Github: JuliaRossiFAI-2378 */

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Carga y retorna una colección de 20 palabras ya definidas que se utilizara en el juego
 * @return ARRAY
 */
//(Explicación 3 punto 1)
function cargarColeccionPalabras()
{
    // ARRAY $coleccionPalabras
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "ABRAN", "RATON", "PASOS", "LOSAS", "FECHA"
    ];

    return ($coleccionPalabras);
}
/**
 * Carga y retorna una colección de partidas de ejemplo, con la palabra jugada, el jugador que la jugo, en el intento en que adivino o no y finalmente el puntaje obtenido
 * @return ARRAY
 */
//(Explicación 3 punto 2)
function cargarPartidas()
{
    // ARRAY $coleccionPartidas
    $coleccionPartidas = [];
    $coleccionPartidas [0]= ["palabraWordix" => "QUESO","jugador" => "majo","intentos" => 0,"puntaje" => 0];
    $coleccionPartidas [1]= ["palabraWordix" => "CASAS","jugador" => "rudolf","intentos" => 3,"puntaje" => 14];
    $coleccionPartidas [2]= ["palabraWordix" => "QUESO","jugador" => "pink2000","intentos" => 6,"puntaje" => 10];
    $coleccionPartidas [3]= ["palabraWordix" => "FUEGO","jugador" => "noobmaster69","intentos" => 1,"puntaje" => 13];
    $coleccionPartidas [4]= ["palabraWordix" => "TINTO","jugador" => "jebus","intentos" => 1,"puntaje" => 17];
    $coleccionPartidas [5]= ["palabraWordix" => "HUEVO","jugador" => "julia","intentos" => 4,"puntaje" => 11];
    $coleccionPartidas [6]= ["palabraWordix" => "LOSAS","jugador" => "felixmodelorjr","intentos" => 2,"puntaje" => 15];
    $coleccionPartidas [7]= ["palabraWordix" => "RATON","jugador" => "mickey","intentos" => 5,"puntaje" => 13];
    $coleccionPartidas [8]= ["palabraWordix" => "RATON","jugador" => "majo","intentos" => 5,"puntaje" => 13];
    $coleccionPartidas [9]= ["palabraWordix" => "GATOS","jugador" => "majo","intentos" => 2,"puntaje" => 15];
    $coleccionPartidas [10]= ["palabraWordix" => "NAVES","jugador" => "buzzlightyear","intentos" => 1,"puntaje" => 17];
    return ($coleccionPartidas);
}

/** Esta función recibe la colección de palabras y una palabra nueva ingresada por el jugador en el programa pincipal,
 * y retorna la colección de palabras con la palabra agregada.
 * @param ARRAY $coleccionPalabras
 * @param ARRAY $nuevaPalabra
 * @return ARRAY
 */
//(Explicación 3 punto 7)
function agregarPalabra ($coleccionPalabras, $nuevaPalabra) {
    /* A $coleccionPalabras se le añade la $nuevaPalabra en el índice de su longitud (ya que la longitud siempre
    es uno mas grande que el último índice). */
    $coleccionPalabras[count($coleccionPalabras)] = $nuevaPalabra;
    return $coleccionPalabras;
}

/** Esta función devuelve el índice de la primera partida ganada por un jugador determinado por el usuario en el programa principal.
 * @param STRING $jugador
 * @param ARRAY $coleccionPartidas
 * @return INT
 */
//(Explicación 3 punto 8)
function indicePrimerPartidaGanada($jugador, $coleccionPartidas){
    //INT $n, $i, $indice
    $n = count($coleccionPartidas); 
    $i=0;
    $indice=-1; // Inicia en -1 para poder comparar, y cuando el jugador no esta registrado devuelve este valor
    while ($i<$n && $i!=$indice){
        if ($jugador==$coleccionPartidas[$i]["jugador"] && $coleccionPartidas[$i]["puntaje"]>0 ){
        $indice=$i;
        }elseif($jugador==$coleccionPartidas[$i]["jugador"] && $coleccionPartidas[$i]["puntaje"]==0){
            $indice = -2;
            $i++;
            // Devuelve -2 cuando el jugador jugó pero no ganó
        }else{
            $i++;
        }
    }
    return $indice;
}

/** Esta función solicita el nombre del jugador y retorna su nombre en minúsculas.
 * @return STRING
 */
//(Explicación 3 punto 10)
function solicitarJugador() {
    // STRING $nombre, BOOLEAN $comienzaLetra
    do { // Le pide el nombre al jugador hasta que lo que ingrese empieze con una letra
        echo "¿Nombre del jugador? Debe empezar con una letra: ";
        $nombre = trim(fgets(STDIN));
        $comienzaLetra = ctype_alpha($nombre[0]);
    } while (!$comienzaLetra);
    $nombre = strtolower($nombre); // Pasa el nombre a minúsculas
    return $nombre;
}

/** Esta función recibe un valor y muestra ese número de partida
 * @param ARRAY $partidas
 * @param INT $numeroPartida
 */
//COMPLETADO (Explicación 3 punto 6)
function mostrarPartida($partidas,$numeroPartida){
    /* ARRAY $arrayAux */
    $arrayAux = $partidas[$numeroPartida];
    //Muestra la partida
    echo "***************************************************\n";
    echo "Partida WORDIX ".$numeroPartida + 1 .": palabra ". $arrayAux["palabraWordix"]. "\n";
    echo "Jugador: ". $arrayAux["jugador"]. "\n";
    echo "Puntaje: ". $arrayAux["puntaje"]. " puntos \n";
    echo "Intento: ". (($arrayAux["intentos"]>0) ? "Adivinó la palabra en ". $arrayAux["intentos"]. " intentos \n" : "No adivinó la palabra \n");
    echo "***************************************************\n";
}

/** Esta función dada una colección de partidas y el nombre de un jugador retorna sus estadísticas
 * @param STRING $jugador
 * @param ARRAY $coleccionPartidas
 * @return ARRAY
 */
//(Explicación 3 punto 9)
function extraerResumenJugador($jugador,$coleccionPartidas) {
    /*ARRAY $resumenUnJugador
    INT $n, $i, $contPartidasGanadas, $contPartidasTotales, $puntajeTotalUnJugador
    BOOLEAN $existe*/
    //Inicializacion de variables 
    $n = count($coleccionPartidas); 
    $contPartidasGanadas= 0;
    $contPartidasTotales= 0;
    $puntajeTotalUnJugador=0;
    $resumenUnJugador=["jugador"=> "","cantidadPartidas"=> 0, "puntajeTotal"=>0, "victorias"=>0, "intento1"=>0, "intento2"=>0, "intento3"=>0, "intento4"=>0,"intento5"=>0,"intento6"=>0];
    $existe= false;
    //
    for ($i=0; $i<$n; $i++){
        if ($jugador==$coleccionPartidas[$i]["jugador"]){ // Comparo en cada iteracion si el jugador es el mismo que el del indice $i de $coleccionPartidas
            $resumenUnJugador["jugador"] = $coleccionPartidas[$i]["jugador"]; //Guarda el nombre en $resumenUnJugador con clave "jugador"
            $puntajeTotalUnJugador += $coleccionPartidas[$i]["puntaje"]; // Suma el puntaje en $resumenUnJugador con clave "puntaje"
            $existe = true;// Se le asigna true porque el jugador fue encontrado, para que no salga por el lado del elseif
            switch ($coleccionPartidas[$i]["intentos"]) { //Este switch cambia por intento en el que gano y cuenta la cantidad de veces que finaliza en tal intento
                case 1: $resumenUnJugador["intento1"]+= 1;$contPartidasGanadas++;; break;
                case 2: $resumenUnJugador["intento2"]+= 1;$contPartidasGanadas++;break;
                case 3: $resumenUnJugador["intento3"]+= 1;$contPartidasGanadas++;break;
                case 4: $resumenUnJugador["intento4"]+= 1;$contPartidasGanadas++;break;
                case 5: $resumenUnJugador["intento5"]+= 1;$contPartidasGanadas++; break;
                case 6: $resumenUnJugador["intento6"]+= 1;$contPartidasGanadas++; break;
                }
            $contPartidasTotales++;
        } elseif($i+1==$n && !$existe) { //Posibilidad en el que el jugador no es encontrado, donde se pide que se ingrese otro y reinicia el contador de iteración
            echo "El jugador ingresado no existe en la colección de partidas, ingrese uno nuevamente: ";
            $jugador= trim(fgets(STDIN));
            $i=-1;
        }
    }
    //Se asigna en $resumenUnJugador los datos calculados
    $resumenUnJugador["cantidadPartidas"]= $contPartidasTotales;
    $resumenUnJugador["victorias"]= $contPartidasGanadas;
    $resumenUnJugador["puntajeTotal"]= $puntajeTotalUnJugador;
    return $resumenUnJugador;
}

/** Esta función compara una colección de partidas, las ordena alfabéticamente según jugador y palabra jugada
 * @param ARRAY $a
 * @param ARRAY $b
 * @return INT
 */
function comparacion($a,$b){
    if ($a["palabraWordix"]==$b["palabraWordix"]){
        return 0;
    }
    return (($a["jugador"]<$b["jugador"]) ? -1 : 1);
}

/** Muestra todas las colección de partidas ordenadas alfabeticamente jugadas
 * @param ARRAY $coleccionPartidas
 */
//(Explicación 3 punto 11)
function mostrarColeccionPartida($coleccionPartidas){
    uasort($coleccionPartidas, 'comparacion');
    print_r($coleccionPartidas);
}

/**
 * Esta función muestra el menú de wordix y comprueba si la opción seleccionada por el usuario esta dentro del rango de opciones
 * @return INT
 */
//(Explicación 3 punto 3)
function seleccionarOpcion(){
    /* INT $numeroOpcion */
    //Muestra el menú
    echo "Menu de opciones:\n";
    echo "\t1) Jugar al Wordix con una palabra elegida\n";
    echo "\t2) Jugar al Wordix con una palabra aleatoria\n";
    echo "\t3) Mostrar una partida\n";
    echo "\t4) Mostrar la primer partida ganadora\n";
    echo "\t5) Mostrar resumen de Jugador\n";
    echo "\t6) Mostrar listado de partidas ordenadas por jugador y por palabra\n";
    echo "\t7) Agregar una palabra de 5 letras a Wordix\n";
    echo "\t8) Salir\n";
    echo "Ingrese la opción que desea elegir: ";
    $numeroOpcion = solicitarNumeroEntre(1,8);
    return ($numeroOpcion);       
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/
//Declaración de variables:
// STRING $nombreJugador
// INT $numeroPalabra, $i,$jugoConPalabra, $opciones
// ARRAY $laColeccionPalabras, $laColeccionPartidas, $partida
// BOOLEAN $completado
//Inicialización de variables:
$jugoConPalabra=0;
//Proceso:
$laColeccionPartidas = cargarPartidas(); // 12) a)
$laColeccionPalabras = cargarColeccionPalabras(); // 12) b)

do {
    $opcion = seleccionarOpcion();
    /* Usamos un switch para una estructura de control especificada, en este caso solo tenemos 8 opciones a elegir, por lo cual
    el switch es una mejor opción antes que usar un if y consultar si el valor ingresado es 1,2,3...8*/
    //(Explicación 3, punto 12-e)
    switch ($opcion) {
        case 1: 
            $cantidadPartidas = count($laColeccionPartidas);
            $jugoConPalabra = 0;
            $nombreJugador = solicitarJugador();
            echo "¿Con que número de palabra desea jugar?: ";
            $numeroPalabra = solicitarNumeroEntre(1,count($laColeccionPalabras)) - 1;
            for ($i = 0; $i < count($laColeccionPartidas); $i++) {
                if ($laColeccionPartidas[$i]["jugador"] == $nombreJugador && $laColeccionPartidas[$i]["palabraWordix"] == $laColeccionPalabras[$numeroPalabra]) {
                    echo "La palabra solicitada ya fue utilizada por usted. Ingrese otro número: ";
                    $numeroPalabra = solicitarNumeroEntre(1,count($laColeccionPalabras)) - 1;
                    $i = -1;
                    $jugoConPalabra++;
                } if ($jugoConPalabra>count($laColeccionPalabras)) {
                    echo "Ya ha jugado con todas las palabras integradas del juego. Puede agregar mas con la funcion 'Agregar palabra'\n";
                    $completado= true;
                }
            }
            $partida = jugarWordix($laColeccionPalabras[$numeroPalabra], $nombreJugador);
            $laColeccionPartidas[count($laColeccionPartidas)] = $partida;
            break;
        case 2: 
            $nombreJugador=solicitarJugador();
            $jugoConPalabra = 0;
            $numeroPalabra=rand(0, count($laColeccionPalabras));
            $completado=false;
            for ($i = 0; $i < count($laColeccionPartidas) && !$completado; $i++) {
                if ($laColeccionPartidas[$i]["jugador"] == $nombreJugador && $laColeccionPartidas[$i]["palabraWordix"] == $laColeccionPalabras[$numeroPalabra]) {
                    $numeroPalabra = rand(0,count($laColeccionPalabras)-1);
                    $i = -1;
                    $jugoConPalabra++;
                }
                if ($jugoConPalabra>count($laColeccionPalabras)){
                    echo "Ya ha jugado con todas las palabras integradas del juego. Puede agregar mas con la funcion 'Agregar palabra'\n";
                    $completado= true;
                }
            }
            if(!$completado){
                $partida = jugarWordix($laColeccionPalabras[$numeroPalabra], $nombreJugador);
                $laColeccionPartidas[count($laColeccionPartidas)]=$partida;
            }
            break;
        case 3: 
            echo "Ingrese un número de partida para mostrar (Entre 1 y ". count($laColeccionPartidas). "): ";
            $partidaJugada = solicitarNumeroEntre(1, count($laColeccionPartidas))-1; //Guarda un valor como índice
            mostrarPartida($laColeccionPartidas,$partidaJugada);
            sleep(3);
            break;
        case 4:
            $nombreJugador = solicitarJugador();
            $elIndice = indicePrimerPartidaGanada($nombreJugador, $laColeccionPartidas);
            if($elIndice == -1){
                echo "No existe el jugador.";
            }elseif($elIndice == -2){
                echo "El jugador ",$nombreJugador," no ganó ninguna partida";
            }else{
                mostrarPartida($laColeccionPartidas,$elIndice);
            }
            sleep(5);
            break;

        case 5:
            $nombreJugador = solicitarJugador();
            $estadisticasJugador = extraerResumenJugador($nombreJugador,$laColeccionPartidas);
            echo "**************************************\n";
            echo "Jugador: ",$nombreJugador,"\n";
            echo "Partidas: ",$estadisticasJugador["cantidadPartidas"],"\n";
            echo "Puntaje Total: ",$estadisticasJugador["puntajeTotal"],"\n";
            echo "Victorias: ",$estadisticasJugador["victorias"],"\n";
            echo "Porcentaje de Victorias: ",(int)(($estadisticasJugador["victorias"]*100)/$estadisticasJugador["cantidadPartidas"]),"%\n";
            echo "Adivinadas:","\n";
            echo "\tIntento 1: ",$estadisticasJugador["intento1"],"\n";
            echo "\tIntento 2: ",$estadisticasJugador["intento2"],"\n";
            echo "\tIntento 3: ",$estadisticasJugador["intento3"],"\n";
            echo "\tIntento 4: ",$estadisticasJugador["intento4"],"\n";
            echo "\tIntento 5: ",$estadisticasJugador["intento5"],"\n";
            echo "\tIntento 6: ",$estadisticasJugador["intento6"],"\n";
            echo "**************************************\n";
            sleep(5);
            break;
        case 6:
            mostrarColeccionPartida($laColeccionPartidas);
            break;
        case 7:
            $palabraAgregada = leerPalabra5Letras();
            $laColeccionPalabras = agregarPalabra($laColeccionPalabras,$palabraAgregada);
            break;
        }

}while ($opcion != 8); // Explicación 3 punto 12-c
