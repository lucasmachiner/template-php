<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/EditarProduto.css">
    <link rel="stylesheet" href="../css/cabecalho.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <title>Editar Produto</title>
</head>

<body>

    <?php
    //require_once "../Header.php"; [BISU]
    ?>

    <h1>Editar Produto</h1>
    <?php
    require_once "..\Banco.php";
    $id = $_GET['id'];
    $q = $banco->query("SELECT * FROM produtos WHERE id=$id");
    $row = $q->fetch_assoc();
    ?>
    <div class="EditProd">
        <form action="EditarProduto.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br><br>
            <label for="description">Descrição:</label>
            <textarea id="description" name="description"><?php echo $row['description']; ?></textarea><br><br>
            <label for="price">Preço:</label>
            <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>"><br><br>
            <label for="image">Imagem:</label>
            <input type="file" id="image" name="image"><br><br>
            <input type="submit" name="submit" value="Salvar">
        </form>
    </div>

    <form action="Adm.php">
        <input type="submit" value="Voltar">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $target = "../imagens/" . basename($image);

        if (editarProduto($id, $name, $description, $price, $image, $target)) {
            echo "Produto atualizado com sucesso";
        } else {
            echo "Erro: " . $banco->error;
        }
    }
    // required_once "Footer.php";
    ?>
</body>

</html>