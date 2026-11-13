<?php
#archivo que establesca la conexion entre mysql y config.php

#Tarea 1: Cargar la configuracion
$config = require __DIR__ . '/config.php';
#Tarea 2: construir el Data source Name (DSN)
#aqui contiene el controlador, el host, el puerto, la base de datos y codificacion
$dsn = "mysql:host={$config['host']};"
     . "port={$config['port']};"
     . "dbname={$config['dbname']};"
     . "charset=utf8m64";
#Tarea 3: crear la conexion con PDO
#ERRMORE_EXCEPTION: para que nos muestre el error en caso de que falle la conexion

#fetch_Assoc: para que nos devuelva un arreglo asociativo
#EMULATE_PREPARES = false: para que nos devuelva un arreglo asociativo
#Me permite utilizar consultas preparadas, aunque el controlador de base de datos no las soporte de manera nativa. Esto puede ser útil para mejorar la seguridad y prevenir ataques de inyección SQL.
#" :: " es un operador de resolucion que me permite acceder a constantes y metodos estaticos de una clase
#" => " es un operador de asociacion que me permite asociar un valor a una clave en un arreglo 
$opciones = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

#Paso 4: crear la conexion con PDO
# utilinzmos new PDO para crear la conexion con la base de datos usando los parametros que definimos anteriormente

try {
    $conexion = new PDO
    ($dsn, $config['username'], 
    $config['password'], 
    $opciones
    );
} catch (PDOException $e) {
    #si hay un error en la conexion, se captura la excepcion y se muestra el mensaje de error
    #registrar el error tecnico en el servidor sin mostrar credenciales al usuario
    error_log("Error de conexion a la base de datos: " . $e->getMessage());
    #interrumpir la ejecucion del servidor si falla la conexion y mostrar un mensaje generico al usuario
    throw new RuntimeException("no fue posible conectar con la base de datos". $e->getMessage());
}
#Paso 5: devolver el objeto PDO para que pueda ser utilizado en otros archivos
#Si se quiere usar esta conexion utilizamos "require"
return $conexion;