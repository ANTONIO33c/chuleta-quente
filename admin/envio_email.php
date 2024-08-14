<?php
include 'acesso_com.php';
include '../conn/connect.php';

if($_POST){
    $id = $_POST['id'];
    $ReservaEmail = $_POST['email']; 
}

if ($_GET){
    $id_reserva = $_GET['id'];
}else{
    $id_reserva = 0;
}


// pegando os dados da tabela de reserva
$listaEmail = $conn->query('select * from reserva where id ='. $id_reserva);
$rowEmail = $listaEmail->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Envio de Email | CHULETA</title>
</head>

<body>
    <?php include "menu_adm.php";?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="reservas_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Envio de Email
                </h2>
                <div class="alert alert-danger" role="alert">
                    <form action="envio_email.php" method="POST" name="form_insere" enctype="multipart/form-data"
                        id="form_insere">
                        <input type="hidden" name="id" id="id" value="<?php echo $rowEmail['id'];?>">

                        <label for="descri">EMAIL:</label>
                        <div class="input-group">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Digite o email"
                                maxlength="30" value="<?php echo $rowEmail['email']; ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>