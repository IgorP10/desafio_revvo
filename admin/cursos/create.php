<?php
// Caminho: admin/cursos/create.php

require_once '../../includes/sqlite.php'; // Ajuste o caminho conforme sua estrutura

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém dados do formulário
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $nomeImagem = '';

    // Verifica se foi feito upload de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $nomeImagem = $_FILES['imagem']['name'];
        // Caminho de destino para a imagem
        $destino = __DIR__ . '/../../assets/images/' . $nomeImagem;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);
    }

    // Insere no banco de dados (tabela cursos)
    try {
        $stmt = $conn->prepare("
            INSERT INTO cursos (nome, descricao, imagem)
            VALUES (:nome, :descricao, :imagem)
        ");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':imagem', $nomeImagem);
        $stmt->execute();

        $mensagem = "Curso adicionado com sucesso!";
    } catch (PDOException $e) {
        $erro = "Erro ao adicionar curso: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Novo Curso</title>
    <!-- Reaproveitando o mesmo CSS do index.php -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <div class="wrapper">

        <!-- HEADER (mesmo do index.php) -->
        <header class="header">
            <div class="header-container">
                <div class="logo">
                    <a href="../../index.php">
                        <img src="../../assets/images/logo-leo.png" alt="Logo LEO">
                    </a>
                </div>
                <div class="user-info">
                    <!-- Avatar circular -->
                    <img src="../../assets/images/profile.jpg" alt="Avatar" class="profile-pic">
                    <span class="user-name">Igor Pereira</span>
                    <span class="dropdown-arrow">▼</span>
                </div>
            </div>
        </header>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="main-content form-page">
            <h2>Adicionar Novo Curso</h2>

            <!-- Se houver mensagem de sucesso ou erro, exiba -->
            <?php if (isset($mensagem)): ?>
                <div class="alert success"><?php echo $mensagem; ?></div>
            <?php endif; ?>
            <?php if (isset($erro)): ?>
                <div class="alert error"><?php echo $erro; ?></div>
            <?php endif; ?>

            <!-- FORMULÁRIO CENTRALIZADO -->
            <div class="form-container">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome do Curso <span class="required">*</span></label>
                        <input type="text" id="nome" name="nome" required>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" rows="4"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Imagem do Curso</label>
                        <input type="file" id="imagem" name="imagem">
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <a href="/../../index.php" class="btn btn-secondary">Voltar</a>
                    </div>
                </form>
            </div>
        </main>

        <!-- FOOTER (mesmo do index.php) -->
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

    </div> <!-- .wrapper -->
</body>

</html>