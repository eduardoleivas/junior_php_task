<?php

    //MÉTODO ATUALIZAR REGISTRO DE PACIENTE
    function attPaciente($nome, $tel, $email, $old_tel) {
        try { //RECUPERAR PACIENTE PELO TELEFONE E ATUALIZAR
            include 'db_connect.php'; //INCLUDE DATABASE CONNECTION
            $query = "UPDATE paciente SET nome = ?, tel = ?, email = ? WHERE tel = ?";
            $stmt = $con->prepare($query); //PREPARESTMT

            //PREENCHER A QUERY
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $tel);
            $stmt->bindParam(3, $email);
            $stmt->bindParam(4, $old_tel);

            //EXECUTAR A CONSULTA
            if ($stmt->execute()) {
                header('location:../paciente.php?tel='.$tel); //REDIRECT PRO PACIENTE
            } //USUÁRIO NÃO ENCONTRADO
            else {
                header('location:../index.php?order=desc&show=all'); //RETRY
            }

        //ERROR HANDLER
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }

    //MÉTODO DELETAR REGISTRO DE PACIENTE
    function delPaciente($tel) {
        try { //RECUPERAR PACIENTE PELO TEL
            include 'db_connect.php'; //INCLUDE DATABASE CONNECTION
            $query = "DELETE FROM paciente WHERE tel = ?";
            $stmt = $con->prepare($query); //PREPARESTMT

            //PREENCHER A QUERY
            $stmt->bindParam(1, $tel);

            //EXECUTAR A CONSULTA
            if ($stmt->execute()) {
                header('location:../index.php?order=desc&show=all'); //REDIRECT PRO INDEX
            }

        //ERROR HANDLER
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }

    // -- MÉTODO ADICIONAR REGISTRO DE PACIENTE -- //
    function addPaciente($nome, $tel, $email) {
        try { //INSERE OS DADOS DO PACIENTE NO BD
            include 'db_connect.php'; //INCLUDE DATABASE CONNECTION
            $query = "INSERT INTO paciente (nome, tel, email) VALUES (?, ?, ?)";
            $stmt = $con->prepare($query); //PREPARESTMT

            //PREENCHER A QUERY
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $tel);
            $stmt->bindParam(3, $email);

            //EXECUTAR A CONSULTA
            if ($stmt->execute()) {
                header('location:../paciente.php?tel=' . $tel); //REDIRECT PRO NOVO PACIENTE

            //USUÁRIO NÃO ENCONTRADO
            } else {
                header('location:../index.php?order=desc&show=all'); //RETRY
            }

        //ERROR HANDLER
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }

    // -- MÉTODO ADICIONAR AGENDAMENTO AO SISTEMA -- //
    function addAgendamento($tel, $ano, $mes, $dia, $hora, $minuto) {
        try { //FORMATA O DATETIME E INSERE NO BD
            include 'db_connect.php'; //INCLUDE DATABASE CONNECTION
            $datahora = $ano."-".$mes."-".$dia." ".$hora.":".$minuto.":00";
            $query = "INSERT INTO agendamento (tel, datahora) VALUES (?, ?)";
            $stmt = $con->prepare($query); //PREPARESTMT

            //PREENCHER A QUERY
            $stmt->bindParam(1, $tel);
            $stmt->bindParam(2, $datahora);

            //EXECUTAR A CONSULTA
            if ($stmt->execute()) {
                header('location:../index.php?order=desc&show=all'); //REDIRECT PRO INDEX

            //USUÁRIO NÃO ENCONTRADO
            } else {
                header('location:../index.php?order=desc&show=all'); //RETRY
            }

        //ERROR HANDLER
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }
    }

    function comboPacientes() {
        try { //RECUPERAR FUNCIONARIO PELO ID
            include 'db_connect.php'; //INCLUDE DATABASE CONNECTION
            $query = "SELECT nome, tel FROM paciente ORDER BY nome";
            $stmt = $con->prepare($query); //PREPARESTMT
            $stmt->execute();

            // -- CRIA A COMBOBOX -- //
            echo "<select name='tel' id='tel'>
                  <option value='' selected='selected'>Escolha um paciente:</option>";

            // -- CARREGAR A COMBOBOX COM OS NOMES E TELS -- //
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $paciente = $row['nome'];
                $tel = $row['tel'];
                echo "<option value='".$tel."'>".$paciente."</option>";
            }
            echo "</select>";

        //ERROR HANDLER
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

    }
?>