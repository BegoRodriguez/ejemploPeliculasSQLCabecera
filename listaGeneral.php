<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Lista General</title>
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
                <li class="breadcrumb-item active" aria-current="page">Listado General</li>
            </ol>
        </nav>
        <?php    
              if (!isset($_POST['filtro'])) {
                //Si no existe la variable filtro, mostramos un pequeño formulario para ayudar a mostrar mejor una tabla grande de datos//
                ?>
                <section class="container w-75 mt-2 bg-secondary p-3">
                    <form name="form1" id="form1" method="post" action="listaGeneral.php">
                        <select name="filtro" id="filtro" class="form-select-sm w-25">
                            <option value="0" selected>Todos los registros</option>
                            <option value="1">Sólo 5</option>
                            <option value="2">Sólo 20</option>
                            <option value="3">Sólo 50</option>
                            <option value="4">Sólo 100</option>
                        </select>
                        <input type="submit" class="btn btn-dark" value="Aceptar">
                    </form>
                </section>

                <?php
              }
              else{
                //Sí existe la variable es que el usuario hizo clic y recargo la página, pasamos a mostrar el listado según su petición//
                ?>
                <section class="container-fluid p-0">
                    <h2 class="text-bg-warning p-3">Resultados</h2>

                <table class="table">
                    <header class="text-center">
                        <tr class="text-center">
                            <th>Identificador</th>
                            <th>Título</th>
                            <th>Genero</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Finalización</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                        </tr>
                    </header>
                    <tbody>
                        <?php
                            //Abrimos desde aquí PHP para cargar los resultados//
                            //Nos conectamos al SERVER y a la BD//
                            require_once("conexion.php");
                            extract($_POST);
                            switch ($filtro) {
                                case '0':
                                    $SQL = "SELECT id, titulo, genero, DATE_FORMAT(fechaInicio,'%d-%m-%Y') as 'fecha', DATE_FORMAT(fechaFin,'%d-%m-%Y') as 'fecha2' FROM peliculas ORDER BY titulo, genero";
                                    break;
                                case '1':
                                    $SQL = "SELECT id, titulo, genero, DATE_FORMAT(fechaInicio,'%d-%m-%Y') as 'fecha', DATE_FORMAT(fechaFin,'%d-%m-%Y') as 'fecha2' FROM peliculas ORDER BY titulo, genero LIMIT 5";
                                    break;
                                case '2':
                                    $SQL = "SELECT id, titulo, genero, DATE_FORMAT(fechaInicio,'%d-%m-%Y') as 'fecha', DATE_FORMAT(fechaFin,'%d-%m-%Y') as 'fecha2' FROM peliculas ORDER BY titulo, genero LIMIT 20";
                                    break;
                                case '3':
                                    $SQL = "SELECT id, titulo, genero, DATE_FORMAT(fechaInicio,'%d-%m-%Y') as 'fecha', DATE_FORMAT(fechaFin,'%d-%m-%Y') as 'fecha2' FROM peliculas ORDER BY titulo, genero LIMIT 50";
                                    break; 
                                case '4':
                                    $SQL = "SELECT id, titulo, genero, DATE_FORMAT(fechaInicio,'%d-%m-%Y') as 'fecha', DATE_FORMAT(fechaFin,'%d-%m-%Y') as 'fecha2' FROM peliculas ORDER BY titulo, genero LIMIT 100";
                                    break;    
                                default:
                                    //En caso de que no haya seleccionado ninguna opción anterio IMPOSIBLE//
                                    break;
                            }
                            //Preparamos la sentencia a ejecutar, en este caso como son todos los registros a mostrar no hay parámetros//
                            $data = $cnx->query($SQL); //Esta sentencia ejecuta el SQL y el resultado lo carga en la variable $data, ahora solo con un bucle vamos mostrando los resultados//
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
                                <a href="listaGeneral.php" class="btn btn-secondary">Volver</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </section>
                <?php
              }

        ?>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>