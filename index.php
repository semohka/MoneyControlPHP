<?php
const MC_UPLOAD_PATH = 'images/';
include 'nav_menu.php';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
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
<h1>Статистика</h1>
<?php
$openBD = mysqli_connect('localhost', 'root', '', 'money_control_php')
or die('ERROR CONNECTION TO DB');
$query = "SELECT"
?>

<table class="center">
    <tr>
        <th>№</th>
        <th>За неделю</th>
        <th>За месяц</th>
        <th>За год</th>
    </tr>

</body>
</html>
