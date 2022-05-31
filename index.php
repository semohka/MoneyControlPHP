<?php
const MC_UPLOAD_PATH = 'images/';
include 'nav_menu.php';
include 'connectBD.php';

//$queryAllDate = "SELECT SUM(total_price) as aldt FROM products
//JOIN receipts ON products.receipt_id = receipts.id
//WHERE date between '2021-01-01' and CURDATE()";

$queryMonth = "SELECT SUM(total_price) as alldt, r.date, DATE_FORMAT(r.date, '%d-%m-%y')
FROM products
JOIN receipts r ON products.receipt_id = r.id
WHERE r.date between date_sub(now(),INTERVAL 1 MONTH) and now()
GROUP BY DATE_FORMAT(r.date, '%m%y')
ORDER BY r.date";

$queryWeek = "SELECT SUM(total_price) as wkdt, r.date, DATE_FORMAT(r.date, '%d-%m-%y')
FROM products
JOIN receipts r ON products.receipt_id = r.id
WHERE r.date between date_sub(now(),INTERVAL 1 WEEK) and now()
GROUP BY DATE_FORMAT(r.date, '%m%y')
ORDER BY r.date";

$queryLastYear = "SELECT SUM(total_price) as lysum, r.date, title, 
       DATE_FORMAT(r.date, '%d-%m-%y')
FROM products
JOIN receipts r ON products.receipt_id = r.id
WHERE r.date between '2021-01-01' and NOW()
GROUP BY DATE_FORMAT(r.date, '%m%y')
ORDER BY r.date";

/** @var mysqli $openBD */
//$resultAllDate = mysqli_query($openBD, $queryAllDate) or die("ERROR QUERY");
$resultMonth = mysqli_query($openBD, $queryMonth) or die("ERROR QUERY");
$resultWeek = mysqli_query($openBD, $queryWeek) or die("ERROR QUERY");
$resultLastYear = mysqli_query($openBD, $queryLastYear) or die("ERROR QUERY");


//[
//    '2022-04-13 12:18:00' => 1233,
//    '2022-05-30 13:44:00' => 377
//]
$resultsMonth = [];
while ($row = mysqli_fetch_array($resultMonth)) {
    $resultsMonth[$row['date']] = $row['alldt'];
}
$priceMonth = json_encode(array_values($resultsMonth));
$dateMonth = json_encode(array_keys($resultsMonth));


$resultsWeek = [];
while ($row = mysqli_fetch_array($resultWeek)) {
    $resultsWeek[$row['date']] = $row['wkdt'];
}
$priceWeek = json_encode(array_values($resultsWeek));
$dateWeek = json_encode(array_keys($resultsWeek));


$resultsYear = [];
while ($row = mysqli_fetch_array($resultLastYear)) {
    $resultsYear[$row['date']] = $row['lysum'];
}
$priceYear = json_encode(array_values($resultsYear));
$dateYear = json_encode(array_keys($resultsYear));

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


<!--<table class="center">-->
<!--    <tr>-->
<!--        <th>За месяц</th>-->
<!--        <th>За год</th>-->
<!--        <th>За неделю</th>-->
<!--    </tr>-->

<!--    --><?php
//    echo "<tr>";
//
//    while ($row = mysqli_fetch_array($resultMonth)) {
//        echo "<td>" . $row['alldt'] . "</td>";
//    }
//    while ($row = mysqli_fetch_array($resultAllDate)) {
//        echo "<td>" . $row['aldt'] . "</td>";
//    }
//    while ($row = mysqli_fetch_array($resultWeek)) {
//        echo "<td>" . $row['wkdt'] . "</td>";
//    }
//
//    echo "</tr>";
//    ?>


<div class="chart-container" style="position: relative; height:40vh; width:100vw">
    <canvas id="myChart" width="50" height="10"></canvas>
</div>

<script src=dist/chart.js></script>
<script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?=$dateYear?>,
            datasets: [{
                label: 'Все товары за весь год',
                data: <?=$priceYear?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
                {
                    label: 'Все товары за неделю',
                    data: <?=$priceWeek?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }, {
                    label: 'Все товары за месяц',
                    data: <?=$priceMonth?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>
