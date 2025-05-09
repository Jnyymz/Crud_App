<?php

require_once 'core/handleForms.php';
require_once 'core/models.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user']['id'];
$products = getAllProducts();

$editingProductId = $_POST['edit_product'] ?? null;
$editingReviewId = $_POST['edit_review'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Dashboard</title>
</head>
<body>
    <h2>⋆.˚✮ Welcome, <?= $_SESSION['user']['username']; ?> ✮˚.⋆</h2>

    <!-- Add Product -->
    <form class="product" action="" method="POST">
        <h3>Add Product</h3>
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br><br>

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <!-- Product List -->
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <h3 style="text-align: center;">𓂃˖˳·˖ ִֶָ ⋆ Product Lists ͙ ⋆ ִֶָ˖·˳˖𓂃 </h3>
                <?php if ($editingProductId == $product['id']): ?>
                    <!-- Editable Form -->
                    <form action="" method="POST" class="inline-form">
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
                        <textarea name="description" required><?= htmlspecialchars($product['description']); ?></textarea>
                        <button type="submit" name="update_product">Save</button>
                    </form>
                <?php else: ?>
                    <!-- Display Mode -->
                    <h4><?= $product['name']; ?> <em>(Added by: <?= $product['added_by_user']; ?>)</em></h4>
                    <p><?= $product['description']; ?></p>
                    <p><em>Last updated by: <?= $product['updated_by_user']; ?> on <?= $product['last_updated_at']; ?></em></p>

                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="edit_product" value="<?= $product['id']; ?>">
                        <button type="submit">Edit</button>
                    </form>

                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                        <button type="submit" name="delete_product">Delete</button>
                    </form>
                <?php endif; ?>

                <!-- Reviews -->
                <h5 style="margin-top: 30px;">Reviews</h5>
                <form class="review" style="background-color: #fff;" action="" method="POST">
                    <textarea name="content" required></textarea><br>
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <button type="submit" name="add_review">Add Review</button>
                </form>

                <?php $reviews = getReviewsByProduct($product['id']); ?>
                <ul>
                    <?php foreach ($reviews as $review): ?>
                        <li>
                            <?php if ($editingReviewId == $review['id']): ?>
                                <!-- Editable Review -->
                                <form action="" method="POST" class="inline-form">
                                    <input type="hidden" name="review_id" value="<?= $review['id']; ?>">
                                    <textarea name="content" required><?= htmlspecialchars($review['content']); ?></textarea>
                                    <button type="submit" name="update_review">Save</button>
                                </form>
                            <?php else: ?>
                                <!-- Display Mode -->
                                <p><?= $review['content']; ?> (Reviewed by: <?= $review['added_by_user']; ?>)</p>
                                <p><em>Last updated by: <?= $review['updated_by_user']; ?> on <?= $review['last_updated_at']; ?></em></p>

                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="edit_review" value="<?= $review['id']; ?>">
                                    <button type="submit">Edit</button>
                                </form>

                                <form action="" method="POST" style="display:inline;">
                                    <input type="hidden" name="review_id" value="<?= $review['id']; ?>">
                                    <button type="submit" name="delete_review">Delete</button>
                                </form>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #EBE8DB;
        padding: 40px 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #3D0301;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 32px;
        color: #3D0301;
    }

    h3, h4, h5 {
        margin-bottom: 10px;
        color: #3D0301;
    }

    .product, .review {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        width: 100%;
        max-width: 700px;
    }

    .form-actions {
    display: flex;
    flex-direction: row;
    align-items: flex-end;
    gap: 10px;
    margin: 10px 0 30px 0;
    }


    .form-actions form {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    em {
    color: #B03052; 
    display: inline-block;
    margin: 10px 0;
    font-style: italic;
    }

    form[style*="display:inline;"] {
        margin-right: 10px;
    }


    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #D76C82;
        border-radius: 6px;
        margin-bottom: 12px;
    }

    button {
        background-color: #B03052;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background-color: #D76C82;
    }

    ul {
        list-style: none;
        padding: 0;
        width: 100%;
        max-width: 700px;
    }

    li {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 20px;
    }

    .product-title {
        font-size: 20px;
        font-weight: bold;
        color: #3D0301;
    }

    .product-meta {
        font-size: 14px;
        color: #B03052;
        margin-bottom: 10px;
    }

    .review {
        background-color: #F9F7F0;
        padding: 10px;
        margin-top: 10px;
        border-left: 4px solid #D76C82;
        border-radius: 6px;
        font-size: 14px;
    }

    .logout-form {
        margin-top: 30px;
        text-align: center;
    }

    .review form {
        margin-top: 10px;
    }

    .review textarea {
        font-size: 14px;
    }
</style>


</html>

