<?php
include 'acesso_com.php';
include '../conn/connect.php';
if($_POST){
    if($_FILES['imagemfile']['name']){
        unlink("../images/".$_POST['imagem_atual']); // apaga a imagem atual
        $nome_img = $_FILES['imagefile']['name'];
        $tmp_img = $_FILES['imagem']['tmp_name'];
        $rand = rand(100001,999999);
        $dir_img = "../images/".$rand.$nome_img;
        move_uploaded_file($tmp_img, $dir_img);
        $nome_img =  $randi.$nome_img; 
    } else {
        $nome_img = $POST['imagem_atual'];
    }
    $id = $_POST['id'];
    
    $id_tipo = $_POST['id_tipo'];
    $destaque = $_POST['destaque'];
    $descricao = $_POST['descricao'];
    $resumo = $_POST['resumo'];
    $valor = $_POST['valor'];

    $update  = "update 
    set tipo_id = $id_tipo,
    destaque = '$destaque,'
    descricao = '$descricao',
    resumo = '$resumo',
    valor = $valor,
    imagem = '$nome_img'
    where id = $id;";
    $resultado = $conn->query($update); 
    if($resultado){
        header('location:produtos_lista.php');
    }
}
if($_GET){
    $id_form = $_GET['id'];
}else{
    $id_form = 0;
}
$lista = $conn->query('select * from produtos where id = $id_form');
// selecionar a lista de tipo para preencher <select>
$ListaTipo = $conn->query("select * from tipos order by rotulo"); 
$rowTipos = $ListaTipo->fetch_assoc();
$numLinhas = $ListaTipo->num_rows;
 
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Produto - Insere</title>
</head>

<body>
    <?php include "menu_adm.php";?>
    <main class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-6  col-md-8">
                <h2 class="breadcrumb text-danger">
                    <a href="produtos_lista.php">
                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>
                    </a>
                    Inserindo Produtos
                </h2>
                <div class="thumbnail">
                    <div class="alert alert-danger" role="alert">
                        <form action="produtos_atualiza.php" method="post" name="form_insere"
                            enctype="multipart/form-data" id="form_insere">

                            <input type="hidden" name="id" id="id" value="">

                            <label for="id_tipo">Tipo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
                                </span>
                                <select name="id_tipo" id="id_tipo" class="form-control" required>
                                    <option value="tipo">

                                    </option>

                                </select>
                            </div>
                            <label for="destaque">Destaque:</label>
                            <div class="input-group">
                                <label for="destaque_s" class="radio-inline">
                                    <input type="radio" name="destaque" id="destaque" value="Sim" <?php  ?>>Sim
                                </label>
                                <label for="destaque_n" class="radio-inline">
                                    <input type="radio" name="destaque" id="destaque" value="Não" <?php  ?>>Não
                                </label>
                            </div>
                            <label for="descri">Descrição:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="descricao" id="descricao" class="form-control"
                                    placeholder="Digite a descrição do Produto" maxlength="100" value="<?php  ?>">
                            </div>

                            <label for="resumo">Resumo:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                                </span>
                                <textarea name="resumo" id="resumo" cols="30" rows="8" class="form-control"
                                    placeholder="Digite os detalhes do Produto"></textarea>
                            </div>

                            <label for="valor">Valor:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                                </span>
                                <input type="number" name="valor" id="valor" class="form-control" required min="0"
                                    step="0.01" value="<?php ?>">
                            </div>

                            <label for="imagem_atual">Imagem Atual:</label>
                            <img src="../images/<?php  ?>" alt="" srcset="">
                            <input type="hidden" name="imagem_atual" id="imagem_atual" value="<?php  ?>">

                            <label for="imagem">Imagem Nova:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
                                </span>
                                <img src="" name="imagem" id="imagem" class="img-responsive">
                                <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
                            </div>

                            <br>
                            <input type="submit" name="atualizar" id="atualizar" class="btn btn-danger btn-block"
                                value="Atualizar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script para imagem -->
    <script>
    document.getElementById("imagem").onchange = function() {
        var reader = new FileReader();
        if (this.files[0].size > 512000) {
            alert("A imagem deve ter no máximo 500KB");
            $("#imagem").attr("src", "blank");
            $("#imagem").hide();
            $("#imagem").wrap('<form>').closest('form').get(0).reset();
            $("#imagem").unwrap();
            return false
        }
        if (this.files[0].type.indexOf("image") == -1) {
            alert("formato inválido, escolha uma imagem!");
            $("#imagem").attr("src", "blank");
            $("#imagem").hide();
            $("#imagem").wrap('<form>').closest('form').get(0).reset();
            $("#imagem").unwrap();
            return false
        }
        reader.onload = function(e) {
            document.getElementById("imagem").src = e.target.result
            $("#imagem").show();
        }
        reader.readAsDataURL(this.files[0])
    }
    </script>

</body>

</html>