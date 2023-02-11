<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href=".././res/css/style.css">
        <title>ATUALIZAR OS DADOS DO CLIENTE</title>
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
            if ($action == 'edit') { //ACTION PARA EDITAR
                attPaciente($_POST['nome'], $_POST['tel'], $_POST['email'], $_SESSION['old_tel']);
            }


            echo "<div>";
            echo "<h2 class='title'>EDITAR REGISTRO</h2>";
            echo "</div>";

            echo "<form action='#' method='post'>";

            // -- INPUT BOX NOME -- //
            echo "<div>";
            echo "<label> Nome: </label>";
            echo "<input type='text' name='nome' value='".$_SESSION['old_nome']."'>";
            echo "</div>";

            // -- INPUT BOX TEL -- //
            echo "<div>";
            echo "<label> Telefone: </label>";
            echo "<input type='text' name='tel' value=".$_SESSION['old_tel'].">";
            echo "</div>";

            // -- INPUT BOX EMAIL -- //
            echo "<div>";
            echo "<label> Email: </label>";
            echo "<input type='text' name='email' value=".$_SESSION['old_email'].">";
            echo "</div>";

            // -- CALL PASSAR PARAM. VIA POST -- //
            echo "<input type='hidden' name='action' value='edit' />";
            echo "<input type='submit'  class='primary-btn order-submit' value='Editar' />";
            echo "</form>";
        ?>
    </body>
</html>
