<?php
require_once '../../includes/sqlite.php';

$id = $_GET['id'] ?? 0;

if ($id) {
    try {
        // Deleta o curso do banco
        $stmt = $conn->prepare("DELETE FROM cursos WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao deletar curso: " . $e->getMessage();
        exit;
    }
}

header("Location: ../../index.php");
exit;
