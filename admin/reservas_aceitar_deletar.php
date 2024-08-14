<?php
include 'acesso_com.php';
include '../conn/connect.php';


if($_POST){
    $id = $_POST['id'];
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
  $ReservaAceita = $_POST['reserva_aceita'];

  $insereReserva = "insert into reserva_adm (email,cpf,numero_pessoa,mesa,data_reserva,hora_reserva,especificacoes_especiais,reserva_aceita)
    values 
    ('$ReservaEmail' ,$cpf ,$NumeroPessoas, $mesaDisponivel, '$dataReserva', '$horaReserva',' $especificacoes_especiais',$ReservaAceita)";

    $resultado = $conn->query($insereReserva);
    if($resultado){
        header('location:reservas_lista.php');
        }    
}
if ($_GET){
    $id_reserva = $_GET['id'];
}else{
    $id_reserva = 0;
}

// pegando os dados da tabela de reserva
$lista = $conn->query('select * from reserva where id ='. $id_reserva);
$rowReserva = $lista->fetch_assoc();

// inserindo dado na tabela reserva_adm
$listaReservaAdm = $conn->query('select * from reserva_adm where id ='. $id_reserva);
$rowReservaAdm = $listaReservaAdm->fetch_assoc();

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
                            <input type="hidden" name="id" id="id" value="<?php echo $rowReserva['id'];?>">

                            <label for="descri">EMAIL:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="Digite o email" maxlength="30"
                                    value="<?php echo $rowReserva['email']; ?>">

                                <label for="cpf">cpf : </label>
                                <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Digite o cpf"
                                    maxlength="30" value="<?php echo $rowReserva['cpf']; ?>"><br><br>

                                <label for="numeroPessoas">Numero de pessoas : </label>
                                <input type="number" name="numeroPessoas" id="numeroPessoas" class="form-control" placeholder="Digite o número de pessoas"
                                    maxlength="30" value="<?php echo $rowReserva['numero_pessoa']; ?>">
                                <small>O titular da reserva tem direito a uma sobremesa GRÁTIS se o grupo tiver mais de
                                    5
                                    pessoas</small>
                                <br><br>

                                <label for="mesa_id">Mesas Disponiveis:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                    </span>
                                    <select name="mesa_id" id="mesa_id" class="form-control" required>
                                        <?php do{?>


                                        <option value="<?php echo $rowMesa ['id'];?>">
                                            <!-- buscar tipo -->
                                            <?php echo $rowMesa ['numero_mesa'];?>

                                        </option>
                                        <?php } while($rowMesa = $listaMesa->fetch_assoc());?>
                                    </select>
                                </div>
                                <label for="dataDisponivel">Datas Disponiveis:</label>
                                <input type="date" name="dataDisponivel" id="dataDisponivel" class="form-control" placeholder="Digite a data"
                                    maxlength="30" value="<?php echo $rowReserva['data_reserva']; ?>"><br><br>

                                <label for="HorariosDisponivel">Horários Disponiveis:</label>
                                <input type="time" name="HorariosDisponivel" id="HorariosDisponivel" class="form-control" placeholder="Digite a hora"
                                    maxlength="30" value="<?php echo $rowReserva['hora_reserva']; ?>">
                                <small>Horário de funcionamento das 17 ás 23</small>
                                <br><br>

                                <br>
                                <label for="especial">Precisa de algo especial? (opcional) </label>
                                <input type="text" name="especial" id="especial" class="form-control" placeholder="Digite se precisa de algo especial"
                                    maxlength="30" value="<?php echo $rowReserva['especificacoes_especiais']; ?>"><br><br>

                                    <label for="aceita">Aceita essa reserva? :</label>
                            <div class="input-group">
                                <label for="aceito" class="radio-inline">
                                    <input type="radio" name="reserva_aceita" id="reserva_aceita" value="1"
                                        <?php echo $rowReserva['ativa']=="1"?'checked':null; ?>>Aceito
                                </label>
                                <label for="recusado" class="radio-inline">
                                    <input type="radio" name="reserva_aceita" id="reserva_aceita" value="0"
                                        <?php echo $rowReserva['ativa']=="0"?'checked':null; ?>>Recusado
                                </label>
                                
                            </div>
                            <br>

                                <br>
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