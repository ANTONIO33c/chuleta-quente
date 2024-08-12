<?php 
include 'acesso_com.php';
include '../conn/connect.php';

if($_POST){
    $idTipo = $_POST['id'];
    $siglaTipo = $_POST['sigla'];
    $siglaRotulo = $_POST['rotulo'];

    $updateTipo = " update tipos
    set sigla = '$siglaTipo',
    rotulo = '$siglaRotulo'
    where id = $idTipo;";
    $resultado = $conn->query($updateTipo);
    if($resultado){
        header('location:tipos_lista.php');
        }    
}
if ($_GET){
    $id_tipo = $_GET['id'];
}else{
    $id_tipo = 0;
}
$listaTipo = $conn->query('select * from tipos where id ='.$id_tipo);
$rowTipo = $listaTipo->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>TIPOS ATUALIZA | CHULETA</title>
</head>

<body>
    <?php include "menu_adm.php";?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="tipos_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Atualizando Tipos
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="tipos_atualiza.php" method="post" name="form_insere"
                            enctype="multipart /form-data" id="form_insere">
                                <!-- O campo id deve permanecer oculto por isso estamos usando o hidden  -->
                                <input type="hidden" name="id" id="id" value="<?php echo $rowTipo['id'];?>">
                                <label for="descri">Sigla:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                    </span>
                                    <input type="text" name="sigla" id="sigla" class="form-control"
                                        placeholder="Digite a sigla" maxlength="3"
                                        value="<?php echo $rowTipo['sigla']; ?>">
                                </div>
                                <label for="descri">Rótulo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="rotulo" id="rotulo" class="form-control"
                                    placeholder="Digite o rótulo" maxlength="20"
                                    value="<?php echo $rowTipo['rotulo']; ?>">
                            </div>
                            <br>
                            <input type="submit" name="atualizar" id="atualizar" class="btn btn-danger btn-block"
                                value="Atualizar">
                        </form>
                        <div>
                        </div>
                    </div>
                </div>
    </main>

</body>

</html>