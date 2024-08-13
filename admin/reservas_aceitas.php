<?php
include 'acesso_com.php';
include '../conn/connect.php';


if($_POST){
    $ReservaEmail = $_POST['email']; 
  $cpf = $_POST['cpf'];
  $NumeroPessoas = $_POST['numeroPessoas']; 
  $mesaDisponivel = $_POST['mesas_id'];
  $dataReserva = $_POST['dataDisponivel'];
    

    $result = explode('/', $dataReserva);

    if (count($result) === 3) {
        $dia = $result[0];
        $mes = $result[1];
        $ano = $result[2];

        // Converte para o formato MySQL (yyyy-mm-dd)
        $dataReserva = $ano . '-' . $mes . '-' . $dia;
    }
  $horaReserva = $_POST['HorariosDisponivel'];
  $especificacoes_especiais = $_POST['especial'];

  $insereReserva = "insert into reserva_adm (email,cpf,numero_pessoa,mesa,data_reserva,hora_reserva,especificacoes_especiais)
    values 
    ('$ReservaEmail' ,$cpf ,$NumeroPessoas, '$mesaDisponivel', $dataReserva, '$horaReserva',' $especificacoes_especiais')";

    $resultado = $conn->query($insereReserva);
    if($resultado){
        header('location:reservas_aceitas.php');
        }    
}
if ($_GET){
    $id_tipo = $_GET['id'];
}else{
    $id_tipo = 0;
}

// recuperando as meses disponiveis

$listaMesa = $conn->query("select * from mesa");
$rowMesa = $listaMesa ->fetch_assoc();
$numLinhas = $listaMesa ->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>RESERVA ACEITA | CHULETA</title>
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
                    Aprovar Reserva
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="reservas_lista.php" method="post" name="form_insere" enctype="multipart/form-data"
                            id="form_insere">


                            <label for="text">Email : </label>
                            <input type="text" id="email" name="email" required class="form-control"><br><br>

                            <label for="cpf">cpf : </label>
                            <input type="text" id="cpf" name="cpf" required class="form-control"><br><br>

                            <label for="numeroPessoas">Numero de pessoas : </label>
                            <input type="number" id="numeroPessoas" name="numeroPessoas" required
                                class="form-control">
                                <small>O titular da reserva tem direito a uma sobremesa GRÁTIS se o grupo tiver mais de 5 pessoas</small>
                                <br><br>

                                <label for="id_tipo">Mesas Disponiveis:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                </span>
                                <select name="id_tipo" id="id_tipo" class="form-control" required>
                                    <?php do{?>


                                    <option value="<?php echo $rowMesa ['id'];?>">
                                        <!-- buscar tipo -->
                                        <?php echo $rowMesa ['numero_mesa'];?>

                                    </option>
                                    <?php } while($rowMesa = $listaMesa->fetch_assoc());?>
                                </select>
                            </div>
                            <label for="dataDisponivel">Datas Disponiveis:</label>
                            <input type="date" id="dataDisponivel" name="dataDisponivel" required
                                class="form-control"><br><br>

                            <label for="HorariosDisponivel">Horários Disponiveis:</label>
                            <input type="time" id="HorariosDisponivel" name="HorariosDisponivel" min="17:00" max="23:00" required
                                class="form-control">
                                <small>Horário de funcionamento das 17 ás 23</small>
                                <br><br>
                            
                            <br>
                            <label for="especial">Precisa de algo especial? (opcional) </label>
                            <input type="text" id="especial" name="especial" class="form-control" placeholder="exemplo: aniversário, ocasiões especiais, etc.."><br><br>

                            <br>
                            <input type="submit" value="Confirmar" id="button" class="btn btn-success btn-block">
                            <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>