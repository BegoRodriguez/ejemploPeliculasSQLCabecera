<?php
    if (!isset($_POST['saveData'])) {
        header("Location:index.php");
    }
    else {
        extract($_POST);
        require_once("conexion.php");
        $param = $cnx->prepare("UPDATE peliculas SET titulo = ?, genero = ?, fechaInicio = ?, fechaFin = ? WHERE id like ?");
        $param->bind_param("sssss",$titulo,$genero,$fechaInicio, $fechaFin,$id);
        $param->execute();
        $cnx->close();

        $url = "updateFilm.php?id=$id";
        header("Location: $url"); 
        
    }
?>