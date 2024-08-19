<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css -->
    <link rel="stylesheet" href="css/estilo.css">
    <!-- link bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Cowabunga Pizzaria</title>
</head>

<body class="fundofixo">
    <!-- area de menu -->
    <?php  include 'menu_publico.php'; ?>

    <a name="home">&nbsp;</a>
    <main class="container">
        <!-- area de carousel -->
        <?php include 'carousel.php';?>
        <!-- area de destaque -->
        <a class="pt-6" name="destaques">&nbsp;</a>
        <?php include 'produtos_destaque.php';?>
        <!-- area de geral de produto -->
        <a class="pt-6" name="produtos">&nbsp;</a>
        <?php include 'produtos_geral.php';?>
        <!-- rodapé -->
        <footer class="panel-footer" style="background: none;">
            <?php include 'rodape.php';?>
            <a name="contato"></a>
        </footer>
    </main>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<!-- arrow function -->
<script type="text/javascript">
$(document).on('ready', function() {
    $(".regular").slick({
        dots: true,
        infinity: true,
        slidesToShow: 3,
        slidesToScroll: 3
    });
 
});
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/ntm/slick.min.js"></script>

</html>