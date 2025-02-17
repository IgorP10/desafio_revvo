<?php
require_once 'includes/sqlite.php';

// Consulta slides
$slideshowQuery = "SELECT * FROM slideshow ORDER BY id DESC";
$stmtSlides = $conn->query($slideshowQuery);
$slides = $stmtSlides->fetchAll(PDO::FETCH_ASSOC);

// Consulta cursos
$cursosQuery = "SELECT * FROM cursos ORDER BY id DESC";
$stmtCursos = $conn->query($cursosQuery);
$cursos = $stmtCursos->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>LEO - Página Inicial</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="wrapper">

        <!-- HEADER -->
        <header class="header">
            <div class="header-container">
                <!-- LOGO -->
                <div class="logo">
                    <img src="assets/images/logo-leo.png" alt="Logo LEO">
                </div>

                <!-- SEARCH BAR -->
                <div class="search-bar">
                    <input type="text" placeholder="Pesquisar cursos...">
                </div>

                <!-- USER INFO -->
                <div class="user-info">
                    <!-- Avatar circular -->
                    <img src="assets/images/profile.jpg" alt="Avatar" class="profile-pic">
                    <span class="user-name">Igor Pereira</span>
                    <span class="dropdown-arrow">▼</span>
                </div>
            </div>
        </header>


        <!-- SLIDESHOW -->
        <section class="slideshow">
            <div class="slideshow-container">
                <!-- Exemplo: se houver slides -->
                <?php if (count($slides) > 0): ?>
                    <?php foreach ($slides as $index => $slide): ?>
                        <div class="slide">
                            <img src="assets/images/<?php echo $slide['imagem']; ?>" alt="<?php echo $slide['titulo']; ?>">
                            <div class="slide-info">
                                <h2><?php echo $slide['titulo']; ?></h2>
                                <p><?php echo $slide['descricao']; ?></p>
                                <?php if (!empty($slide['link'])): ?>
                                    <a href="<?php echo $slide['link']; ?>" class="btn-slide">Saiba Mais</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Botões de navegação -->
                    <a class="prev">&#10094;</a>
                    <a class="next">&#10095;</a>

                <?php else: ?>
                    <p>Nenhum slide cadastrado</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- SEÇÃO DE CURSOS -->
        <main class="main-content">
            <h2>Meus Cursos</h2>
            <div class="courses-grid">
                <?php if (count($cursos) > 0): ?>
                    <!-- Percorre todos os cursos -->
                    <?php foreach ($cursos as $curso): ?>
                        <div class="course-card">
                            <?php if (!empty($curso['imagem'])): ?>
                                <img src="assets/images/<?php echo $curso['imagem']; ?>" alt="<?php echo $curso['nome']; ?>">
                            <?php else: ?>
                                <img src="assets/images/placeholder.png" alt="Curso sem imagem">
                            <?php endif; ?>

                            <h3><?php echo $curso['nome']; ?></h3>
                            <p><?php echo $curso['descricao']; ?></p>
                            <a href="admin/cursos/view.php?id=<?php echo $curso['id']; ?>" class="btn-curso">Ver Curso</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhum curso disponível no momento.</p>
                <?php endif; ?>

                <!-- Card para Adicionar Novo Curso -->
                <a href="admin/cursos/create.php" class="course-card add-course-card">
                    <span>Adicionar Curso</span>
                </a>
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="footer-content">
                <div class="logo-footer">
                    <img src="assets/images/logo-leo.png" alt="Logo LEO">
                    <p>&copy; 2017 LEO. Todos os direitos reservados.</p>
                </div>
                <div class="contact-info">
                    <p><strong>Contato</strong><br>
                        (51) 5555-3333<br>
                        contato@leo.com.br
                    </p>
                </div>
                <div class="social-media">
                    <p><strong>Redes Sociais</strong></p>
                    <img src="assets/images/icones-redes-sociais.png" alt="Redes Sociais">
                </div>
            </div>
        </footer>

        <!-- MODAL (exibido apenas no primeiro acesso) -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span id="modal-close" class="close">&times;</span>
                <h2>EGESTAS TORTOR VULPUTATE</h2>
                <p>
                    Aenean non diam. Pellentesque eu eros sem lorem luctus ornare
                    volutpat volutpat. Donec ullamcorper nunc a malesuada fringilla.
                    Donec vitae odio. Cras hendrerit sem.
                </p>
                <a href="#" class="btn-inscreva">Inscreva-se</a>
            </div>
        </div>

    </div> <!-- .wrapper -->
    <script src="assets/js/script.js"></script>
</body>

</html>