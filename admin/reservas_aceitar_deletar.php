<?php
include 'acesso_com.php';
include '../conn/connect.php';


if($_POST){
    $id = $_POST['id'];
    $ReservaEmail = $_POST['email']; 
    $cpf = $_POST['cpf'];
    $NumeroPessoas = $_POST['numeroPessoas']; 
    $mesaDisponivel = $_POST['mesa'];
    $dataReserva = $_POST['dataDisponivel'];
    $email = $_POST['email'];

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
  $ativa = $_POST['ativa'];
  $ReservaAceita = $_POST['reserva_aceita'];

  $updateReserva = "update reserva
  set mesa = '$mesaDisponivel',
  reserva_aceita = 1,
  ativa = 1
  where id = $id;";
  $resultado = $conn->query($updateReserva);
    
    if($resultado){
        header("location:envio_email_formulario.php?id=$id");
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

                <div class="alert alert-danger" role="alert">
                    <form action="reservas_aceitar_deletar.php" method="POST" name="form_insere" enctype="multipart/form-data"
                        id="form_insere">
                        <input type="hidden" name="id" id="id" value="<?php echo $rowReserva['id'];?>">

                        <label for="descri">EMAIL:</label>
                        <div class="input-group">

                            <input type="text" name="email" id="email" class="form-control" placeholder="Digite o email"
                                maxlength="30" value="<?php echo $rowReserva['email']; ?>">

                            <label for="cpf">cpf : </label>
                            <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Digite o cpf"
                                maxlength="30" value="<?php echo $rowReserva['cpf']; ?>"><br><br>

                            <label for="numeroPessoas">Numero de pessoas : </label>
                            <input type="number" name="numeroPessoas" id="numeroPessoas" class="form-control"
                                placeholder="Digite o número de pessoas" maxlength="30"
                                value="<?php echo $rowReserva['numero_pessoa']; ?>">
                            <small>O titular da reserva tem direito a uma sobremesa GRÁTIS se o grupo tiver mais de
                                5
                                pessoas</small>
                            <br><br>

                            <label for="mesa">Mesas Disponiveis:</label>
                            <input type="text" name="mesa" id="mesa" class="form-control"
                                placeholder="Digite a mesa que estiver disponivel" maxlength="30"
                                ><br><br>

                        </div>
                        <label for="dataDisponivel">Datas Disponiveis:</label>
                        <input type="date" name="dataDisponivel" id="dataDisponivel" class="form-control"
                            placeholder="Digite a data" maxlength="30"
                            value="<?php echo $rowReserva['data_reserva']; ?>"><br><br>

                        <label for="HorariosDisponivel">Horários Disponiveis:</label>
                        <input type="time" name="HorariosDisponivel" id="HorariosDisponivel" class="form-control"
                            placeholder="Digite a hora" maxlength="30"
                            value="<?php echo $rowReserva['hora_reserva']; ?>">
                        <small>Horário de funcionamento das 17 ás 23</small>
                        <br><br>

                        <br>
                        <label for="especial">Precisa de algo especial? (opcional) </label>
                        <input type="text" name="especial" id="especial" class="form-control"
                            placeholder="Digite se precisa de algo especial" maxlength="30"
                            value="<?php echo $rowReserva['especificacoes_especiais']; ?>"><br><br>

                        <input type="hidden" name="ativa" id="ativa" value="">
                        <input type="hidden" name="email" id="email" value="<?= $rowReserva['email'] ?>">
                        <br>
                        <input type="submit" name="atualizar" id="atualizar" class="btn btn-success btn-block btn-sm"
                                value="Confirmar Reserva">
                        <br>
                        <a href="reservas_canceladas.php?id=<?php echo $rowReserva['id']; ?>?email=<?= $rowReserva['email'] ?>" role="button"
                            class="btn btn-danger btn-block btn-sm" onclick="return confirmarCancelamento();">
                            <span class="glyphicon"></span>
                            <span class="hidden-xs">Cancelar Reserva</span>
                        </a>

                </div>
                </form>
            </div>
        </div>
        </div>
    </main>
</body>
<script type="text/javascript">
function confirmarCancelamento() {
    // Exibe a caixa de confirmação
    var resposta = confirm("Você tem certeza que deseja cancelar essa reserva?");

    // Se o usuário clicar em "OK", retorna true e a navegação prossegue
    // Se o usuário clicar em "Cancelar", retorna false e a navegação é interrompida
    return resposta;
}
function confirmarAceitar()
{
    var respostaConsulta = confirm("Reserva vai ser aceita, OK?");
    return respostaConsulta
}
</script>


</html>