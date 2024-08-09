<?php 
 include '../conn/connect.php';
 if($_POST)
 {
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $nivel = $_POST['nivel'];
    $insereProduto = "insert usuarios (login,senha,nivel)
    values 
    ($id,'$login','$senha','$nivel')";

    $resultado = $conn->query($insereProduto);
 }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERE CLIENTE | CHULETA </title>
</head>
<body>
<form action="usuarios_insere.php" method="post">

       
        <label for="text">Login : </label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="senha">Senha : </label>
        <input type="senha" id="senha" name="senha" required><br><br>

        <label for="nivel">Nivel : </label>
        <input type="text" id="nivel" name="nivel" required><br><br>

        <input type="submit" value="Enviar" id="button">
</body>
</html>