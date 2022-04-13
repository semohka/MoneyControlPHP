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
<h1>ПРОСМОТР И РЕДАКТИРОВАИНЕ ЧЕКОВ</h1>
<?php
$openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
or die('ERROR CONNECTION TO DB');
$query = "SELECT receipts.id, shops.title, date FROM receipts INNER JOIN shops ON (receipts.shop_id = shops.id)";
$result = mysqli_query($openBD, $query) or die("ERROR QUERY");

?>

<table class="center" border="1">
    <tr>
        <th>id</th>
        <th>Магазин</th>
        <th>Дата</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>", $row['id'], "</td>";
        echo "<td>", $row['title'], "</td>";
        echo "<td>", $row['date'], "</td>";
        echo "<td><a href='edit_form.php?receipt_id=" . $row['id'] . "'>Редактировать</a></td>";
        echo "</tr>";
    }
    ?>

</table>
<a href="index.php">Вернуться обратно</a>
</body>
</html>