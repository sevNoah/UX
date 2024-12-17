composer require fzaninotto/faker

<?php
require 'vendor/autoload.php';

$faker = Faker\Factory::create('fr_FR');

// Connexion à la base de données
$host = 'localhost';
$dbname = 'product_db';
$username = 'root';
$password = ''; // Mettez votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insérer 1000 produits fictifs
    for ($i = 0; $i < 1000; $i++) {
        $name = $faker->words(3, true);
        $description = $faker->sentence(15);
        $price = $faker->randomFloat(2, 10, 500);
        $image_url = $faker->imageUrl(200, 200, 'tech', true);

        $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url) 
                               VALUES (:name, :description, :price, :image_url)");
        $stmt->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image_url' => $image_url
        ]);
    }

    echo "Les produits fictifs ont été générés avec succès !";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
