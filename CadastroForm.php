<form action="Login.php" method="post">
    <h1>CADASTRO</h1>
    <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
    </div>

    <div>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>
    </div>

    <div>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </div>

    <div>
        <label for="confirmar_senha">Confirmar Senha:</label>
        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
    </div>

    <div class="enviar">
        <input type="submit" value="Enviar"></input>
    </div>
</form>