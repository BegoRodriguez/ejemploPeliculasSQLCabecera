<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Listado entre dos Fechas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link href="css/styles.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php require_once("header.html"); 
              require_once("nav.html"); 
        ?>
        <nav aria-label="breadcrumb" class="container-fluid bg-light">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-dark">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Listado Fechas</li>
            </ol>
        </nav>
        <?php    
              if (!isset($_POST['filtro1'])) {
                //Si no existe la variable filtro, mostramos un pequeño formulario para ayudar a mostrar mejor una tabla grande de datos//
                ?>
                <section class="container w-75 mt-2 bg-secondary p-3">
                    <form name="form1" id="form1" method="post" action="listaFechas.php">
                        <label class="form-label text-white">Desde fecha</label>
                        <input type="date" required class="form-control w-25" name="filtro1" id="filtro">
                        <label class="form-label text-white">Hasta fecha</label>
                        <input type="date" required class="form-control w-25" name="filtro2" id="filtro">
                        <input type="submit" class="btn btn-dark" value="Aceptar">
                    </form>
                </section>

                <?php
              }
              else{
                //Sí existe la variable es que el usuario hizo clic y recargo la página, pasamos a mostrar el listado según su petición//
                extract($_POST);
                ?>
                <section class="container-fluid p-0">
                    <h2 class="text-bg-warning p-3">Resultados</h2>
                <?php
                    //Vamos a comprobar que las fechas son correctas//
                    if (strtotime($filtro1) > strtotime($filtro2)) {
                        //Si la fecha primera es mayor que la segunda, se muestra el error//
                        echo "La fecha desde no puede ser posterior a la hasta<br>";
                        echo "<a href='listaFechas.php' class='btn btn-secondary'>Volver</a>";
                    }
                    else {
                        //En caso contrario seguimos//
                ?>
                <table class="table">
                    <header class="text-center">
                        <tr class="text-center">
                            <th>Identificador</th>
                            <th>Titulo</th>
                            <th>Genero</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </header>
                    <tbody>
                        <?php
                            //Abrimos desde aquí PHP para cargar los resultados//
                            //Nos conectamos al SERVER y a la BD//
                            require_once("conexion.php");
                            
                            //Preparamos la sentencia a ejecutar, en este caso si hay parámetro -> los apellidos//
                            $param = $cnx->prepare("SELECT id, titulo, genero, DATE_FORMAT(fechaInicio,'%d-%m-%Y') as 'fecha', DATE_FORMAT(fechaFin,'%d-%m-%Y') as 'fecha2' FROM peliculas WHERE fechaInicio between ? AND ? ORDER BY titulo, genero");
                            $buscamos = "%".strtoupper($filtro1)."%";
                            //between entre permite encontrar valores en un rango que puede ser numérico, de fecha o incluso de texto//
                            $param->bind_param("ss",$filtro1,$filtro2); // Tanta s's como interrogaciones
                            //Ejecutamos//
                            $param->execute();
                            $data = $param->get_result();
                            //get result recoge los resultados obtenidos y los carga en la variable data//
                            while ($row = $data->fetch_assoc()) {
                                //fetch assoc devuelve un array o fila que se carga en la variable $row (la podremos llamar como queramos)//
                                extract($row); //Extraemos cada fila y creamos los tr y td//
                                echo "<tr><td class='text-center'>$id</td><td class='text-center'>$titulo</td><td class='text-center'>$genero</td><td class='text-center'>$fecha</td><td class='text-center'>$fecha2</td><td class='text-center'><a href='updateFilm.php?id=$id' class='btn btn-warning'>Modificar</a></td><td class='text-center'><a href='deleteFilm.php?id=$id' class='btn btn-danger'>Eliminar</a></td></tr>";
                            }
                            $cnx->close();//Cerramos la conexión//
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">
                                <a href="listaFechas.php" class="btn btn-secondary">Volver</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </section>
                <?php
              }
            }
        ?>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>