<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <title>Lista emails</title>
    </head>
    <body>

        <script>
            function filtrar() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("filtro");
                filter = input.value.toUpperCase();
                table = document.getElementById("tbodyEmails");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>

        <?php
        include("./EmailDaoClass.php");
        include './EmailBeanClass.php';
        ?>

        <?php
        $dao = new EmailDaoClass();
        $emails = $dao->consultarListado();
        ?>
        <div class="container">
            <h1>Listado Emails</h1>
            <input class="form-control" type="text" id="filtro" onkeyup="filtrar()" placeholder="filtrar..."/>
            <table id="tablaEmails" class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" >Email</th>
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody id="tbodyEmails">
                    <?php
                    if ($emails->count() == 0) {
                        echo "<tr>";
                        echo "<td colspan='2' align='center'> No hay elementos</td>";
                        echo "</tr>";
                    } else {
                        foreach ($emails as $em) {
                            echo "<tr>";
                            echo "<td>" . $em->getEmail() . "</td>";
                            echo "<td>" . $em->getNombre() . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <a href="alta.php">Alta email</a>
            </div>
            <div>
                <a href="index.php">Inicio</a>
            </div>
        </div>
    </body>
</html>
