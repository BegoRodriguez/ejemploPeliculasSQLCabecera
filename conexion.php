<?php

    /* En este script realizamos la conexión a la base de datos
    La base tiene que existir previamente y el usuario tener los permisos
    si hay un error al conectar simplemente sacasmos un aviso al usuario */
    
    // Dirección del host, usuario, password, base de datos
    $cnx = new mysqli("localhost","javaUser","123456789","bdcine"); //Variable de enlace entre el PHP y la base de datos
    //$cnx = new mysqli("localhost","root","***No os lo voy a decir***","BDCINE3");
    //$cnx = new mysqli("sql313.infinityfree.com","if0_34648844","RONB874QgrsHhn","if0_34648844_bdcine"); //Variable de enlace entre el PHP y la base de datos

    if ($cnx->error) {
        die("Error de conexión");
    }
    else {
        $cnx->query("SET NAMES utf8mb4");
    }
?>