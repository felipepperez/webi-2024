<?php
session_start();
include_once("crud.php");
?>
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
        <h1>CRUD do Usuário</h1>
        <?php
        if (isset($_SESSION["error"])) {
            ?>
            <div class="card red lighten-2">
                <div class="card-content white-text">
                    <span class="card-title">Erro!</span>
                    <p><?= htmlspecialchars($_SESSION['error']); ?></p>
                </div>
            </div>
            <?php
            unset($_SESSION['error']);
        }
        ?>
        <form method="POST" action="<?= htmlspecialchars(dirname(($_SERVER['PHP_SELF']))) . '/crud.php' ?>">
            <?php
            $user = false;
            if (isset($_GET['edit'])) {
                $id = $_GET['edit'];
                try {
                    $stmt = $conn->prepare("SELECT * FROM user WHERE id=?");
                    $stmt->bind_param('i', $id);

                    $stmt->execute();

                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();

                    $stmt->close();

                    if (!$user) {
                        $_SESSION['error'] = "Usuário não existe!";

                        header("Location: " . htmlspecialchars(dirname(($_SERVER['PHP_SELF']))) . '/index.php');
                    }
                } catch (\Throwable $th) {
                    $_SESSION['error'] = $th->getMessage();

                    header("Location: " . htmlspecialchars(dirname(($_SERVER['PHP_SELF']))) . '/index.php');
                }
            }
            ?>
            <div class="input-field <?= $user ? "" : "hide" ?>" id="div-id">
                <label for="id">ID</label>
                <input type="text" name="id" id="id" value="<?= $user ? $user['id'] : "" ?>" readonly>
            </div>
            <div class="input-field">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" value="<?= $user ? $user['name'] : "" ?>" required>
            </div>
            <div class="input-field">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?= $user ? $user['email'] : "" ?>" required>
            </div>
            <div class="input-field">
                <label for="phone">Telefone</label>
                <input type="text" name="phone" id="phone" value="<?= $user ? $user['phone'] : "" ?>" required>
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
                $result = $conn->query("SELECT * FROM user");
                while ($user = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $user["id"] ?></td>
                        <td><?= $user["name"] ?></td>
                        <td><?= $user["email"] ?></td>
                        <td><?= $user["phone"] ?></td>
                        <td>
                            <a class="btn-small"
                                href="<?= htmlspecialchars(dirname(($_SERVER['PHP_SELF']))) . '/index.php' ?>?edit=<?= $user["id"] ?>">Editar</a>
                            <a class="btn-small red"
                                href="<?= htmlspecialchars(dirname(($_SERVER['PHP_SELF']))) . '/crud.php' ?>?delete=<?= $user["id"] ?>">Deletar</a>
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