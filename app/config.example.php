<?php
/*
*Proporciona una plantilla de configuración para conectar 
*la base de datos de mysql.*/
/*Este archivo no contiene contraseñas reales, se puede cargar en el git*/
#Establecer la dirección del servidor mysql
$host ="127.0.0.1";
$port = "3306";
$basedatos = "Proyecto_Academico";
$username = "nombre_de_usuario";
$password = "contraseña";
return[
    "host"=> $host,
    "port"=> $port,
    "dbname"=> $basedatos,
    "username"=> $username,
    "password"=> $password
];