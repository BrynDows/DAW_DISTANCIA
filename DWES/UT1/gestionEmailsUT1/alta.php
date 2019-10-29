<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alta Email</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    </head>
    <body>
        <?php
        include("./EmailDaoClass.php");
        include("./EmailBeanClass.php");
        ?>

        <?php
        $dao = new EmailDaoClass();
        ?>
        <div class="container">
            <h1>Alta Email</h1>
            <form method="post" >
                <div class="form-group">
                    <label for="inputNombre">Nombre</label>*
                    <input type="text" class="form-control" id="inputNombre" name="nombre" required placeholder="Introduzca nombre">
                </div>

                <div class="form-group">
                    <label for="inputEmail1">Email</label>*
                    <input onkeyup="getElementById('alerta').style.visibility = 'hidden'" type="email" required class="form-control" id="inputEmail1" name="email" aria-describedby="emailHelp" placeholder="Introduzca email" >
                </div>
                <button type="submit" style="float: right;" class="btn btn-primary">Enviar</button>

                <?php
                $email = $nombre = "";

                if ("POST" == filter_input(INPUT_SERVER, "REQUEST_METHOD")) {
                    $emailBean = new EmailBeanClass();
                    $email = filter_input(INPUT_POST, "email");
                    $nombre = filter_input(INPUT_POST, "nombre");
                    $emailBean->setEmail($email);
                    $emailBean->setNombre($nombre);

                    if ($dao->insertar($emailBean)) {
                        header("Location: ./listado.php");
                        die();
                    } else {
                        echo "<div id='alerta' class = 'alert alert-danger' role = 'alert'>";
                        echo "El usuario <b>$email</b> ya está dao de alta";
                        echo "</div>";
                    }
                }
                ?>
            </form>
            <div>
                <a href="listado.php">Listado emails</a>
            </div>
            <div>
                <a href="index.php">Inicio</a>
            </div>
        </div>
    </body>
</html>
