<?php
session_start();
require_once 'models.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    addUser($username, $password);
    header("Location: login.php");
    exit();
}

if (isset($_POST['login'])) {
    $user = getUserByUsername($_POST['username']);
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];

    // Products
    if (isset($_POST['add_product'])) {
        addProduct($_POST['name'], $_POST['description'], $userId);
    }

    if (isset($_POST['update_product'])) {
        updateProduct($_POST['product_id'], $_POST['name'], $_POST['description'], $userId);
    }

    if (isset($_POST['delete_product'])) {
        deleteProduct($_POST['product_id']);
    }

    // Reviews
    if (isset($_POST['add_review'])) {
        addReview($_POST['product_id'], $_POST['content'], $userId);
    }

    if (isset($_POST['update_review'])) {
        updateReview($_POST['review_id'], $_POST['content'], $userId);
    }

    if (isset($_POST['delete_review'])) {
        deleteReview($_POST['review_id']);
    }
}
?>

