<?php 
require_once 'product.class.php';

$bookObj = new Product();



$name = $id = $category = $price = $availability = '';
$nameErr = $categoryErr = $priceErr = $availabilityErr = '';


function clean_input ($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    
    return $input;
 }

 if ($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
    $record = $bookObj->fetchRecord($id);
     if (!empty($record)){
                $id = $_GET['id']; 
                $name =  $record['name']; 
                $category = $record['category'];
                $price = $record['price'];
                $availability = $record['availability'];
     }
     else {
      echo "No Product Found";
      exit;
    } 
 }
 else {
   echo "No Product Found";
   exit;
}
 }
 elseif($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = clean_input($_GET['id']);
   $name = clean_input($_POST['name']);
   $category = clean_input($_POST['category']);
   $price = clean_input($_POST['price']);
   $availability = clean_input($_POST['availability']);


   if (empty($name)) {
    $nameErr = 'name is required';
   }

   if (empty($category)) {
    $categoryErr = 'category is required';
   }

   if (empty($price)) {
    $priceErr = 'price is required';
   }

   if (empty($availability)) {
    $availabilityErr = 'availability is required';
   }


   if (empty($nameeErr) && empty($categoryErr) && empty($priceErr) && empty($availabilityErr)){
    $bookObj->id = $id;
      $bookObj->name = $name;
    $bookObj->category = $category;
    $bookObj->availability = $availability;
    $bookObj->price = $price;
    
   }

   if ($bookObj->edit()){
    header('location: product.php');
   } else {
    echo 'Something went wrong when adding a new book!';
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
<form action="" method="POST">
        <table border="1">
            <tr>
                <th>Field</th>
                <th>Input</th>
            </tr>
         <tr>
            <td><label for="name">Product Name</label></td>
            <td><input type="text" id="name" name="name"><span class="error">*</span></td>
            <?php 
            if(isset($_POST) && !empty($nameErr)){
                ?>
                <span class="error"><?= $nameErr ?></span>
            <?php
            }
            ?>
         </tr>   
         <tr>
            <td> <label for="category">Product Category</label><span class="error">*</span></td>
            <td>
                <select id="category" name="category" required>
                    <option value="gadgets" <?= isset($_POST['gadgets']) && $category == 'gadgets'? 'selected=true':''?>>Gadget</option>
                    <option value="toys" <?= isset($_POST['toys']) && $category == 'toys'? 'selected=true':''?>>Toys</option>
                </select>
            </td>
            <?php 
            if(isset($_POST) && !empty($categoryErr)){
                ?>
                <span class="error"><?= $categoryErr ?></span>
            <?php
            }
            ?>
        </tr>
        
        
        <tr>
            <td><label for="price">Product Price</label></td>
            <td><input type="number" name="price" id = "price"  value="<?= $price ?>" required><span class="error">*</span>>></td>
            <?php 
            if(isset($_POST) && !empty($priceErr)){
                ?>
                <span class="error"><?= $priceErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td><label for="availability">Availability</label><span class="error">*</span></td>
            <td>
                <input type="radio" id="softbound" name="availability" value="In stock" <?= isset($availabilty) && $availability == 'In stock'? 'checked':''?>>
                <label for="softbound">In stock</label>
                <input type="radio" id="hardbound" name="availability" value="No stock" <?= isset($availability) && $availability == 'No stock'? 'checked':''?>>
                <label for="softbound">No stock</label>
            </td>
            <?php 
            if(isset($_POST) && !empty($availabilityErr)){
                ?>
                <span class="error"><?= $availabilityErr ?></span>
            <?php
            }  
            ?>
        </tr>
            
        </tr>
        <tr>
        <td><input type="submit" value ="Update Product"></td>
        </tr>
    </table>
    </form>
</body>
</html>