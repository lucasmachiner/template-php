<pre>
<?php

$banco = new mysqli("localhost:3307", "root", "", "gitcoffe");

// --------------------INSERIR NO BANCO DE DADOS--------------------------------------------

function insertInto(string $into, string $value, bool $debug = false): void
{ //  deligar debug
    global $banco;

    $q = "INSERT INTO $into VALUE $value";
    $resp = $banco->query($q);

    if ($debug) {
        echo "<br> Query: $q";
        echo "<br> Resp: " . var_dump($resp);
    }
}

// USUÀRIO
function cadastrarUsuario(string $cpf, string $nome, string $senha): void
{
    $senha = password_hash($senha, PASSWORD_DEFAULT); // Criptografia ;)
    insertInto("usuarios(cpf, nome, senha)", "('$cpf', '$nome', '$senha')");
}

// PRODUTO
function cadastrarProduto(string $name, string $description, $price, $image)
{
    insertInto("produtos(name, description, price, image)", "('$name', '$description', '$price', '$image')");
}

// --------------------DELETAR NO BANCO DE DADOS--------------------------------------------

function deleteFrom(string $from, string $where, bool $debug = true): void
{ // [BISU] deligar debug
    global $banco;

    $q = "DELETE FROM $from WHERE $where";
    $resp = $banco->query($q);

    if ($debug) {
        echo "<br> Query: $q";
        echo "<br> Resp: $resp";
    }
}

// USUÀRIO
function deletarUsuario($cpf)
{
    deleteFrom("usuarios", "cpf=$cpf");
}

// PRODUTO
function deletarProduto($id)
{
    deleteFrom("produtos", "id=$id");
}

// --------------------ALTERAR NO BANCO DE DADOS--------------------------------------------

function updateWhere(string $update, string $set, string $where, bool $debug = true): void
{ // [BISU] deligar debug
    global $banco;

    $q = "UPDATE $update SET $set WHERE $where";
    $resp = $banco->query($q);

    if ($debug) {
        echo "<br> Query: $q";
        echo "<br> Resp: $resp";
    }
}

// USUÀRIO
function alterarSenhaUsuario(string $cpf, string $novaSenha) // Altera a senha 
{
    global $banco;
    $senha = password_hash($novaSenha, PASSWORD_DEFAULT); // Criptografia

    $q = "UPDATE usuarios SET senha = ? WHERE cpf = ?";
    $stmt = $banco->prepare($q);
    $stmt->bind_param("ss", $senhaCriptografada, $cpf);
    $stmt->execute();
}
function alterarNomeUsuario($cpf, $novoNome) // Altera o nome 
{
    updateWhere("usuarios", "$novoNome", "cpf=$cpf");
}

// PRODUTO
function editarProduto($id, $name, $description, $price, $image, $target)
{
    if ($image) {
        updateWhere("produtos", "name='$name', description='$description', price='$price', image='$image'", "id=$id");
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        updateWhere("produtos", "name='$name', description='$description', price='$price'", "id=$id");
    }
}
?>
</pre>