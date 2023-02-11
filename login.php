<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="./res/css/style.css">
        <title>CONECTAR-SE</title>
    </head>
    <body>
        <?php
            session_start();

            //CASO JÁ EXISTA UMA SESSÃO INICIADA
            if(isset ($_SESSION['id_func'])) {
                header('location:index.php?order=desc&show=all');
            }

            $action = isset($_POST['action']) ? $_POST['action'] : "";
            if($action=='login') { //ACTION PARA CONECTAR
                include './res/libs/db_connect.php'; //INCLUDE DATABASE CONNECTION

                try { //RECUPERAR ID DO FUNCIONARIO PELO LOGIN E SENHA
                    $query = "SELECT id_func FROM funcionario WHERE login = ? AND senha = ? limit 0,1";
                    $stmt = $con->prepare($query); //PREPARESTMT
                    $senha = md5($_POST['senha']); //CRYPTO. A SENHA EM MD5 PARA VERIFICAÇÃO

                    //PREENCHER A QUERY
                    $stmt->bindParam(1, $_POST['login']);
                    $stmt->bindParam(2, $senha);

                    //EXECUTAR A CONSULTA
                    $stmt->execute();
                    $result = $stmt->rowCount();
                    $fetchstmt = $stmt->fetch(PDO::FETCH_ASSOC);
                    $id = $fetchstmt['id_func']; //SALVA O ID DO FUNCIONÁRIO PARA A SESSÃO

                    //USUÁRIO ENCONTRADO
                    if($result > 0 ) { //GUARDA OS DADOS DO USUÁRIO DA SESSÃO
                        $_SESSION['id_func'] = $id;
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['senha'] = $senha;
                        header('location:index.php?order=desc&show=all'); //REDIRECT PRO INDEX
                    }
                    //USUÁRIO NÃO ENCONTRADO
                    else {
                        unset ($_SESSION['login']);
                        unset ($_SESSION['senha']);
                        header('location:login.php'); //RETRY
                    }

                //ERROR HANDLER
                } catch(PDOException $exception) {
                    echo "Error: " . $exception->getMessage();
                }
            }

        echo "<div class='section-title'>";
        echo "<h2 class='title'>ENTRAR NO SISTEMA</h2>";
        echo "</div>";

        echo "<form action='#' method='post'>";

        // -- INPUT BOX LOGIN -- //
        echo "<div class='login-form'>";
        echo "<input class='input' type='text' name='login' placeholder='Nome de Usuário'>";
        echo "</div>";

        // -- INPUT BOX SENHA -- //
        echo "<div class='login-form'>";
        echo "<input class='input' type='password' name='senha' placeholder='Senha'>";
        echo "</div>";

        // -- CALL PARA PASSAR PARAM. VIA POST -- //
        echo "<input type='hidden' name='action' value='login' />";
        echo "<input type='submit'  class='button' value='ENTRAR' />";
        echo "</form>";
        ?>
    </body>
</html>