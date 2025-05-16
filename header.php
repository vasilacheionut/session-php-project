<?php
include 'auth.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Aplicație cu sesiuni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 20px;
        }
        .menu {
            background: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .menu ul {
            list-style: none;
            padding: 0;
        }
        .menu li {
            display: inline-block;
            margin-right: 10px;
        }
        .menu a {
            text-decoration: none;
            color: #0077cc;
        }
    </style>
</head>
<body>

<div class="menu">
    <?php include 'menu.php'; ?>
</div>
