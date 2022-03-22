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
<h1>Таблица чеков</h1>
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
$queryy = "select receipt.id, product, shops.title, count, price, grade, comment, date, screenshot FROM receipt INNER JOIN shops ON (receipt.shop_id = shops.id)
 ORDER BY $orderBy $direction";
$result = mysqli_query($openBD, $queryy) or die("ERROR QUERY");
?>
<form name="search" action="table.php" method="post">
    <input type="search" name="search" placeholder="Поиск">
    <button type="submit">Найти</button>
</form>

<?php
$search = $_GET['search'];
if (!empty($search)) {
    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');
    $query1 = "select receipt.id, product, shops.title, count, price, grade, comment, date, screenshot FROM receipt WHERE `text` LIKE '%$search%' ";
    $result = mysqli_query($openBD, $query1);
}
?>

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
        echo "<form method='post' action='delete_receipt.php'>";
        echo "<input type='hidden' value='" . $row['id'] . "' name='id'>";
        echo "<tr>";
        echo "<td>", $row['id'], "</td>";
        echo "<td>", $row['product'], "</td>";
        echo "<td>", $row['title'], "</td>";
        echo "<td>", $row['count'], "</td>";
        echo "<td>", $row['price'], "</td>";
        echo "<td>", $row['grade'], "</td>";
        echo "<td>", $row['comment'], "</td>";
        echo "<td>", $row['date'], "</td>";

        if ($row['screenshot'] != null) {
            echo "<td> <img src=" . $row['screenshot'] . " alt='фото чека'> </td>";
        } else {
            echo "<td></td>";
        }

        echo "<td> <input type='submit' value='Удалить' name='submit'/> </td>";
        echo "<td> <button>Редактировать</button> </td>";

        echo "</tr>";
        echo "</form>";
    }
    ?>
</table>
<a href="index.php">Вернуться обратно</a>
</body>
</html>