<?php
require_once 'dbConfig.php';

function getUserByUsername($username) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    return $stmt->fetch();
}

function addUser($username, $hashedPassword) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $hashedPassword]);
}

function addProduct($name, $description, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO products (name, description, added_by, last_updated_by, last_updated_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$name, $description, $userId, $userId]);
}

function updateProduct($id, $name, $description, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE products SET name = ?, description = ?, last_updated_by = ?, last_updated_at = NOW() WHERE id = ?");
    $stmt->execute([$name, $description, $userId, $id]);
}

function deleteProduct($id) {
    global $pdo;
    $pdo->prepare("DELETE FROM reviews WHERE product_id = ?")->execute([$id]);
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
}

function getAllProducts() {
    global $pdo;
    $stmt = $pdo->query("
        SELECT p.*, 
               u1.username AS added_by_user, 
               u2.username AS updated_by_user 
        FROM products p 
        JOIN users u1 ON p.added_by = u1.id 
        JOIN users u2 ON p.last_updated_by = u2.id 
        ORDER BY p.id DESC
    ");
    return $stmt->fetchAll();
}


function getReviewsByProduct($productId) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT r.*, 
               u1.username AS added_by_user, 
               u2.username AS updated_by_user 
        FROM reviews r 
        JOIN users u1 ON r.added_by = u1.id 
        JOIN users u2 ON r.last_updated_by = u2.id 
        WHERE r.product_id = ? 
        ORDER BY r.id DESC
    ");
    $stmt->execute([$productId]);
    return $stmt->fetchAll();
}


function addReview($productId, $content, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO reviews (product_id, content, added_by, last_updated_by, last_updated_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$productId, $content, $userId, $userId]);
}

function updateReview($id, $content, $userId) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE reviews SET content = ?, last_updated_by = ?, last_updated_at = NOW() WHERE id = ?");
    $stmt->execute([$content, $userId, $id]);
}

function deleteReview($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->execute([$id]);
}
?>

