<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./res/css/style.css">
        <title>REGISTRO DO PACIENTE</title>
    </head>
    <body>
        <?php
        session_start();

        //CASO NÃO EXISTA UMA SESSÃO INICIADA
        if(!isset ($_SESSION['id_func'])) {
            header('location:login.php');
        }

        // -- CARREGAR DADOS DO PACIENTE -- //
        try { //RECUPERAR AGENDAMENTO PELO TELEFONE DO PACIENTE
            include './res/libs/db_connect.php'; //INCLUDE DATABASE CONNECTION

            $query = "SELECT * FROM paciente WHERE tel = ?";
            $stmt = $con->prepare($query); //PREPARESTMT


            //PREENCHER A QUERY
            $stmt->bindParam(1, $_GET['tel']);

            //EXECUTAR A CONSULTA
            $stmt->execute();
            $result = $stmt->rowCount();
            $fetchstmt = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['old_nome'] = $fetchstmt['nome'];
            $_SESSION['old_tel'] = $fetchstmt['tel'];
            $_SESSION['old_email'] = $fetchstmt['email'];

            echo "<h2> DETALHES DO PACIENTE </h2>";

            // -- BOTÃO EDITAR REGISTRO -- //
            echo "<form>";
            echo "<a href='./paciente/update.php'>";
            echo "<input class='button' type='button' value='Editar Registro' />";
            echo "</a>";

            // -- BOTÃO DELETAR REGISTRO -- //
            ?>
            <button class="button" type="reset" onclick="delConfirm()">Remover Registro</button>
            <script>
                function delConfirm() {
                    var check = confirm("Tem certeza que deseja remover este registro?");

                    // -- CONFIRMADO -- //
                    if (check) {
                        window.alert("Este registro será deletado...");
                        window.location.replace("./paciente/delete.php");

                    // -- RECUSADO -- //
                    } else {
                        window.location.replace("./login.php");
                    }
                }
            </script>
            <?php
            echo "</form>";

            // -- INFORMAÇÕES DO PACIENTE -- //
            echo "<h3>Nome Completo: </h3>";
            echo "<p>".$_SESSION['old_nome']."</p>";
            echo "<h3>Telefone: </h3>";
            echo "<p>".$_SESSION['old_tel']."</p>";
            echo "<h3>E-Mail de Contato: </h3>";
            echo "<p>".$_SESSION['old_email']."</p>";

            // -- BOTÃO VOLTAR -- //
            echo "<form>";
            echo "<a href='./index.php?order=desc&show=all'>";
            echo "<input class='button' type='button' value='Voltar' />";
            echo "</a>";

            // -- BOTÃO DESCONECTAR -- //
            echo "<a href='./res/libs/kill_session.php'>";
            echo "<input class='button' type='button' value='Desconectar' />";
            echo "</a>";
            echo "</form>";

        //ERROR HANDLER
        } catch(PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
        ?>
</html>