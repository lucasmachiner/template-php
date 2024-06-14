<?php include('../Banco.php'); ?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/AddProduto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <title>Adicionar Produto</title>
</head>

<body>

    <section>
        <img src="../imagens/LOGOTIPO.png" alt="">
        <h1>Adicionar Produto</h1>
        <form action="AddProduto.php" method="post" enctype="multipart/form-data">
            <input type="text" id="name" placeholder="Nome" name="name"><br><br>
            <textarea id="description" placeholder="Descrição" name="description"></textarea><br><br>
            <input type="text" id="price" placeholder="Preço" name="price"><br><br>
            <input type="file" id="image" name="image" style="display: none;">
            <button type="button" onclick="document.getElementById('image').click();">Escolher Imagem <svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path fill="#640202"
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z" />
                </svg></button><br><br>
            <input type="submit" name="submit" value="Adicionar">
        </form>
    </section>

    <?php

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $target = "../imagens/" . basename($image);

        require "../Banco.php";

        if (cadastrarProduto($name, $description, $price, $image)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                echo "Produto adicionado com sucesso";
            } else {
                echo "Erro ao subir a imagem";
            }
        } else {
            echo "Erro: " . $q . "<br>" . $banco->error;
        }
    }
    ?>
</body>

</html>