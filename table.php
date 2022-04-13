<html>
<head>
    <meta charset="utf-8">
    <title>Control</title>
    <style>
        body {
            background-color: gainsboro;
            margin-left: 10%;
            /*margin-top: 10%;*/
            font-family: sans-serif;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<h1>ТАБЛИЦА ЧЕКОВ</h1>
<?php
$openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
or die('ERROR CONNECTION TO DB');

$orderBy = 'id';
if (!empty($_GET['sort'])) {
    $orderBy = $_GET['sort'];
}

$direction = 'DESC';
if (isset($_GET['direction'])) {
    $direction = $_GET['direction'];
}
//$queryy = "select * FROM products INNER JOIN receipts ON (products.receipt_id = receipts.id) JOIN shops ON (receipts.shop_id = shops.id)";
$queryy = "select * FROM products";
$result = mysqli_query($openBD, $queryy) or die("ERROR QUERY");
?>
<form name="search" action="table.php" method="post">
    <input type="search" name="search" placeholder="Поиск">
    <button type="submit">Найти</button>
</form>

<table class="center" border="1">
    <tr>
        <th><a href="table.php?sort=id&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">id</a></th>
        <th><a href="table.php?sort=product&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Продукт</a></th>
        <th><a href="table.php?sort=shop&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Магазин</a></th>
        <th><a href="table.php?sort=count&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Количество</a></th>
        <th><a href="table.php?sort=price&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Цена</a></th>
        <th><a href="table.php?sort=grade&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Оценка</a></th>
        <th><a href="table.php?sort=comment&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Комментарий</a></th>
        <th><a href="table.php?sort=date&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Дата</a></th>
        <th><a href="table.php?sort=screenshot&direction=<?php if ($direction == "DESC") {
                echo 'ASC';
            } else {
                echo 'DESC';
            } ?>">Фото</a></th>
    </tr>

    <?php
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
//        echo "<td>", $row['id'], "</td>";
//        echo "<td>", $row['product'], "</td>";
        echo "<td>", $row['title'], "</td>";
        echo "<td>", $row['count'], "</td>";
        echo "<td>", $row['price_of_one'], "</td>";
        echo "<td>", $row['grade'], "</td>";
        echo "<td>", $row['comment'], "</td>";
//        echo "<td>", $row['date'], "</td>";

        if ($row['screenshot'] != null) {
            echo "<td> <img src=" . $row['screenshot'] . " alt='фото чека'> </td>";
        } else {
            echo "<td></td>";
        }

        echo "<td>";
        echo "<form method='post' action='delete_receipt.php'>";
        echo "<input type='hidden' value='" . $row['id'] . "' name='id'>";
        echo "<input type='submit' value='Удалить' name='submit'/>";
        echo "</form>";
        echo "</td>";

        echo "<td><a href='index.php'>Редактировать</a></td>";
        echo "</tr>";
    }

    ?>
</table>
<a href="index.php">Вернуться обратно</a>
</body>
</html>