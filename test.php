<?php

// Récupérer les informations de la base de données à partir de variables d'environnement
$host = getenv('DB_HOST') ?: 'localhost';  // DB_HOST par défaut si non défini dans .env
$port = getenv('DB_PORT') ?: '3306';      // DB_PORT par défaut si non défini dans .env
$database = getenv('DB_DATABASE') ?: 'laravel';  // DB_DATABASE par défaut si non défini
$username = getenv('DB_USERNAME') ?: 'root';     // DB_USERNAME par défaut si non défini
$password = getenv('DB_PASSWORD') ?: '';         // DB_PASSWORD par défaut si non défini

// Tentative de connexion à MySQL
$dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8";
try {
    // Créer une nouvelle instance PDO pour la connexion
    $pdo = new PDO($dsn, $username, $password);
    
    // Configurer le mode d'erreur de PDO pour afficher les exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Si la connexion réussit
    echo "Connexion réussie à la base de données $database sur $host:$port";
} catch (PDOException $e) {
    // Si la connexion échoue, afficher l'erreur
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
