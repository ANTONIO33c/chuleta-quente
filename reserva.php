<?php 
include 'conn/connect.php';

if ($_POST){
  $ReservaEmail = $_POST['email']; 
  $cpf = $_POST['cpf'];
  $NumeroPessoas = $_POST['numeroPessoas']; 
  $dataReserva = $_POST['dataDisponivel'];
  $horaReserva = $_POST['HorariosDisponivel'];

  $insereReserva = "insert into reserva (email,cpf,numero_pessoa,data_reserva,hora_reserva)
    values 
    ('$ReservaEmail' ,$cpf ,$NumeroPessoas, $dataReserva, '$horaReserva','')";

    $resultado = $conn->query($insereReserva);
    

  
}


// selecionar a lista de horas disponivel para preencher <select>
$ListaHora = $conn->query("select * from horario_reserva order by hora_reserva"); 
$rowHora = $ListaHora->fetch_assoc();
$numLinhas = $ListaHora->num_rows;

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>RESERVA | CHULETA</title>
</head>

<body>
    <?php include  'menu_publico.php'?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="usuarios_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Solicitar Reserva
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="reserva.php" method="post" name="form_insere" enctype="multipart/form-data"
                            id="form_insere">


                            <label for="text">Email : </label>
                            <input type="text" id="email" name="email" required class="form-control"><br><br>

                            <label for="cpf">cpf : </label>
                            <input type="text" id="cpf" name="cpf" required class="form-control"><br><br>

                            <label for="numeroPessoas">Numero de pessoas : </label>
                            <input type="number" id="numeroPessoas" name="numeroPessoas" required
                                class="form-control"><br><br>

                            <label for="dataDisponivel">Datas Disponiveis:</label>
                            <input type="date" id="dataDisponivel" name="dataDisponivel" required
                                class="form-control"><br><br>

                            <label for="HorariosDisponivel">Horários Disponiveis:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                </span>
                                <select name="HorariosDisponivel" id="HorariosDisponivel" class="form-control" required>
                                    <?php do{?>


                                    <option value="<?php echo $rowHora['id'];?>">
                                        <!-- buscar tipo -->
                                        <?php echo $rowHora['hora_reserva'];?>

                                    </option>
                                    <?php } while($rowHora = $ListaHora->fetch_assoc());?>
                                </select>
                            </div>
                            <br>
                            <label for="especial">Precisa de algo especial? (opcional) </label>
                            <input type="text" id="especial" name="especial" class="form-control" placeholder="exemplo: aniversário, ocasiões especiais, etc.."><br><br>

                            <br>
                            <input type="submit" value="Enviar" id="button" class="btn btn-danger btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>