<?php
// arquivo de conexão
include 'conn/connect.php';
 
// consulta para trazer os dados se filtrar
$id = $_GET['id'];
$listaDestaque = $conn->query("select * from vw_produtos where id = $id");
$linhaDestaque = $listaDestaque->fetch_assoc();
$numlinhasDestaque = $listaDestaque->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Detalhes Produto</title>
</head>

<body class="fundofixo">
    <?php  include 'menu_publico.php'?>
    <div class="container">
        <h2 class="breadcrumb alert-danger">
            <a href="index.php">
                <button class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </button>
                <!-- tag roger strong -->
                <strong>Detalhes do Produto</strong>
            </a>
        </h2>
        <div class="row">
            <?php do{?>
            <div class="thumbnail">
                <a href="produto_detalhes.php">
                    <img src="images/<?php echo $linhaDestaque['imagem'] ?>"
                        alt="images<?php echo $linhaDestaque['descricao'] ?>>" class="img-responsive img-rounded"
                        style="heigth: 20em ;">
                </a>
                <div class="caption text-center">
                    <h3 class="text-danger">
                        <strong><?php echo $linhaDestaque['descricao']?></strong>
                    </h3>
                    <p class="text-warning">
                        <strong><?php echo $linhaDestaque['rotulo']?></strong>
                    </p>

                    <p class="text-center">
                        <strong><?php echo $linhaDestaque['resumo']?></strong>
                    </p>
                    <p>
                        <a href="index.php" class="btn btn-danger" role="button">
                            <span class="hidden-xs">Retornar</span>
                            <span class="visible-xs glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        </a>
                    </p>
                </div>
            </div>?>
            <?php } while($linhaDestaque = $listaDestaque->fetch_assoc());?>
        </div>
    </div>
</body>

</html>