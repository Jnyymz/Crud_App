<?php

require_once 'core/handleForms.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <br><br>

            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #EBE8DB;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 20px 40px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
        min-width: 300px;
    }

    h2 {
        color: #3D0301;
        margin-bottom: 40px;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        color: #3D0301;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #D76C82;
        border-radius: 6px;
        box-sizing: border-box;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #B03052;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    button:hover {
        background-color: #D76C82;
    }

    p {
        margin-top: 15px;
        font-size: 14px;
    }

    a {
        color: #B03052;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</html>

