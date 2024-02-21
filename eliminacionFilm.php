<?php
 if (!isset($_GET['id'])) {
    header("Location:index.php");
}
else {
    extract($_GET);
    require_once("conexion.php");
    $param = $cnx->prepare("DELETE FROM peliculas WHERE id like ?");
    $param->bind_param("s",$id);
    $param->execute();
    header("Location:index.php");
}
?>