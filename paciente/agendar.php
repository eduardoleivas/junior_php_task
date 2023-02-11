<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href=".././res/css/style.css">
        <title>AGENDAR CONSULTA</title>
    </head>
    <body>
        <?php
            session_start();

            //CASO NÃO EXISTA UMA SESSÃO INICIADA
            if(!isset ($_SESSION['id_func'])) {
                header('location:.././login.php');
            }

            include '.././res/libs/functions.php';  //INCLUDE FUNCTIONS
            $action = isset($_POST['action']) ? $_POST['action'] : "";
            if ($action == 'agendar') { //ACTION PARA AGENDAR
                addAgendamento($_POST['tel'], $_POST['ano'], $_POST['mes'], $_POST['dia'], $_POST['hora'], $_POST['minuto']);
            }


            echo"<div>";
            echo"<h2 class='title'>ADICIONAR REGISTRO</h2>";
            echo"</div>";

            echo"<form action='#' method='post'>";

            // -- GENERATE COMBOBOX -- //
            comboPacientes();

            // -- INPUT BOX ANO -- //
            echo"<div>";
            echo"<label> Hora: </label>";
            echo"<input type='text' name='hora' placeholder='HH'>";

            echo"<label> Minuto: </label>";
            echo"<input type='text' name='minuto' placeholder='MM'>";
            echo"</div>";

            echo"<div>";
            echo"<label> Dia: </label>";
            echo"<input type='text' name='dia' placeholder='DD'>";

            echo"<label> Mês: </label>";
            echo"<input type='text' name='mes' placeholder='MM'>";

            echo"<label> Ano: </label>";
            echo"<input type='text' name='ano' placeholder='AAAA'>";
            echo"</div>";

            //CALL PASSAR PARAM. VIA POST
            echo"<input type='hidden' name='action' value='agendar' />";
            echo"<input type='submit'  class='primary-btn order-submit' value='Agendar' />";
            echo"</form>";
        ?>
    </body>
</html>
