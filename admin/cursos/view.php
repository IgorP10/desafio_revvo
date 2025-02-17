<?php
// Caminho: admin/cursos/view.php

require_once '../../includes/sqlite.php'; // Ajuste o caminho se necessário

// 1. Pega o ID do curso via GET
$id = $_GET['id'] ?? 0;

// 2. Busca o curso no banco de dados
$stmt = $conn->prepare("SELECT * FROM cursos WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$curso = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. Se não encontrar, exibe mensagem de erro
if (!$curso) {
    echo "Curso não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Visualizar Curso</title>
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
            <h2>Detalhes do Curso</h2>

            <div class="form-container">
                <div class="form-group">
                    <label>Nome do Curso:</label>
                    <p><?php echo htmlspecialchars($curso['nome']); ?></p>
                </div>

                <div class="form-group">
                    <label>Imagem:</label>
                    <?php if (!empty($curso['imagem'])): ?>
                        <img src="../../assets/images/<?php echo $curso['imagem']; ?>"
                            alt="<?php echo htmlspecialchars($curso['nome']); ?>" style="max-width: 300px;">
                    <?php else: ?>
                        <img src="../../assets/images/placeholder.png" alt="Curso sem imagem" style="max-width: 300px;">
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Descrição:</label>
                    <p><?php echo nl2br(htmlspecialchars($curso['descricao'])); ?></p>
                </div>

                <div class="button-group">
                    <a href="edit.php?id=<?php echo $curso['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="../../index.php" class="btn btn-secondary">Voltar</a>
                    <a href="delete.php?id=<?php echo $curso['id']; ?>" class="btn btn-danger"
                        onclick="return confirm('Deseja realmente excluir este curso?')">
                        Deletar
                    </a>
                </div>

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