<?php
require_once 'vendor/autoload.php';

$faker = Faker\Factory::create();

// Emplacement du fichier SQLite
$db_file = __DIR__ . '/database.sqlite';

try {
    // Connexion à la base SQLite
    $pdo = new PDO("sqlite:$db_file");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Créer la table si elle n'existe pas
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT NOT NULL,
            price REAL DEFAULT 0,
            image_url TEXT
        )
    ");

    // Préparation de la requête d'insertion
    $stmt = $pdo->prepare("
        INSERT INTO products (name, description, price, image_url)
        VALUES (:name, :description, :price, :image_url)
    ");

    // Générer et insérer 100 produits fictifs
    for ($i = 0; $i < 100; $i++) {
        $stmt->execute([
            ':name' => $faker->word(),
            ':description' => $faker->sentence(),
            ':price' => $faker->randomFloat(2, 1, 100),
            ':image_url' => $faker->imageUrl(200, 200, 'product'),
        ]);
    }

    echo "Insertion des produits réussie dans SQLite !";

} catch (PDOException $e) {
    echo "Erreur SQLite : " . $e->getMessage();
}
?>

