<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
</head>
<body>
    <a href="addBook.php"> Add Book</a>
    <?php require_once 'product.class.php';
    $bookObj = new Book();

    $array = $bookObj->showAll(); 
    ?>

    <table border="1">
        <tr>
        <th>Book Title</th>
        <th>Book Author</th>
        <th>Book Genre</th>
        <th>Book Publisher</th>
        <th>Book Publish Date</th>
        <th>Book Edition</th>
        <th>Book No. Copies</th>
        <th>Book Format</th>
        <th>Age Group</th>
        <th>Book Rating</th>
        </tr>
        <
            <?php 
            $i = 1;
            foreach ($array as $arr) {
               ?>
               <tr>
                <td><?= $arr['bookTitle'] ?></td>
                <td><?= $arr['bookAuthor'] ?></td>
                <td><?= $arr['bookGenre'] ?></td>
                <td><?= $arr['bookPublisher'] ?></td>
                <td><?= $arr['bookPublishDate'] ?></td>
                <td><?= $arr['bookEdition'] ?></td>
                <td><?= $arr['bookCopies'] ?></td>
                <td><?= $arr['bookFormat'] ?></td>
                <td><?= $arr['ageGroup'] ?></td>
                <td><?= $arr['bookRating'] ?></td>
                <td><a href="editBook.php?id=<?= $arr['bookId'] ?>">Edit</a></td>
            </tr> 
           
        
    <?php
           $i++;
            }
    ?>
    </table>
</body>
</html>