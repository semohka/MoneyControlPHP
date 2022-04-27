<?php
include 'nav_menu.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Control</title>
    <style>
        body {
            font-family: Verdana, Geneva, Arial, sans-serif;
            font-size: small;
            text-align: center;
        }
        h1 {
            color: #cc6600;
            border-bottom: thin dotted #888888;
            font-family: "Emblema One", sans-serif;
            font-size: 220%;
        }
        table {
            border: thin solid gray;
            border-collapse: collapse;
            text-align: center;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
            margin-top: 50px;
        }
        td, th {
            border: thin dotted gray;
            padding: 5px;
        }
        tr:nth-child(2n) {
            background-color: #d9d6d6;
        }
    </style>
</head>
<body>
<h1>Просмотр и редактирование чеков</h1>
<?php
$openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
or die('ERROR CONNECTION TO DB');
$query = "SELECT receipts.id, shops.title, date FROM receipts INNER JOIN shops ON (receipts.shop_id = shops.id)";
$result = mysqli_query($openBD, $query) or die("ERROR QUERY");

?>
<table class="center">
    <tr>
        <th>№</th>
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

        echo "<td>";
        echo "<form method='post' action='delete_receipt.php'>";
        echo "<input type='hidden' value='" . $row['id'] . "' name='id_delete'>";
        echo "<input type='submit' value='Удалить' name='submit'/>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }
    ?>

</table>
<br>
</body>
</html>