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
                        <a href="reservas_aceitas.php?id=<?php echo $rowReserva['id'] ?>" role="button"
                            class="btn btn-success btn-block btn-xs">
                            <span class="glyphicon glyphicon-refresh"></span>
                            <span class="hidden-xs">Aceitar Reserva</span>
                        </a>
                    </td>
                    <td>
                        <button data-nome="<?php echo $rowReserva['email']; ?>"
                            data-id="<?php echo $rowReserva['id']; ?>" class="delete btn btn-xs  btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                            <span class="">Cancelar Reserva</span>
                        </button>
                    </td>
                    </td>
                </tr>

                <?php }while($rowReserva = $listaReserva->fetch_assoc());?>
            </tbody>
    </main>
    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>DESEJA CANCELAR ESSA RESERVA?</h4>
                    <button class="close" data-dismiss="modal" type="button">
                        &times;

                    </button>
                </div>
                <div class="modal-body">
                    Deseja mesmo cancelar?
                    <h4><span class="nome text-danger"></span></h4>
                </div>
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">
                        Confirmar
                    </a>
                    <button class="btn btn-success" data-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
$('.delete').on('click', function() {
    var ReservaRotulo = $(this).data('nome'); //busca o nome com a descrição (data-nome)
    var ReservaId = $(this).data('id'); // busca o id (data-id)
    //console.log(id + ' - ' + nome); //exibe no console
    $('span.nome').text(ReservaRotulo); // insere o nome do item na confirmação
    $('a.delete-yes').attr('href', 'produtos_excluir.php?id=' +
    ReservaId); //chama o arquivo php para excluir o produto
    $('#modalEdit').modal('show'); // chamar o modal
});
</script>

</html>