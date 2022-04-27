<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Verdana, Geneva, Arial, sans-serif;
        }

        .nav_menu {
            overflow: hidden;
            background-color: #333;
        }

        .nav_menu a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .nav_menu a:hover {
            background-color: #cc6600;
            color: white;
        }

        /*.nav_menu a.active {*/
        /*    background-color: #cc6600;*/
        /*    color: white;*/
        /*}*/
    </style>
</head>
<body>

<div class="nav_menu">
    <!--    <a class="active" href="shop.php">Новый магазин</a>-->
    <a href="shop.php">Новый магазин</a>
    <a href="category.php">Новая категория</a>
    <a href="receipt.php">Новый чек</a>
    <a href="table_receipts.php">Просмотр и редактирование чеков</a>
</div>

</body>
</html>

