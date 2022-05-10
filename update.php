<?php
require 'connect.php';

//var_dump($_POST);die;
if(isset($_POST['save'])){
 $name = $_POST['name'];
    $email = $_POST['email'];
    $website = $_POST['URL'];
    $comment = $_POST['comment'];

$id=$_POST['id'];

$qu= "UPDATE `comments` SET `name`='%s',`email`='%s',`website`='%s',`comments`='%s' WHERE id = %s";
$qu = sprintf($qu,$name,$email,$website,$comment,$id);
    
$result = $conn->query($qu);
if($conn->error){
        echo $conn->error;
    }
    
    header("Location: /example");
   
}



$id=$_GET['id'];
$sql = "SELECT * FROM `comments` WHERE id = %s;";
$sql = sprintf($sql,$id);
$result = $conn->query($sql);
if($conn->error){
        echo $conn->error;
    }
$comment = $result->fetch_all(MYSQLI_ASSOC);
//var_dump($comment);die;
?>
<html>
<head>
    <title>example page </title>
     <link rel="stylesheet" href="style.css" />
    <meta charset="utf-8">
    </head>
    <body>
    <form method="post">
       Name <input required type="text" name="name" value="<?php echo $comment[0]['name']?>"> <br>
        <samp class="error"><?+ $nameErr ?></samp>
       E-mail <input type="email" name="email" value="<?php echo $comment[0]['email']?>" ><br>
         <samp class="error"><?+ $emailErr ?></samp>
       
        Website<input type="text" name="URL" value="<?php echo ($comment[0]['website'])?>">  <br>
         <samp class="error"><?+ Website$Err ?></samp>
        Comment<textarea  cols="40" rows="4" name="comment" ><?php echo $comment[0]['comments']?></textarea><br>
        <input type="submit" name="save" value="save" >
        <input name="id" type="hidden" value="<?php echo $comment[0]['id']?>">
        </form>      
    </body>
</html>