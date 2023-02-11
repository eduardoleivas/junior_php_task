<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./res/css/style.css">
        <title>DASHBOARD</title>
    </head>
    <body>
        <?php
        session_start();

        //CASO NÃO EXISTA UMA SESSÃO INICIADA
        if(!isset ($_SESSION['id_func'])) {
            header('location:login.php');
        }

        // -- CARREGAR AGENDAMENTOS -- //
        try { //RECUPERAR AGENDAMENTO PELO TELEFONE DO PACIENTE
            include './res/libs/db_connect.php'; //INCLUDE DATABASE CONNECTION

            //MOSTRAR APENAS NÃO EXPIRADOS ORDEM CRESCENTE
            if (($_GET['order'] == "asc") && ($_GET['show'] == "available")) {
                $query = "SELECT p.nome, a.datahora, p.tel FROM paciente p, agendamento a WHERE p.tel = a.tel AND a.datahora > NOW() ORDER BY a.datahora ASC";

            //MOSTRAR APENAS NÃO EXPIRADOS ORDEM DECRESCENTE
            } else if (($_GET['order'] == "desc") && (($_GET['show'] == "available"))) {
                $query = "SELECT p.nome, a.datahora, p.tel FROM paciente p, agendamento a WHERE p.tel = a.tel AND a.datahora > NOW() ORDER BY a.datahora DESC";

            //MOSTRAR TODOS ORDEM CRESCENTE
            } else if(($_GET['order'] == "asc") && ($_GET['show'] == "all")) {
                $query = "SELECT p.nome, a.datahora, p.tel FROM paciente p, agendamento a WHERE p.tel = a.tel ORDER BY a.datahora ASC";

            //MOSTRAR TODOS ORDEM DECRESCENTE
            } else {
                $query = "SELECT p.nome, a.datahora, p.tel FROM paciente p, agendamento a WHERE p.tel = a.tel ORDER BY a.datahora DESC";
            }

            $stmt = $con->prepare($query); //PREPARESTMT

            //EXECUTAR A CONSULTA
            $stmt->execute();
            $result = $stmt->rowCount();
            echo  "<h2> AGENDAMENTOS REALIZADOS </h2>";

            //AGENDAMENTOS ENCONTRADOS
            if($result > 0 ) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Paciente</th>";
                echo "<th>Data do Agendamento</th>";
                echo "</tr>";

                //MOSTRAR OS DADOS DE CADA TUPLA
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<tr>";
                    echo "<td onclick='document.getElementById('link').click()'>"; //ONCLICK EVENT NO NOME DO PACIENTE
                    echo "<a href='./paciente.php?tel=".$row['tel']."' id='link'>".$row['nome']."</a> ";
                    echo "</td>";
		    $date = strtotime($row['datahora']);
                    echo "<td>".date("d F Y - H:i",$date)."</td>";
                    echo "</tr>";
                }
                echo"</table>";

                //MOSTRAR APENAS NÃO EXPIRADOS ORDEM CRESCENTE
                if (($_GET['order'] == "asc") && ($_GET['show'] == "available")) {
                    echo "<form>";
                    echo "<a href='?order=desc&show=available'>";
                    echo "<input class='button' type='button' value='Exibir em ordem decrescente' />";
                    echo "</a>";
                    echo "<a href='?order=asc&show=all'>";
                    echo "<input class='button' type='button' value='Exibir todos os agendamentos' />";
                    echo "</a>";
                    echo "</form>";

                //MOSTRAR APENAS NÃO EXPIRADOS ORDEM DECRESCENTE
                } else if (($_GET['order'] == "desc") && (($_GET['show'] == "available"))) {
                    echo "<form>";
                    echo "<a href='?order=asc&show=available'>";
                    echo "<input class='button' type='button' value='Exibir em ordem crescente' />";
                    echo "</a>";
                    echo "<a href='?order=desc&show=all'>";
                    echo "<input class='button' type='button' value='Exibir todos os agendamentos' />";
                    echo "</a>";
                    echo "</form>";

                //MOSTRAR TODOS ORDEM CRESCENTE
                } else if(($_GET['order'] == "asc") && ($_GET['show'] == "all")) {
                    echo "<form>";
                    echo "<a href='?order=desc&show=all'>";
                    echo "<input class='button' type='button' value='Exibir em ordem decrescente' />";
                    echo "</a>";
                    echo "<a href='?order=asc&show=available'>";
                    echo "<input class='button' type='button' value='Exibir apenas agendamentos não expirados' />";
                    echo "</a>";
                    echo "</form>";

                //MOSTRAR TODOS ORDEM DECRESCENTE
                } else {
                    echo "<form>";
                    echo "<a href='?order=asc&show=all'>";
                    echo "<input class='button' type='button' value='Exibir em ordem crescente' />";
                    echo "</a>";
                    echo "<a href='?order=desc&show=available'>";
                    echo "<input class='button' type='button' value='Exibir apenas agendamentos não expirados' />";
                    echo "</a>";
                    echo "</form>";
                }
            } else {
                echo "<p>Não existem agendamentos realizados.</p>";
            }

        //ERROR HANDLER
        } catch(PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        echo "<h2> FUNÇÕES DE ADMINISTRADOR </h2>";
        echo "<form>";

        // -- BOTÃO ADD REGISTRO -- //
        echo "<a href='./paciente/create.php'>";
        echo "<input class='button' type='button' value='Adicionar Registro' />";
        echo "</a>";

        // -- BOTÃO ADD AGENDAMENTO -- //
        echo "<a href='./paciente/agendar.php'>";
        echo "<input class='button' type='button' value='Adicionar Agendamento' />";
        echo "</a>";

        // -- BOTÃO DESCONECTAR -- //
        echo "<a href='./res/libs/kill_session.php'>";
        echo "<input class='button' type='button' value='Desconectar' />";
        echo "</a>";
        echo "</form>";
        ?>
    </body>
</html>