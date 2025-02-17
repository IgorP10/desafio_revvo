<?php
$dbFile = __DIR__ . '/database.sqlite';

try {
    $conn = new PDO("sqlite:" . $dbFile);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("
        CREATE TABLE IF NOT EXISTS cursos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            descricao TEXT,
            imagem TEXT
        );
        
        CREATE TABLE IF NOT EXISTS slideshow (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            titulo TEXT NOT NULL,
            descricao TEXT,
            link TEXT,
            imagem TEXT
        );
    ");

    $stmtCursos = $conn->query("SELECT COUNT(*) as count FROM cursos");
    $rowCursos = $stmtCursos->fetch(PDO::FETCH_ASSOC);
    if ($rowCursos['count'] == 0) {
        $conn->exec("INSERT INTO cursos (nome, descricao, imagem) VALUES 
            ('Curso 1', 'Descrição do curso 1', 'curso.jpg');");
        $conn->exec("INSERT INTO cursos (nome, descricao, imagem) VALUES 
            ('Curso 2', 'Descrição do curso 2', 'curso.jpg');");
        $conn->exec("INSERT INTO cursos (nome, descricao, imagem) VALUES 
            ('Curso 3', 'Descrição do curso 3', 'curso.jpg');");
    }

    $stmtSlides = $conn->query("SELECT COUNT(*) as count FROM slideshow");
    $rowSlides = $stmtSlides->fetch(PDO::FETCH_ASSOC);
    if ($rowSlides['count'] == 0) {
        $conn->exec("INSERT INTO slideshow (titulo, descricao, link, imagem) VALUES 
            ('Slide 1', 'Descrição do slide 1', 'http://localhost:8080/admin/cursos/view.php?id=1', 'slide1.jpg');");
        $conn->exec("INSERT INTO slideshow (titulo, descricao, link, imagem) VALUES 
            ('Slide 2', 'Descrição do slide 2', 'http://localhost:8080/admin/cursos/view.php?id=2', 'slide2.jpg');");
        $conn->exec("INSERT INTO slideshow (titulo, descricao, link, imagem) VALUES 
            ('Slide 3', 'Descrição do slide 3', 'http://localhost:8080/admin/cursos/view.php?id=3', 'slide3.jpg');");
    }

} catch (PDOException $e) {
    echo "Erro de conexão com SQLite: " . $e->getMessage();
    exit;
}
