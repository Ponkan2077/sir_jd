<?php 
require_once 'product.class.php';

$bookObj = new Book();


$bookId = $bookTitle = $bookAuthor = $bookGenre = $bookPublisher = $bookPublishDate = $bookEdition = $bookCopies = $ageGroup = $bookRating = $bookFormat = '';
$bookTitleErr = $bookAuthorErr = $bookGenreErr = $bookPublisherErr = $bookPublishDateErr = $bookEditionErr = $bookCopiesErr = $bookFormatErr = $ageGroupErr =$bookRatingErr ='';

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
                $bookId = $record['bookId']; 
                $bookTitle =  $record['bookTitle']; 
                $bookAuthor = $record['bookAuthor'];
                $bookGenre = $record['bookGenre'];
                $bookPublisher = $record['bookPublisher'];
                $bookPublishDate = $record['bookPublishDate'];
                $bookEdition =  $record['bookEdition'] ;
                $bookCopies = $record['bookCopies'];
                $bookFormat = $record['bookFormat'];
                $ageGroup = $record['ageGroup'] ;
                $bookRating = $record['bookRating'];
     }
     else {
      echo "No Book Found";
      exit;
    } 
 }
 else {
   echo "No Book Found";
   exit;
}
 }
 elseif($_SERVER['REQUEST_METHOD'] == "POST"){
   $bookId = clean_input($_GET['id']);
   $bookTitle = clean_input($_POST['bookTitle']);
   $bookAuthor = clean_input($_POST['bookAuthor']);
   $bookGenre = clean_input($_POST['bookGenre']);
   $bookPublisher = clean_input($_POST['bookPublisher']);
   $bookPublishDate = clean_input($_POST['bookPublishDate']);
   $bookEdition = clean_input($_POST['bookEdition']);
   $bookCopies = clean_input($_POST['bookTitle']);
   $bookFormat = clean_input($_POST['bookFormat']);
   $ageGroup = clean_input($_POST['ageGroup']);
   $bookRating = clean_input($_POST['bookRating']);


   if (empty($bookTitle)) {
    $bookTitleErr = 'Book Title is required';
   }

   if (empty($bookAuthor)) {
    $bookTAuthorErr = 'Book Author is required';
   }

   if (empty($bookGenre)) {
    $bookGenreErr = 'Book Genre is required';
   }

   if (empty($bookPublisher)) {
    $bookPublisherErr = 'Book Publisher is required';
   }

   if (empty($bookPublishDate)) {
    $bookPublishDateErr = 'Book Publish Date is required';
   }

   if (empty($bookEdition)) {
    $bookEditionErr = 'Book Edition is required';
   }

   else if (!is_numeric($bookEdition)) {
    $bookEditionErr = 'Book Edition should be a number';
   }

   if (empty($bookCopies)) {
    $bookCopiesErr = 'Book Copies is required';
   }

   else if (is_numeric($bookCopies)) {
    $bookCopiesErr = 'Book Copies should be a number';
   }

   if (empty($bookFormat)) {
    $bookFormatErr = 'Book Format is required';
   }

   if (empty($ageGroup)) {
    $ageGroupErr = 'Age Group is required';
   }

   if (empty($bookRating)) {
    $bookRatingErr = 'Book Title is required';
   }

   if (empty($bookTitleErr) && empty($bookAuthorErr) && empty($bookGenreErr) && empty($bookPublisherErr) && empty($bookPublishDateErr) && empty($bookEditionErr) &&
   empty($bookCopiesErr) && empty($bookFormatErr) && empty($ageGroupErr) && empty($bookRatingErr)){
      $bookObj->id = $bookId;
      $bookObj->bookTitle = $bookTitle;
    $bookObj->bookAuthor = $bookAuthor;
    $bookObj->bookGenre = $bookGenre;
    $bookObj->bookPublisher = $bookPublisher;
    $bookObj->bookPublishDate = $bookPublishDate;
    $bookObj->bookEdition = $bookEdition;
    $bookObj->bookFormat = $bookFormat;
   
    $bookObj->ageGroup = $ageGroup;
    $bookObj->bookRating = $bookRating;
    
   }

   if ($bookObj->edit()){
    header('location: book.php');
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
            <td><label for="bookTitle">Book Title</label></td>
            <td><input type="text" id="bookTitle" name="bookTitle"><span class="error">*</span></td>
            <?php 
            if(isset($_POST) && !empty($bookTitleErr)){
                ?>
                <span class="error"><?= $bookTitleErr ?></span>
            <?php
            }
            ?>
         </tr>   
        <tr>
            <td><label for="bookAuthor">Book Author</label></td>
            <td><input type="text" id="bookTitle" name="bookAuthor"     ><span class="error">*</span></td>
            <?php 
            if(isset($_POST) && !empty($bookAuthorErr)){
                ?>
                <span class="error"><?= $bookAuthorErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td> <label for="bookGenre">Book Genre</label><span class="error">*</span></td>
            <td>
                <select id="bookGenre" name="bookGenre" required>
                    <option value="science" <?= isset($_POST['bookGenre']) && $bookGenre == 'science'? 'selected=true':''?>>Sciene</option>
                    <option value="math" <?= isset($_POST['bookGenre']) && $bookGenre == 'math'? 'selected=true':''?>>Math</option>
                    <option value="History" <?= isset($_POST['bookGenre']) && $bookGenre == 'history'? 'selected=true':''?>>History</option>
                </select>
            </td>
            <?php 
            if(isset($_POST) && !empty($bookGenreErr)){
                ?>
                <span class="error"><?= $bookGenreErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td><label for="bookPublisher">Book Publisher</label></td>
            <td><input type="text" name="bookPublisher" id="bookPublisher"  value="<?= $bookPublisher ?>" required><span class="error">*</span>></td>
            <?php 
            if(isset($_POST) && !empty($bookPublisherErr)){
                ?>
                <span class="error"><?= $bookPublisherErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td><label for="bookPublishDate">Book Publication Date</label></td>
            <td><input type="date" name="bookPublishDate"  id="bookPublishDate"   value="<?= $bookPublishDate ?>" required><span class="error">*</span>>></td>
            <?php 
            if(isset($_POST) && !empty($bookPublishDateErr)){
                ?>
                <span class="error"><?= $bookPublishDateErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td><label for="bookEdition">Book Edition</label></td>
            <td><input type="number" name="bookEdition" id = "bookEdition"  value="<?= $bookEdition ?>" required><span class="error">*</span>>></td>
            <?php 
            if(isset($_POST) && !empty($bookEditionErr)){
                ?>
                <span class="error"><?= $bookEditionErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td><label for="bookCopies">Number of copies</label></td>
            <td><input type="number" name="bookCopies" id ="bookCopies"  value="<?= $bookCopies ?>" required><span class="error">*</span>> ></td>
            <?php 
            if(isset($_POST) && !empty($bookCopiesErr)){
                ?>
                <span class="error"><?= $bookCopiesErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td><label for="bookFormat">Book Format</label><span class="error">*</span></td>
            <td>
                <input type="radio" id="softbound" name="bookFormat" value="softbound" <?= isset($bookFormat) && $bookFormat == 'softbound'? 'checked':''?>>
                <label for="softbound">softbound</label>
                <input type="radio" id="hardbound" name="bookFormat" value="hardbound" <?= isset($bookFormat) && $bookFormat == 'hardbound'? 'checked':''?>>
                <label for="softbound">hardbound</label>
            </td>
            <?php 
            if(isset($_POST) && !empty($bookFormatErr)){
                ?>
                <span class="error"><?= $bookFormatErr ?></span>
            <?php
            }  
            ?>
        </tr>
        <tr>
            <td><label for="ageGroup">Age Group</label><span class="error">*</span></td>
            <td>
                <input type="checkbox" id="kids" name="ageGroup" value="kids" <?= isset($_POST['ageGroup']) && $ageGroup == 'kids'? 'selected=true':''?>>
                <label for="kids">Kids</label><br>
                <input type="checkbox" id="teens" name="ageGroup" value="teens" <?= isset($_POST['ageGroup']) && $ageGroup == 'teens'? 'selected=true':''?>>
                <label for="teens">Teens</label><br>
                <input type="checkbox" id="adults" name="ageGroup" value="adults" <?= isset($_POST['ageGroup']) && $ageGroup == 'adults'? 'selected=true':''?>>
                <label for="adults">Adults</label>
            </td>
            <?php 

            if(isset($_POST) && !empty($ageGroupErr)){
                ?>
                <span class="error"><?= $ageGroupErr ?></span>
            <?php
            }
            ?>
        </tr>
        <tr>
            <td><label for="bookRating">Book Rating</label></td>
            <td><input type="range" id="bookRating" name="bookRating" min="0" max="5" step="0.1" value="<?= $bookRating ?>" required><span class="error">*</span>>></td>
            <?php 
            if(isset($_POST) && !empty($bookRatingErr)){
                ?>
                <span class="error"><?= $bookRatingErr ?></span>
            <?php
            }
            echo "$bookTitle";
            echo "$bookId";
            ?>
            
        </tr>
        <tr>
        <td><input type="submit" value ="Update Book"></td>
        </tr>
    </table>
    </form>
</body>
</html>