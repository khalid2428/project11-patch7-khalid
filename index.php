<?php
require 'connect.php';
$name = $email = $gender = $website = $comment = '';
$nameErr = $emailErr = $websiteErr = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        $nameErr = "Name is required";
    } else if (preg_match("^[a-zA-Z\s]+$^", $_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $nameErr = "Invalid Name";
    }
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    } else {
        $emailErr = "Invalid Email";
    }
    if (empty($_POST['website'])) {
        $websiteErr = "website is required";
    } else if (filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
        $website = $_POST['website'];
    
   
    } else {
        $websiteErr = "Invalid URL";
    }
    
     $gender = $_POST['gender'];    
    $comment = $_POST['comment'];
    
    $sql = "INSERT INTO `comments`( `name`, `email`, `gender`, `website`, `comments`) VALUES ('%s','%s','%s','%s','%s')";
$sql = sprintf($sql,$name,$email,$gender,$website,$comment);
$conn->query($sql);
    if($conn->error){
        echo $conn->error;
    }
    
    
   
}
 //var_dump(($_GET['delete']));die;
    if (!empty($_GET['delete'])) {
    $id = $_GET['delete'];
        $sql = "DELETE FROM `comments` WHERE id = '%s'";
$sql = sprintf($sql,$id);
$conn->query($sql);
        if($conn->error){
        echo $conn->error;
    }
    }




//عرض الجدول
$sql = "SELECT * FROM `comments`;";
$result = $conn->query($sql);
$all_comments = $result->fetch_all(MYSQLI_ASSOC);

?>
<html>
<head>
    <title>example page </title>
     <link rel="stylesheet" href="style.css" />
    <meta charset="utf-8">
    </head>
    <body>
    <form action="#" method="post">
       Name <input required type="text" name="name"> <br>
        <samp class="error"><?+ $nameErr ?></samp>
       E-mail <input type="email" name="email"><br>
         <samp class="error"><?+ $emailErr ?></samp>
        Gender
      <input type="radio" name="gender" value="Mail">     Male
       <input type="radio" name="gender" value=" FeMail">FeMail <br>
        Website<input type="url" name="URL">  <br>
         <samp class="error"><?+ Website$Err ?></samp>
        Comment<textarea  cols="40" rows="4" name="comment"></textarea><br>
        <input type="submit" >
        </form>      
        <table>
            <tr>
       <th>Name</th>
       <th>Email</th>
                <th>delete</th>
                <th>Edit</th>
            </tr>
            <?php foreach($all_comments as $row){?>
            <tr>
       <td><?php echo $row['name'] ?></td>
       <td><?php echo $row['email'] ?></td>
                <td><a href="mypro.php?delete=<?php echo $row['id'] ?>">delete</a></td>
            <td><a href="update.php?id=<?php echo $row['id'] ?>">Edit</a></td>
            </tr>
            <?php } ?>
    </table>
    </body>
</html>