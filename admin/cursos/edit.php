<?php

require_once '../../includes/sqlite.php';

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM cursos WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$curso = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$curso) {
    echo "Curso não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $nomeImagem = $curso['imagem'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $nomeImagem = $_FILES['imagem']['name'];
        $destino = __DIR__ . '/../../assets/images/' . $nomeImagem;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);
    }

    try {
        $updateStmt = $conn->prepare("
            UPDATE cursos
            SET nome = :nome,
                descricao = :descricao,
                imagem = :imagem
            WHERE id = :id
        ");
        $updateStmt->bindValue(':nome', $nome);
        $updateStmt->bindValue(':descricao', $descricao);
        $updateStmt->bindValue(':imagem', $nomeImagem);
        $updateStmt->bindValue(':id', $id, PDO::PARAM_INT);
        $updateStmt->execute();

        $mensagem = "Curso atualizado com sucesso!";
        $curso['nome'] = $nome;
        $curso['descricao'] = $descricao;
        $curso['imagem'] = $nomeImagem;

    } catch (PDOException $e) {
        $erro = "Erro ao atualizar curso: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Curso</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <div class="wrapper">

        <header class="header">
            <div class="header-container">
                <div class="logo">
                    <a href="../../index.php">
                        <img src="../../assets/images/logo-leo.png" alt="Logo LEO">
                    </a>
                </div>
                <div class="user-info">
                    <img src="../../assets/images/profile.jpg" alt="Avatar" class="profile-pic">
                    <span class="user-name">Igor Pereira</span>
                    <span class="dropdown-arrow">▼</span>
                </div>
            </div>
        </header>

        <main class="main-content form-page">
            <h2>Editar Curso</h2>

            <?php if (isset($mensagem)): ?>
                <div class="alert success"><?php echo $mensagem; ?></div>
            <?php endif; ?>
            <?php if (isset($erro)): ?>
                <div class="alert error"><?php echo $erro; ?></div>
            <?php endif; ?>

            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome do Curso:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($curso['nome']); ?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" rows="4"><?php
                        echo htmlspecialchars($curso['descricao']);
                        ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Nova Imagem (opcional):</label>
                        <input type="file" id="imagem" name="imagem">
                        <?php if (!empty($curso['imagem'])): ?>
                            <p>Imagem atual:</p>
                            <img src="../../assets/images/<?php echo $curso['imagem']; ?>"
                                alt="<?php echo $curso['nome']; ?>" style="max-width: 200px;">
                        <?php endif; ?>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="view.php?id=<?php echo $curso['id']; ?>" class="btn btn-secondary">Voltar</a>
                    </div>
                </form>
            </div>
        </main>

        <footer class="footer">
            <div class="footer-content">
                <div class="logo-footer">
                    <img src="../../assets/images/logo-leo.png" alt="Logo LEO">
                    <p>&copy; 2017 LEO.<br>Todos os direitos reservados.</p>
                </div>
                <div class="contact-info">
                    <p><strong>Contato</strong><br>
                        (51) 5555-3333<br>
                        contato@leo.com.br
                    </p>
                </div>
                <div class="social-media">
                    <p><strong>Redes Sociais</strong></p>
                    <img src="../../assets/images/icones-redes-sociais.png" alt="Redes Sociais">
                </div>
            </div>
        </footer>

    </div>
</body>

</html>