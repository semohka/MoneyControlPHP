<html>
<head>
    <style>
        body {
            background-color: gainsboro;
            margin-left: 10%;
            /*margin-top: 10%;*/
            font-family: sans-serif;
        }
    </style>
</head>
<body>
<h1>ТАБЛИЦА КАТЕГОРИЙ</h1>
<form action="category.php" method="post">
    <p><b>Введите данные</b></p>
    <table>
        <tr>
            <td><label for="category">Категория</label></td>
            <td><input type="text" id="category" name="category"></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><input type="submit" value="Сохранить" name="submit"/></td>
        </tr>
    </table>
</form>
<a href="index.php">Вернуться обратно</a>

<?php
if (!empty($_POST['category'])) {
    $categoryName = $_POST['category'];
    $openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
    or die('ERROR CONNECTION TO DB');
    $query = "INSERT INTO product_categories(title)" .
        "VALUES ('$categoryName')";

    $result = mysqli_query($openBD, $query) or die("ERROR QUERY");

    header("Location: " . $_SERVER['PHP_SELF']); //отобрази эту же страницу еще раз только методом гет
    exit;
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {//если форма ушла пустая методом пост
    echo "Error";
}
?>
</body>
</html>