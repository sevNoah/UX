CREATE DATABASE product_db;

USE product_db;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) DEFAULT 0.00,
    image_url VARCHAR(255) NOT NULL
);
