<?php
include 'conn/connect.php';

$listaReserva = $conn->query("select * from reserva");
$rowReserva = $listaReserva->fetch_assoc();
$rowsTipos = $listaReserva->num_rows; 

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA DE RESERVAS |CHULETA</title>
</head>

<body>
    <?php include "menu_publico.php" ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger">Lista de Reservas</h2>
        <table class="table table-hover table-condensed tb-opacidade bg-warning">
            <thead>
                <th class="hidden">ID</th>
                <th>EMAIL</th>
                <th>CPF</th>
                <th>Nº pessoas</th>
                <th>Data da Reserva</th>
                <th>Horas da Reserva</th>
                <th>Especificações Especiais</th>
            </thead>
            <tbody>
                <?php do{?>
                <tr>
                    <td class="hidden">
                        <?php echo $rowReserva['id']; ?>
                    </td>
                    <td>
                        <?php echo $rowReserva['email'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>
                    <td>
                        <?php echo $rowReserva['cpf'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>
                    <td>
                        <?php echo $rowReserva['numero_pessoa'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>
                    <td>
                        <?php echo $rowReserva['data_reserva'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>
                    <td>
                        <?php echo $rowReserva['hora_reserva'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>
                    <td>
                        <?php echo $rowReserva['especificacoes_especiais'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>

                    <td>
                        <a href="reserva_cancela.php?id=<?php echo $rowReserva['id']; ?>" role="button"
                            class="btn btn-danger btn-block btn-xs" onclick="return confirmarCancelamento();">
                            <span class="glyphicon glyphicon-refresh"></span>
                            <span class="hidden-xs">Cancelar minha reserva</span>
                        </a>
                    </td>
                    </td>
                </tr>

                <?php }while($rowReserva = $listaReserva->fetch_assoc());?>
            </tbody>
    </main>
</body>
<script type="text/javascript">
function confirmarCancelamento() {
    // Exibe a caixa de confirmação
    var resposta = confirm("Você tem certeza que deseja cancelar sua reserva?");
    
    // Se o usuário clicar em "OK", retorna true e a navegação prossegue
    // Se o usuário clicar em "Cancelar", retorna false e a navegação é interrompida
    return resposta;
}
</script>

</html>