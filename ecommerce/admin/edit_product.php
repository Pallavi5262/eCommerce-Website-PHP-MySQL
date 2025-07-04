<?php
include '../includes/db.php';

// Get product ID from URL
if (!isset($_GET['id'])) {
    die('Product ID not specified.');
}
$product_id = intval($_GET['id']);

// Fetch product details using PDO
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
    die('Product not found.');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];
    $image = $_POST['image'];

    $update_sql = "UPDATE products SET name=?, price=?, description=?, image=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    if ($update_stmt->execute([$name, $price, $description, $image, $product_id])) {
        echo '<div style="color:green;text-align:center;">Product updated successfully!</div>';
        // Refresh product data
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo '<div style="color:red;text-align:center;">Error updating product.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            padding: 40px;
        }
        /* Add more styling for product edit form if needed */
        .container {
            width: 400px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
            resize: vertical;
        }

        .btn {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #218838;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <form method="POST">
        <label>Product Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        <label>Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        <label>Image URL:</label>
        <input type="text" name="image" value="<?php echo htmlspecialchars($product['image']); ?>">
        <button type="submit" class="btn">Update Product</button>
    </form>
</div>
</body>
</html>

