<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/cabecalho.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
</head>

<body>
    <img class="fundo" src="imagens/fundo.jpg" alt="">
    <section>
        <img src="imagens/LOGOTIPO.png" alt="">
        <h1>LOGIN</h1>

        <?php

        session_start();

        require_once "Banco.php";

        //require_once "Header.php";

        if (isset($_SESSION['nome'])) {
            header("Location: Home.php");
            exit;
        }

        require_once "LoginForm.php";
        if (isset($_POST['nome']) && isset($_POST['senha'])) {
            $nome = $_POST['nome'];
            $senha = $_POST['senha'];

            $stmt = $banco->prepare("SELECT cpf, nome, senha FROM usuarios WHERE nome=?");
            $stmt->bind_param("s", $nome);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows > 0) {
                $obj_usuario = $resultado->fetch_object();

                if (password_verify($senha, $obj_usuario->senha)) {
                    $_SESSION['nome'] = $obj_usuario->nome;
                    $_SESSION['cpf'] = $obj_usuario->cpf;

                    header("Location: Home.php");
                    exit;
                } else echo "Senha incorreta.";
            } else echo "Usuário não encontrado.";
            $stmt->close();
        }
        ?>
    </section>
</body>

</html>