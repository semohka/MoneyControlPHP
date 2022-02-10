<html>
<head>
    <meta charset="utf-8">
    <title>Control</title>
    <style>
        body {
            background-color: gainsboro;
            /*margin-left: 10%;*/
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
$queryy = "SELECT * FROM receipt ORDER BY productId DESC";
$result = mysqli_query($openBD, $queryy) or die("ERROR QUERY");
?>

<table class="center" border="1">
    <tr>
        <th>id</th>
        <th>Продукт</th>
        <th>Магазин</th>
        <th>Количество</th>
        <th>Цена</th>
        <th>Оценка</th>
        <th>Комментарий</th>
        <th>Дата</th>

    </tr>

    <?php
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>", $row['productId'], "</td>";
        echo "<td>", $row['product'], "</td>";
        echo "<td>", $row['shop'], "</td>";
        echo "<td>", $row['count'], "</td>";
        echo "<td>", $row['price'], "</td>";
        echo "<td>", $row['grade'], "</td>";
        echo "<td>", $row['comment'], "</td>";
        echo "<td>", $row['date'], "</td>";
        echo "<td> <a href='delete_receipt.php?id=" . $row['productId'] . "'>Удалить</a> </td>";
        echo "<td> <button>Редактировать</button> </td>";
        echo "</tr>";
    }
    ?>
</table>
<a href="index.php">Вернуться обратно</a>


</body>
</html>