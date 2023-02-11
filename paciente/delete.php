<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href=".././res/css/style.css">
        <title>REMOVER REGISTRO DO CLIENTE</title>
    </head>
    <body>
        <?php
            session_start();

            //CASO NÃO EXISTA UMA SESSÃO INICIADA
            if(!isset ($_SESSION['id_func'])) {
                header('location:.././login.php');
            }

            include '.././res/libs/functions.php';  //INCLUDE FUNCTIONS
            delPaciente($_SESSION['old_tel']);
        ?>
    </body>
</html>
