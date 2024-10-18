<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1> CRUD do Usuário</h1>
        <form method="POST" action="crud.php">
            <div class="input-field">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div class="input-field">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="input-field">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" required>
            </div>
            <button type="submit" class="btn">Salvar</button>
        </form>
        <table class="striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("crud.php");
                $result = $conn->query("SELECT * FROM user");
                while ($user = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $user["id"] ?></td>
                        <td><?= $user["name"] ?></td>
                        <td><?= $user["email"] ?></td>
                        <td><?= $user["phone"] ?></td>
                        <td>
                            <a class="btn-small">Editar</a>
                            <a class="btn-small red">Deletar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>