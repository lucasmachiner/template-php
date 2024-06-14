<?php include('Banco.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Realizar Pedido</title>
</head>

<body>
    <h1>Realizar Pedido</h1>
    <?php
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM produtos WHERE id=$id");
    $row = $result->fetch_assoc();
    ?>
    <form action="Pedido.php?id=<?php echo $id; ?>" method="post">
        <p>Produto: <?php echo $row['name']; ?></p>
        <p>Preço: <?php echo $row['price']; ?></p>
        <label for="quantity">Quantidade:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1"><br><br>
        <input type="submit" name="submit" value="Confirmar Pedido">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $sql = "INSERT INTO orders (product_id, quantity) VALUES ('$id', '$quantity')";

        if ($conn->query($sql) === TRUE) {
            echo "Pedido realizado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>

</html>