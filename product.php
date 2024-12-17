<?php

$db_file = __DIR__ . '/database.sqlite';

try {
    // Connexion à la base SQLite
    $pdo = new PDO("sqlite:$db_file");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les produits depuis la base de données
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les produits au format JSON
    echo json_encode($products);

} catch (PDOException $e) {
    echo "Erreur SQLite : " . $e->getMessage();
}
?>
