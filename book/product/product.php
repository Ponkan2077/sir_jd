<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
</head>
<body>
    <?php require_once 'product.class.php';
    $bookObj = new Product();

    $array = $bookObj->showAll(); 
    ?>

    <table border="1">
        <tr>
        <th>No. </th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Availability</th>
        </tr>
        <
            <?php 
            $i = 1;
            foreach ($array as $arr) {
               ?>
               <tr>
                <td><?= $arr['id'] ?></td>
                <td><?= $arr['name'] ?></td>
                <td><?= $arr['category'] ?></td>
                <td><?= $arr['price'] ?></td>
                <td><?= $arr['availability'] ?></td>
                <td><a href="editProduct.php?id=<?= $arr['id'] ?>">Edit</a></td>
            </tr> 
           
        
    <?php
           $i++;
            }
    ?>
    </table>
</body>
</html>