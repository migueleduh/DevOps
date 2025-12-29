<?php
include 'db.php';

// --- LÓGICA DO CRUD ---

// CREATE
if (isset($_POST['add'])) {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $data_admissao = $_POST['data_admissao'];
    $stmt = $conn->prepare("INSERT INTO funcionarios (nome, cargo, email, data_admissao) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $cargo, $email, $data_admissao);
    $stmt->execute();
    header("Location: index.php");
}

// DELETE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM funcionarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: index.php");
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $email = $_POST['email'];
    $data_admissao = $_POST['data_admissao'];
    $stmt = $conn->prepare("UPDATE funcionarios SET nome=?, cargo=?, email=?, data_admissao=? WHERE id=?");
    $stmt->bind_param("ssssi", $nome, $cargo, $email, $data_admissao, $id);
    $stmt->execute();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Funcionários - InovaTech Solutions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
      <div class="logo">
        <img src="logo2.jpg" alt="Logo InovaTech Solutions">
     </div>
    </header>

	<h1>Gestão de Funcionários - InovaTech Solutions</h1>


    <div class="container">
        <?php if (isset($_GET['edit'])): ?>
            <?php
                $id = $_GET['edit'];
                $result = $conn->query("SELECT * FROM funcionarios WHERE id=$id");
                $row = $result->fetch_assoc();
            ?>
            <h2>Editar Funcionário</h2>
            <form action="index.php" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="text" name="nome" value="<?= $row['nome'] ?>" placeholder="Nome" required>
                <input type="text" name="cargo" value="<?= $row['cargo'] ?>" placeholder="Cargo" required>
                <input type="email" name="email" value="<?= $row['email'] ?>" placeholder="E-mail" required>
                <input type="date" name="data_admissao" value="<?= $row['data_admissao'] ?>" required>
                <button type="submit" name="update">Atualizar</button>
            </form>
        <?php else: ?>
            <h2>Adicionar Novo Funcionário</h2>
            <form action="index.php" method="post">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="cargo" placeholder="Cargo" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="date" name="data_admissao" required>
                <button type="submit" name="add">Adicionar</button>
            </form>
        <?php endif; ?>

        <h2>Lista de Funcionários</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>E-mail</th>
                    <th>Data de Admissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM funcionarios");
                while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nome'] ?></td>
                    <td><?= $row['cargo'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= date("d/m/Y", strtotime($row['data_admissao'])) ?></td>
                    <td>
                        <a href="index.php?edit=<?= $row['id'] ?>" class="btn-edit">Editar</a>
                        <a href="index.php?delete=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Tem certeza?');">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
