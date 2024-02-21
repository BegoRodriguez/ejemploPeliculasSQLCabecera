<?php
    if (!isset($_GET['id'])) {
        header("Location:index.php");
    }
    else {
        extract($_GET);
        require_once("conexion.php");
        //Cargo todos los campos con *//
        $param = $cnx->prepare("SELECT * FROM peliculas WHERE id like ?");
        $param->bind_param("s",$id);
        $param->execute();
        $data = $param->get_result();
        $row = $data->fetch_assoc(); //Leemos la fila de datos obtenida//
        extract($row);
        $cnx->close();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Formulario para eliminar películas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="css/styles.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php require_once("header.html"); 
              require_once("nav.html"); 
        ?>
        <section class="container my-3 w-75">
            <form name="formFilm" id="formFilm" class="border border-dark rounded bg-white p-5">
                <h2 class="border-bottom border-white">Eliminación de Peliculas</h2>
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-4">
                        <img src="./images/film-3.jpg" alt="Film" class="logos">
                    </div>
                    <div class="col-lg-8">
                    <label class="form-label">Identificador <span class="text-danger">(*)</span></label>
                        <input type="text" required name="id" id="id" class="bg-dark form-control w-25 text-white">
                        <div class="col-lg-8">
                        <label class="form-label">Título <span class="text-danger">(*)</span></label>
                        <input type="text" required name="titulo" id="titulo" class="bg-dark form-control text-white">
                        <label class="form-label">Género <span class="text-danger">(*)</span></label>
                        <input type="text" required name="genero" id="genero" class="bg-dark form-control text-white">
                        <label class="form-label">Fecha de Inicio de Proyección <span class="text-danger">(*)</span></label>
                        <input type="date" required name="fechaInicio" id="fechaInicio" class="bg-dark form-control text-white">
                        <label class="form-label">Fecha de Fin de Proyección <span class="text-danger">(*)</span></label>
                        <input type="date" required name="fechaFin" id="fechaFin" class="bg-dark form-control text-white">
                       <div class="mt-2">
                        <a href="eliminacionFilm.php?id=<?php echo $id; ?>" class="btn btn-danger">Confirmar Eliminación</a>
                       </div>
                    </div>
                    </div>
                    
                </div>
                
            </form>
        </section>
    <?php require_once("footer.html"); ?>   
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>