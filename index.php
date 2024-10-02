<?php
require_once './php/connection.php';


$con = connection();

$sql = "SELECT pro.ProductID, cat.CategoryName, pro.UnitPrice
FROM products AS pro
JOIN categories AS cat
ON(pro.CategoryID = cat.CategoryID)
WHERE pro.UnitPrice > (
    SELECT AVG(p.UnitPrice)
    FROM products AS p
    WHERE p.CategoryID = pro.CategoryID
);";
$query = mysqli_query($con, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso a datos</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Category Name</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $row['ProductID'] ?></td>
                        <td><?= $row['CategoryName'] ?></td>
                        <td><?= $row['UnitPrice'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>