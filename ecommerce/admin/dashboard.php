<?php
session_start();
if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

function dashboardNav() {
    $links = [
        ['href' => 'add_product.php', 'label' => 'Add Product'],
        ['href' => 'manage_products.php', 'label' => 'Manage Products'],
        ['href' => 'logout.php', 'label' => 'Logout', 'class' => 'logout']
    ];
    $nav = '<nav>';
    foreach ($links as $link) {
        $class = isset($link['class']) ? ' class="' . $link['class'] . '"' : '';
        $nav .= '<a href="' . $link['href'] . '"' . $class . '>' . $link['label'] . '</a>';
    }
    $nav .= '</nav>';
    return $nav;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        nav {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        nav a {
            text-decoration: none;
            padding: 12px 25px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        nav a:hover {
            background-color: #45a049;
        }
        .logout {
            background-color: #f44336;
        }
        .logout:hover {
            background-color: #e53935;
        }
        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <?php echo dashboardNav(); ?>
    </div>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Admin Dashboard</p>
    </footer>
</body>
</html>