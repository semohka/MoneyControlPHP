<?php
include 'nav_menu.php';
?>
<html>
<head>
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

        .form-center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
<h1>Таблица категорий</h1>
<div class="form-center">
    <form action="category.php" method="post">
        <table>
            <tr>
                <td><label for="category">Категория</label></td>
                <td><input type="text" id="category" name="category" placeholder="Введите данные"></td>
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
</div>

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