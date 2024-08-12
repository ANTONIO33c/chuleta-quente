<?php
include 'acesso_com.php';
include '../conn/connect.php';
if($_POST){
    $idUsuario = $_POST['id'];
    $login = $_POST['login'];
    $senhaUsuario = md5($_POST['senha']);

    $nivelUsuario = $_POST['nivel'];
    
        $updateUsuario = "update usuarios
        set login = '$login',
        senha = '$senhaUsuario',
        nivel = '$nivelUsuario'
        where id = $idUsuario;";
        $resultado = $conn->query($updateUsuario);
        
        if($resultado){
            header('location:usuarios_lista.php');
            }    
}
if ($_GET){
    $id_usuario = $_GET['id'];
}else{
    $id_usuario = 0;
}
$listaUsuario = $conn->query('select * from usuarios where id ='.$id_usuario);
$rowUsuario = $listaUsuario->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>USUARIOS | ATUALIZA</title>
</head>

<body>
    <?php include "menu_adm.php";?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="usuarios_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo Usuarios
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="usuarios_atualiza.php" method="post" name="form_insere"
                            enctype="multipart/form-data" id="form_insere">
                            <!-- O campo id deve permanecer oculto por isso estamos usando o hidden  -->
                            <input type="hidden" name="id" id="id" value="<?php echo $rowUsuario['id'];?>">
                            <label for="descri">Login:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="login" id="login" class="form-control"
                                    placeholder="Digite o nome de login de usuário" maxlength="20"
                                    value="<?php echo $rowUsuario['login']; ?>">
                            </div>
                            <label for="descri"> Senha:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </span>
                                <input type="password" name="senha" id="senha" class="form-control"
                                    placeholder="Digite a senha do usuário" maxlength="15"
                                    value="<?php echo $rowUsuario['senha']; ?>">
                            </div>
                            <label for="descri">Nova Senha:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </span>
                                <input type="password" name="senha" id="senha" class="form-control"
                                    placeholder="Digite a nova senha do usuário" maxlength="15"
                                    value="<?php ?>">
                            </div>
                            <label for="destaque">Nivel:</label>
                            <div class="input-group">
                                <label for="comum" class="radio-inline">
                                    <input type="radio" name="nivel" id="nivel" value="com"
                                        <?php echo $rowUsuario['nivel']=="com"?'checked':null; ?>>Comum
                                </label>
                                <label for="superior" class="radio-inline">
                                    <input type="radio" name="nivel" id="nivel" value="sup"
                                        <?php echo $rowUsuario['nivel']=="sup"?'checked':null; ?>>Superior
                                </label>
                            </div>
                            <br>
                            <input type="submit" name="atualizar" id="atualizar" class="btn btn-danger btn-block"
                                value="Atualizar">
                        </form>
                    </div>
                </div>
            </div>
    </main>
</body>

</html>