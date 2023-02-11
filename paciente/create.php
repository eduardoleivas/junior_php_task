<?php
  include '.././res/libs/functions.php';

  session_start();

  if (!isset($_SESSION['id_func'])) {
    header('location:.././login.php');
  }

  if (!empty($_POST['action']) && $_POST['action'] === "create") {
    addPaciente($_POST['nome'], $_POST['tel'], $_POST['email']);
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../res/css/style.css">
    <title>REGISTRAR PACIENTE</title>
  </head>
  <body>
    <div>
      <h2 class='title'>ADICIONAR REGISTRO</h2>
    </div>

    <form action='#' method='post'>
      <div>
        <label> Nome: </label>
        <input type='text' name='nome' placeholder='Nome Completo'>
      </div>

    <div>
      <label> Telefone: </label>
      <input type='text' name='tel' placeholder='Telefone'>
    </div>

    <div>
      <label> Email: </label>
      <input type='text' name='email' placeholder='E-Mail'>
    </div>
      <input type='hidden' name='action' value='create' />
      <input type='submit'  class='primary-btn order-submit' value='Criar' />
    </form>

  </body>
</html>