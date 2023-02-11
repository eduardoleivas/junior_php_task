<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href=".././res/css/style.css">
        <title>REGISTRAR PACIENTE</title>
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
            if ($action == 'create') { //ACTION PARA ADICIONAR
                addPaciente($_POST['nome'], $_POST['tel'], $_POST['email']);
            }


            echo"<div>";
            echo"<h2 class='title'>ADICIONAR REGISTRO</h2>";
            echo"</div>";

            echo"<form action='#' method='post'>";

            // -- INPUT BOX NOME -- //
            echo"<div>";
            echo"<label> Nome: </label>";
            echo"<input type='text' name='nome' placeholder='Nome Completo'>";
            echo"</div>";

            // -- INPUT BOX TEL -- //
            echo"<div>";
            echo"<label> Telefone: </label>";
            echo"<input type='text' name='tel' placeholder='Telefone'>";
            echo"</div>";

            // -- INPUT BOX EMAIL -- //
            echo"<div>";
            echo"<label> Email: </label>";
            echo"<input type='text' name='email' placeholder='E-Mail'>";
            echo"</div>";

            //CALL PASSAR PARAM. VIA POST
            echo"<input type='hidden' name='action' value='create' />";
            echo"<input type='submit'  class='primary-btn order-submit' value='Criar' />";
            echo"</form>";
        ?>
    </body>
</html>
