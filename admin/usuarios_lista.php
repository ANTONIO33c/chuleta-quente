<?php
include 'acesso_com.php';
include '../conn/connect.php';

$listaUsuarios = $conn->query("select * from usuarios");
$rowUsuario = $listaUsuarios->fetch_assoc();
$rowsUsuarios = $listaUsuarios->num_rows; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>LISTA USUÁRIOS | CHULETA</title>
</head>

<body>
    <?php include 'menu_adm.php'; ?>
    <main class="container">
        <h2 class="breadcrumb alert-danger">Lista de Usuários</h2>
        <table class="table table-hover table-condensed tb-opacidade bg-warning">
            <thead>
                <th class="hidden">ID</th>
                <th>LOGIN</th>
                <th class="hidden">SENHA</th>
                <th>NIVEL</th>
                <th>
                    <a href="usuarios_insere.php" target="_self" class="btn btn-primary btn-xs" role="button">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        <span class="hidden-xs">ADICIONAR</span>
                    </a>
                </th>
            </thead>
            <tbody>
                <?php do{?>
                <tr>
                    <td class="hidden">
                        <?php echo $rowUsuario['id']; ?>
                    </td>
                    <td>
                        <?php echo $rowUsuario['login'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>
                    <td>
                        <?php echo $rowUsuario['nivel'];?>
                        <span class="visible-xs"></span>
                        <span class="hidden-xs"></span>
                    </td>
                    <td>
                        <a href="usuarios_atualiza.php?id=<?php echo $rowUsuario['id'] ?>" role="button"
                            class="btn btn-warning  btn-xs">
                            <span class="glyphicon glyphicon-refresh"></span>
                            <span class="hidden-xs">Alterar</span>
                        </a>
                        <?php  
                        $regra = $conn->query("select nivel from usuarios where id =".$rowUsuario['id']);
                        $regraRow = $regra->fetch_assoc();
                        ?>
                        <button data-nome="<?php echo $rowUsuario['login']; ?>"
                            data-id="<?php echo $rowUsuario['id']; ?>" class="delete btn btn-xs  btn-danger
                        <?php echo $regraRow['nivel'] == 'com'?'':'hidden' ?>">
                            <span class="glyphicon glyphicon-trash"></span>
                            <span class="hidden-xs">Excluir</span>
                        </button>

                    </td>
                </tr>
                <?php }while($rowUsuario = $listaUsuarios->fetch_assoc());?>
            </tbody>
        </table>
    </main>
    <div class="modal fade" id="modalEdit" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Vamos deletar?</h4>
                    <button class="close" data-dismiss="modal" type="button">
                        &times;

                    </button>
                </div>
                <div class="modal-body">
                    Deseja mesmo o usuário?
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
    var nomeUsuario = $(this).data('nome'); //busca o nome com a descrição (data-nome)
    var idUsuario = $(this).data('id'); // busca o id (data-id)
    //console.log(id + ' - ' + nome); //exibe no console
    $('span.nome').text(nomeUsuario); // insere o nome do item na confirmação
    $('a.delete-yes').attr('href', 'produtos_excluir.php?id=' +
    idUsuario); //chama o arquivo php para excluir o produto
    $('#modalEdit').modal('show'); // chamar o modal
});
</script>

</html>